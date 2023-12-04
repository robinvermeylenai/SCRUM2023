<?php

declare(strict_types=1);

namespace Data;

use Business\ClientService;
use Business\UserAccountService;
use Entities\Person;
use Entities\UserAccount;
use Entities\Client;
use PDOException;

class PersonDAO extends BaseDAO
{
   public function createPersonFromRow($row): ?Person
   {
      $clientServ = new ClientService();
      $client = $clientServ->getClientByClientId($row['klantId']);

      $userAccountServ = new UserAccountService();
      $userAccount = $userAccountServ->getUserAccountByUserAccountId($row['gebruikersAccountId']);

      return new Person(
         $client,
         $row['voornaam'],
         $row['familienaam'],
         $userAccount
      );
   }

   public function getPersonByClientId(int $clientId): ?Person
   {
      try {
         $dbh = $this->db_connect();

         $sql = "SELECT * FROM natuurlijkepersonen WHERE klantId = :klantId";

         $stmt = $dbh->prepare($sql);
         $stmt->bindParam(':klantId', $clientId);
         $stmt->execute();
         $row = $stmt->fetch(\PDO::FETCH_ASSOC);

         $person = $this->createPersonFromRow($row);
         $dbh = null;

         return $person;
      } catch (PDOException $e) {
         print "Error!: " . $e->getMessage() . "<br/>";
      }
   }

   public function getPersonByEmail(string $email): ?Person
   {
      try {
         $dbh = $this->db_connect();

         $sql = "SELECT * FROM natuurlijkepersonen
         INNER JOIN gebruikersaccounts
         ON natuurlijkepersonen.gebruikersAccountId = gebruikersaccounts.gebruikersAccountId
         WHERE LOWER(gebruikersaccounts.emailadres) = LOWER(:emailadres)";

         $stmt = $dbh->prepare($sql);
         $stmt->bindParam(':emailadres', $email);
         $stmt->execute();
         $row = $stmt->fetch(\PDO::FETCH_ASSOC);

         $person = $this->createPersonFromRow($row);
         $dbh = null;

         return $person;
      } catch (PDOException $e) {
         print "Error!: " . $e->getMessage() . "<br/>";
      }
   }

   public function insertNewPerson(Client $client,string $firstname, string $lastname, UserAccount $userAccount): ?Person {
      try {
         $dbh = $this->db_connect();

         $sql = "INSERT INTO natuurlijkepersonen  (klantId, voornaam, familienaam, gebruikersAccountId) 
            VALUES (:klantId, :voornaam, :familienaam, :gebruikersAccountId)";

         $stmt = $dbh->prepare($sql);
         $stmt->bindValue(':klantId', $client->getClientId());
         $stmt->bindParam(':voornaam', $firstname );
         $stmt->bindParam(':familienaam', $lastname );
         $stmt->bindValue(':gebruikersAccountId', $userAccount->getUserAccountId());
         $stmt->execute();

         
         $dbh = null;

         return new Person($client, $firstname, $lastname, $userAccount);
      } catch (PDOException $e) {
         print "Error!: " . $e->getMessage() . "<br/>";
      }
   }

 }

