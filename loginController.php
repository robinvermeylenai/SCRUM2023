<?php

declare(strict_types=1);
@session_start();

use Business\CompanyService;
use Business\UserAccountService;
use Exceptions\UserNotFoundException;

spl_autoload_register();

if (isset($_GET['action']) && ($_GET['action']) === "login") {

   $email = $_POST['email'];
   $password = $_POST['password'];

   // check if email address and password are correct
   try {
      $userAccountServ = new UserAccountService();
      $userAccount = $userAccountServ->getUserAccount($email, $password);


      // check if account is disabled 
      $disabled = $userAccount->getDisabled();

      if ($disabled === true) {
         $_SESSION['error'] = "Uw account is niet actief. <a href=\"mailto:jan.detavernier@vdabcampus.be\">Contacteer ons</a>";
         header("Location: index.php?showLogin=true");
         exit;
      } else {
         // check if email address is associated with a natural or  a contact person
         $count = $userAccountServ->getCountContactPerson($email);
         //$count -> 0 = natural person, 1 = contact person 
         if ($count === 1) {
               // get the Contactperson Object
               $contactPerson = $userAccountServ->getContactPerson($email);
               // get the Company Object
               $clientId = $contactPerson->getClient()->getClientId();
               $companyServ = new CompanyService();
               $company = $companyServ->getCompany($clientId);
               $_SESSION['user'] = serialize($contactPerson);
               $_SESSION['company'] = serialize($company);

         } else {

               // get the Person Object
               $person = $userAccountServ->getPerson($email);
               $_SESSION['user'] = serialize($person);
         }

         header("Location: index.php");
         exit;
      }
      // user not found in database or invalid password
   } catch (UserNotFoundException $e) {
      
      $_SESSION['error'] = $e->errorMessage();
      header("Location: index.php?showLogin=true");
      exit;
   } 
}

include_once("./Presentation/Login.php");