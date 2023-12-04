<?php

declare(strict_types=1);

namespace Business;


use Data\ContactPersonDAO;
use Entities\ContactPerson;
use Entities\Client;
use Entities\UserAccount;

class ContactPersonService
{
   private ContactPersonDAO $contactPersonDAO;

   public function __construct()
   {
      $this->contactPersonDAO = new ContactPersonDAO;
   }

   public function getContactPersonByEmail(string $email): ?ContactPerson
   {
      return $this->contactPersonDAO->getContactPersonByEmail($email);
   }

   public function createNewContactPerson(string $firstName, string $lastName, string $function, Client $client, UserAccount $userAccount): ?ContactPerson
   {
      return $this->contactPersonDAO->insertNewContactPerson($firstName, $lastName, $function, $client, $userAccount);
   }
}