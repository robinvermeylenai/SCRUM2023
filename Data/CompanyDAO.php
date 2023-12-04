<?php

declare(strict_types=1);

namespace Data;


use Entities\Company;
use Business\ClientService;
use Entities\Client;
use PDOException;

class CompanyDAO extends BaseDAO
{
   public function createCompanyFromRow($row): ?Company
   {
      $clientServ = new ClientService();
      $client = $clientServ->getClientByClientId($row['klantId']);

      return new Company(
         $client,
         $row['naam'],
         $row['btwNummer']
      );
   }

   public function getCompanyByClientId(int $clientId): ?Company
   {
      try {
         $dbh = $this->db_connect();

         $sql = "SELECT * FROM rechtspersonen WHERE klantId = :klantId";

         $stmt = $dbh->prepare($sql);
         $stmt->bindParam(':klantId', $clientId);
         $stmt->execute();
         $row = $stmt->fetch(\PDO::FETCH_ASSOC);

         $company = $this->createCompanyFromRow($row);
         $dbh = null;

         return $company;
      } catch (PDOException $e) {
         print "Error!: " . $e->getMessage() . "<br/>";
      }
   }

   public function insertNewCompany(Client $client, string $companyName, string $btwNumber): ?Company 
   {
      try {
         $dbh = $this->db_connect();

         $sql = "INSERT INTO rechtspersonen (klantId, naam, btwNummer) 
            VALUES (:klantId, :naam, :btwNummer)";

         $stmt = $dbh->prepare($sql);
         $stmt->bindValue(':klantId', $client->getClientId());
         $stmt->bindParam(':naam', $companyName);
         $stmt->bindParam(':btwNummer', $btwNumber);
         $stmt->execute();

         $dbh = null;

         return new Company($client, $companyName, $btwNumber);
      } catch (PDOException $e) {
         print "Error!: " . $e->getMessage() . "<br/>";
      }
   }
}

