<?php

declare(strict_types=1);

namespace Business;


use Data\PlaceDAO;
use Entities\Place;

class PlaceService
{
   private PlaceDAO $placeDAO;

   public function __construct()
   {
      $this->placeDAO = new PlaceDAO();
   }

   public function getPlaceByPlaceId(int $PlaceId): ?Place
   {
      return $this->placeDAO->getPlaceByPlaceId($PlaceId);
   }

   public function getPlaceByZipAndName(int $zip, string $name): ?Place
   {
      return $this->placeDAO->getPlaceByZipAndName($zip, $name);
   }

   public function getPlaceByZip(int $zip): ?Place
   {
      $type = "zip";
      return $this->placeDAO->getPlace($zip, $type);
   }

   public function getPlaceByName(string $name): ?Place
   {
      $type = "name";
      return $this->placeDAO->getPlace($name, $type);
   }


   public function getAllPlaces(): array
   {
      return $this->placeDAO->getAllPlaces();
   }

   public function getPlaceByZipAndCity(int $zip, string $city) : ?Place
   {
      return $this->placeDAO->checkZipCityCombo((int)$zip, $city);
   }
}