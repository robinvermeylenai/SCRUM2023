<?php

declare(strict_types=1);

namespace Business;

use Data\UserAccountDAO;
use Entities\Company;
use Entities\Person;
use Entities\ContactPerson;
use Entities\UserAccount;

class UserAccountService
{
   private UserAccountDAO $userAccountDAO;

   public function __construct()
   {
      $this->userAccountDAO = new UserAccountDAO;
   }

   public function getUserAccountByUserAccountId(int $userAccountId): ?UserAccount
   {
      return $this->userAccountDAO->getUserAccountByUserAcccountId($userAccountId);
   }

   public function getUserAccount(string $email, string $password): ?UserAccount
   {
      return $this->userAccountDAO->getUserAccountByEmailAndPassWord($email, $password);
   }

   public function getCountContactPerson(string $email): int
   {
      return $this->userAccountDAO->getContactPersonCountByEmail($email);
   }

   public function getPerson(string $email): ?Person
   {
      $personServ = new PersonService();
      $person = $personServ->getPersonByEmail($email);
      return $person;
   }

   public function getContactPerson(string $email): ?ContactPerson
   {
      $contactPersonServ = new ContactPersonService();
      $contactPerson = $contactPersonServ->getContactPersonByEmail($email);
      return $contactPerson;
   }

   public function createNewUserAccount(string $email, string $password, string $passwordRepeat): ?UserAccount 
   {
      return $this->userAccountDAO->insertNewUserAccount($email, $password, $passwordRepeat);
   }

   //This data has te be stored in fuction of the presentation and controller
   public function storePersonDataInSession(Person $person)
   {
      $_SESSION['clientid'] = $person->getClient()->getClientId();
      $_SESSION['firstname'] = $person->getFirstName();
      $_SESSION['lastname'] = $person->getLastName();
      $_SESSION['email'] = $person->getUserAccount()->getEmail();
      $_SESSION['billingAddress'] = $person->getClient()->getBillingAddress();
      $_SESSION['shippingAddress'] = $person->getClient()->getShippingAddress();
   }
   
   //This data has te be stored in fuction of the presentation and controller
   public function storeContactPersonAndCompanyDataInSession(ContactPerson $contactPerson, Company $company)
   {
      $_SESSION['clientid'] = $contactPerson->getClient()->getClientId();
      $_SESSION['firstname'] = $contactPerson->getFirstName();
      $_SESSION['lastname'] = $contactPerson->getLastName();
      $_SESSION['function'] = $contactPerson->getFunction();
      $_SESSION['email'] = $contactPerson->getUserAccount()->getEmail();
      $_SESSION['companyname'] = $company->getCompanyName();
      $_SESSION['btwnumber'] = $company->getBtwNumber();
      $_SESSION['billingAddress'] = $contactPerson->getClient()->getBillingAddress();
      ;
      $_SESSION['shippingAddress'] = $contactPerson->getClient()->getShippingAddress();
   }
}