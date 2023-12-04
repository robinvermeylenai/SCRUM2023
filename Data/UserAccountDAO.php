<?php

declare(strict_types=1);

namespace Data;


use Entities\UserAccount;
use Exceptions\UserNotFoundException;
use Exceptions\EmailInvalidException;
use Exceptions\PasswordsUnmatchedException;
use PDOException;

class UserAccountDAO extends BaseDAO
{
   public function createUserAccountFromRow($row): ?UserAccount
   {
      return new UserAccount(
         (int)$row['gebruikersAccountId'],
         $row['emailadres'],
         $row['paswoord'],
         (bool)$row['disabled']
      );
   }

   public function getUserAccountByUserAcccountId(int $UserAccountId): ?UserAccount
   {
      try {
         $dbh = $this->db_connect();

         $sql = "SELECT * FROM gebruikersaccounts WHERE gebruikersAccountId = :gebruikersAccountId";

         $stmt = $dbh->prepare($sql);
         $stmt->bindParam(':gebruikersAccountId', $UserAccountId);
         $stmt->execute();
         $row = $stmt->fetch(\PDO::FETCH_ASSOC);

         $client = $this->createUserAccountFromRow($row);
         $dbh = null;

         return $client;
      } catch (PDOException $e) {
         print "Error!: " . $e->getMessage() . "<br/>";
      }
   }

   public function getUserAccountByEmailAndPassWord(string $email, string $password): ?UserAccount
   {
      try {
         $dbh = $this->db_connect();

         $sql = "SELECT * FROM gebruikersaccounts WHERE LOWER(emailadres) = LOWER(:emailadres)";

         $stmt = $dbh->prepare($sql);
         $stmt->bindValue(":emailadres", $email);
         $stmt->execute();
         $row = $stmt->fetch(\PDO::FETCH_ASSOC);

         $dbh = null;
        
         if (!$row) {
            throw new UserNotFoundException();
         }

         if ($row['paswoord'] !== $password) {
            throw new UserNotFoundException();
         }

         /*Deze code is nodig nadat er een passwordhash is gedaan bij de registratie
         $isPasswordValid = password_verify($password, $row["paswoord"]);

         if (!$isPasswordValid) {
            throw new UserNotFoundException();
         }*/
         
         $userAccount  = $this->createUserAccountFromRow($row);
         $dbh = null;

         return $userAccount;
         
      } catch (\PDOException $e) {
         print "Error!: " . $e->getMessage() . "<br/>";
      }
      return null;
   }

   public function getContactPersonCountByEmail(string $email): int
   {
      try {
         $dbh = $this->db_connect();

         $sql = "SELECT COUNT(*) 
        FROM contactpersonen
        INNER JOIN gebruikersaccounts
        ON contactpersonen.gebruikersAccountId = gebruikersaccounts.gebruikersAccountId 
        WHERE LOWER(gebruikersaccounts.emailadres) = LOWER(:emailadres)";
         

         $stmt = $dbh->prepare($sql);
         $stmt->bindParam(':emailadres', $email);
         $stmt->execute();

         return (int) $stmt->fetchColumn();
         $dbh = null;
      } catch (PDOException $e) {
         print "Error!: " . $e->getMessage() . "<br/>";
      }
   }

   public function insertNewUserAccount(string $email, string $password, string $passwordRepeat): ?UserAccount 
   {
      
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
         throw new EmailInvalidException();
      }
      if ($password !== $passwordRepeat) {
         throw new PasswordsUnmatchedException();
      }
      
      //$password = password_hash($password, PASSWORD_DEFAULT);
      try {
         $dbh = $this->db_connect();

         $sql = "INSERT INTO gebruikersaccounts  (emailadres, paswoord) 
            VALUES (:emailadres, :paswoord)";

         $stmt = $dbh->prepare($sql);
         $stmt->bindParam(':emailadres', $email);
         $stmt->bindParam(':paswoord', $password );
         $stmt->execute();

         $lastInsertId = $dbh->lastInsertId();
         $disabled = false;
         $dbh = null;

         return new UserAccount((int)$lastInsertId, $email, $password, $disabled);
      } catch (PDOException $e) {
         print "Error!: " . $e->getMessage() . "<br/>";
      }
   }
}





