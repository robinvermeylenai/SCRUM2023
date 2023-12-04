<?php

declare(strict_types=1);

namespace Data;

use Business\ClientService;
use Business\UserAccountService;
use Data\BaseDAO;
use Entities\ContactPerson;
use Entities\Client;
use Entities\UserAccount;
use PDOException;

class ContactPersonDAO extends BaseDAO
{
   public function createContactpersonFromRow($row): ?ContactPerson
   {
      $clientServ = new ClientService();
      $client = $clientServ->getClientByClientId($row['klantId']);

      $userAccountServ = new UserAccountService();
      $userAccount = $userAccountServ->getUserAccountByUserAccountId($row['gebruikersAccountId']);

      return new ContactPerson(
         (int)$row['contactpersoonId'],
         $row['voornaam'],
         $row['familienaam'],
         $row['functie'],
         $client,
         $userAccount
      );
   }

   public function getContactpersonByUserAccountId(int $userAccountId): ?ContactPerson
   {
      try {
         $dbh = $this->db_connect();

         $sql = "SELECT * FROM contactpersonen WHERE gebruikersAccountId = :gebruikersAccountId";

         $stmt = $dbh->prepare($sql);
         $stmt->bindParam(':gebruikersAccountId', $userAccountId);
         $stmt->execute();
         $row = $stmt->fetch(\PDO::FETCH_ASSOC);

         $contactperson = $this->createcontactpersonFromRow($row);
         $dbh = null;

         return $contactperson;
      } catch (PDOException $e) {
         print "Error!: " . $e->getMessage() . "<br/>";
      }
   }

   public function getContactpersonByEmail(string $email): ?ContactPerson
   {
      try {
         $dbh = $this->db_connect();

         $sql = "SELECT * FROM contactpersonen
         INNER JOIN gebruikersaccounts
         ON contactpersonen.gebruikersAccountId = gebruikersaccounts.gebruikersAccountId
         WHERE gebruikersaccounts.emailadres = :emailadres";

         $stmt = $dbh->prepare($sql);
         $stmt->bindParam(':emailadres', $email);
         $stmt->execute();
         $row = $stmt->fetch(\PDO::FETCH_ASSOC);

         $contactperson = $this->createcontactpersonFromRow($row);
         $dbh = null;

         return $contactperson;
      } catch (PDOException $e) {
         print "Error!: " . $e->getMessage() . "<br/>";
      }
   }

   public function insertNewContactPerson(string $firstName, string $lastName, string $function, Client $client, UserAccount $userAccount): ?ContactPerson
   {
      try {
         $dbh = $this->db_connect();

         $sql = "INSERT INTO contactpersonen  (voornaam, familienaam, functie, klantId, gebruikersAccountId) 
            VALUES (:voornaam, :familienaam, :functie, :klantId, :gebruikersAccountId)";

         $stmt = $dbh->prepare($sql);
         $stmt->bindParam(':voornaam', $firstName);
         $stmt->bindParam(':familienaam', $lastName);
         $stmt->bindParam(':functie', $function);
         $stmt->bindValue(':klantId', $client->getClientId());
         $stmt->bindValue(':gebruikersAccountId', $userAccount->getUserAccountId());
         $stmt->execute();

         $lastInsertId = $dbh->lastInsertId();
         $dbh = null;

         return new ContactPerson((int)$lastInsertId, $firstName, $lastName, $function, $client, $userAccount);
      } catch (PDOException $e) {
         print "Error!: " . $e->getMessage() . "<br/>";
      }
   }
}
