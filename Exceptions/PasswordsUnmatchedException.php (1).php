<?php

declare(strict_types=1);

namespace Exceptions;

use Exception;

class PasswordsUnmatchedException extends Exception
{

   public function errorMessage()
   {
      $message = "De wachtwoorden zijn niet gelijk.";
      return $message;
   }
}
