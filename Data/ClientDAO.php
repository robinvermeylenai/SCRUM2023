<?php

declare(strict_types=1);

namespace Data;

use Business\AddressService;
use Entities\Client;
use Entities\Place;
use Entities\Address;
use PDOException;

class ClientDAO extends BaseDAO
{
   public function createClientFromRow($row): ?Client
   {
      $addressServ = new AddressService();
      $billingAddress = $addressServ->getAddressByAddressId($row['facturatieAdresId']);
      $shippingAddress = $addressServ->getAddressByAddressId($row['leveringsAdresId']);

      return new Client(
         (int)$row['klantId'],
         $billingAddress,
         $shippingAddress
      );
   }

   //This function returns a Client with the clientId as parameter
   public function getClientByClientId(int $clientId): ?Client
   {
      try {
         $dbh = $this->db_connect();

         $sql = "SELECT * FROM klanten WHERE klantId = :klantId";

         $stmt = $dbh->prepare($sql);
         $stmt->bindParam(':klantId', $clientId);
         $stmt->execute();
         $row = $stmt->fetch(\PDO::FETCH_ASSOC);

         $client = $this->createClientFromRow($row);
         $dbh = null;

         return $client;
      } catch (PDOException $e) {
         print "Error!: " . $e->getMessage() . "<br/>";
      }
   }

   //This function inserts a new Address
   public function insertNewClient(Address $billingAddress, Address $shippingAddress): ?Client
   {
      try {
         $dbh = $this->db_connect();

         $sql = "INSERT INTO klanten (facturatieAdresId, leveringsAdresId) 
            VALUES (:facturatieAdresId, :leveringsAdresId)";

         $stmt = $dbh->prepare($sql);
         $stmt->bindValue(':facturatieAdresId', $billingAddress->getAddressId());
         $stmt->bindValue(':leveringsAdresId', $shippingAddress->getAddressId());
         $stmt->execute();

         $lastInsertId = $dbh->lastInsertId();
         $dbh = null;

         return new Client((int)$lastInsertId, $billingAddress, $shippingAddress);
      } catch (PDOException $e) {
         print "Error!: " . $e->getMessage() . "<br/>";
      }
   }
}