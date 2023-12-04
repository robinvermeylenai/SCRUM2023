<?php

declare(strict_types=1);

namespace Data;

use Business\PlaceService;
use Data\BaseDAO;
use Entities\Address;
use Entities\Place;
use PDOException;

class AddressDAO extends BaseDAO
{
   public function createAdressFromRow($row): ?Address
   {
      $placeServ = new PlaceService();
      $place = $placeServ->getPlaceByPlaceId($row['plaatsId']);

      return new Address(
         (int)$row['adresId'],
         $row['straat'],
         $row['huisNummer'],
         $row['bus'],
         $place,
         (bool)$row['actief']
      );
   }

   //This function returns an Address with 'id' as parameter
   public function getAddressByAdressId(int $addressId): ?Address
   {
      try {
         $dbh = $this->db_connect();

         $sql = "SELECT * FROM adressen WHERE adresId = :adresId";

         $stmt = $dbh->prepare($sql);
         $stmt->bindParam(':adresId', $addressId);
         $stmt->execute();
         $row = $stmt->fetch(\PDO::FETCH_ASSOC);

         $address = $this->createAdressFromRow($row);
         $dbh = null;

         return $address;
      } catch (PDOException $e) {
         print "Error!: " . $e->getMessage() . "<br/>";
      }
   }

   public function existAddress(string $street, string $number, string $box, Place $place): ?Address
   {
      try {
         $dbh = $this->db_connect();

         $sql = "SELECT * FROM adressen WHERE LOWER(straat) = LOWER(:straat) AND huisNummer = :huisNummer AND bus = :bus AND plaatsId = :plaatsId";

         $stmt = $dbh->prepare($sql);
         $stmt->bindParam(':straat', $street);
         $stmt->bindParam(':huisNummer', $number);
         $stmt->bindParam(':bus', $box);
         $stmt->bindValue(':plaatsId', $place->getPlaceId());
         $stmt->execute();

         $row = $stmt->fetch(\PDO::FETCH_ASSOC);

         $dbh = null;

         if ($row) {
            return $this->createAdressFromRow($row);
         } else {
            return null;
         }
      } catch (PDOException $e) {
         print "Error!: " . $e->getMessage() . "<br/>";
      }
   }


   //This function inserts a new Address
   public function insertNewAddress(string $street, string $number, ?string $box, Place $place): ?Address
   {
      $inUse = true;

      try {
         $dbh = $this->db_connect();

         $sql = "INSERT INTO adressen (straat, huisNummer, bus, plaatsId, actief) 
            VALUES (:straat, :huisNummer, :bus, :plaatsId, :actief)";

         $stmt = $dbh->prepare($sql);
         $stmt->bindParam(':straat', $street);
         $stmt->bindParam(':huisNummer', $number);
         $stmt->bindParam(':bus', $box);
         $stmt->bindValue(':plaatsId', $place->getPlaceId());
         $stmt->bindParam(':actief', $inUse);
         $stmt->execute();

         $lastInsertId = $dbh->lastInsertId();
         $dbh = null;

         return new Address((int)$lastInsertId, $street, $number, $box, $place, (bool)$inUse);
      } catch (PDOException $e) {
         print "Error!: " . $e->getMessage() . "<br/>";
      }
   }
}
