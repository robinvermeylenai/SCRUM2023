<?php

declare(strict_types=1);

namespace Exceptions;

use Exception;

class PlaceDoesNotExistException extends Exception
{

   public function errorMessage()
   {
      //message beter uitschrijven!
      $message = "Geen postcode of plaats gevonden.";
      return $message;
   }
}