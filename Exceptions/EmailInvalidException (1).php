<?php

declare(strict_types=1);

namespace Exceptions;

use Exception;

class EmailInvalidException extends Exception
{

   public function errorMessage()
   {
      $message = "Dit email-adres is al in gebruik.";
      return $message;
   }
}
