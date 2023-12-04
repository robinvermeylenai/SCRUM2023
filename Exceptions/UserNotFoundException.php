<?php

declare(strict_types=1);

namespace Exceptions;

use Exception;

class UserNotFoundException extends Exception
{

   public function errorMessage()
   {
      //$message = "Het opgegeven e-mailadres is niet gevonden. Controleer of het e-mailadres of wachtwoord correct is ingevoerd en probeer het opnieuw.<br>Als u zich nog niet heeft geregistreert: klik dan hier(link naar registratieformulier)";
      $message = "Onbekende gebruiker";
      return $message;
   }
}