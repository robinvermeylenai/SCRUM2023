<?php

declare(strict_types=1);

namespace Business;

use Entities\Person;
use Data\PersonDAO;
use Entities\UserAccount;
use Entities\Client;


class PersonService
{
   private PersonDAO $personDAO;

   public function __construct()
   {
      $this->personDAO = new PersonDAO;
   }

   public function getPersonByEmail(string $email): ?Person
   {
      return $this->personDAO->getPersonByEmail($email);
   }

   public function createNewPerson(Client $client, string $firstname, string $lastname, UserAccount $userAccount): ?Person
   {
      return $this->personDAO->insertNewPerson($client, $firstname, $lastname, $userAccount);
   }
}
