<?php

declare(strict_types=1);

namespace Data;


use Data\BaseDAO;
use Entities\Place;
use Exceptions\PlaceDoesNotExistException;
use PDOException;

class PlaceDAO extends BaseDAO
{
   public function createPlaceFromRow($row): Place
   {
      return new Place(
         (int) $row['plaatsId'],
         (int) $row['postcode'],
         $row['plaats'],
      );
   }

   //This function returns a Place object with PlaceId as parameter. 
   public function getPlaceByPlaceId(int $placeId): ?Place
   {
      try {
         $dbh = $this->db_connect();

         $sql = "SELECT * FROM plaatsen WHERE plaatsId = :plaatsId";
         $stmt = $dbh->prepare($sql);
         $stmt->bindValue(":plaatsId", $placeId);

         $stmt->execute();
         $row = $stmt->fetch(\PDO::FETCH_ASSOC);

         $place = $this->createPlaceFromRow($row);
         $dbh = null;
         return $place;
      } catch (PDOException $e) {
         print "Error!: " . $e->getMessage() . "<br/>";
      }
   }

   public function getPlaceByZipAndName(int $zip, string $name): ?Place
   {
      try {
         $dbh = $this->db_connect();

         $sql = "SELECT * FROM plaatsen 
         WHERE postcode = :postcode AND plaats = :plaats ";

         $stmt = $dbh->prepare($sql);
         $stmt->bindValue(":postcode", $zip);
         $stmt->bindValue(":plaats", $name);
         $stmt->execute();

         $row = $stmt->fetch(\PDO::FETCH_ASSOC);
         if (!$row) {
            throw new PlaceDoesNotExistException();
         } else {
            $dbh = null;
            $place = $this->createPlaceFromRow($row);
            return $place;
         }
      } catch (PDOException $e) {
         print "Error!: " . $e->getMessage() . "<br/>";
      }
   }

   //This function returns a Place object with 'id', 'zip' or 'name' as parameter. 
   public function getPlace($value, $type): ?Place
   {
      try {
         $dbh = $this->db_connect();

         switch ($type) {
            case 'zip':
               $sql = "SELECT * FROM plaatsen WHERE postcode = :postcode";
               $stmt = $dbh->prepare($sql);
               $stmt->bindValue(":postcode", $value);
               break;
            case 'name':
               $sql = "SELECT * FROM plaatsen WHERE plaats = :plaats";
               $stmt = $dbh->prepare($sql);
               $stmt->bindValue(":plaats", $value);
               break;
         }

         $stmt->execute();
         $row = $stmt->fetch(\PDO::FETCH_ASSOC);
         if (!$row) {
            throw new PlaceDoesNotExistException();
         } else {
            $place = $this->createPlaceFromRow($row);
            $dbh = null;
            return $place;
         }
      } catch (PDOException $e) {
         print "Error!: " . $e->getMessage() . "<br/>";
      }
   }

   public function getAllPlaces(): array
   {
      $dbh = $this->db_connect();
      $stmt = $dbh->prepare("SELECT * FROM plaatsen ORDER BY postcode");
      $stmt->execute();
      $resultSet = $stmt->fetchAll(\PDO::FETCH_ASSOC);
      $placeList = array();
      foreach ($resultSet as $place) {
         $postcode = $place["postcode"];
         $placename = $place["plaats"];

         $placeList[$placename] = $postcode;
         ;
      }

      $dbh = null;

      return $placeList;
   }

   public function checkZipCityCombo(int $zip, string $place) : ?Place
   {
      $dbh = $this->db_connect();
      $sql = "select plaatsId, postcode, plaats from plaatsen where postcode like :zip and plaats like :place";
      $stmt = $dbh->prepare($sql);
      $stmt->execute(array(':zip'=>$zip, ':place'=>$place));
      $row = $stmt->fetch($dbh::FETCH_ASSOC);
      if($row) {
         $place = new Place((int)$row["plaatsId"], (int)$row["postcode"], $row["plaats"]);
         return $place;
      }
      $dbh = null;
      return null;
   }
}