<?php

declare(strict_types=1);

spl_autoload_register();

use Business\AddressService;
use Business\ClientService;
use Business\PersonService;
use Business\PlaceService;
use Business\UserAccountService;
use Data\AddressDAO;
use Data\ClientDAO;
use Data\CompanyDAO;
use Data\ContactPersonDAO;
use Data\PersonDAO;
use Data\UserAccountDAO;

/*
$billingAddressServ = new AddressService();
$billingAddress = $billingAddressServ->getAddressByAddressId(2);

$shippingAddressServ = new AddressService();
$shippingAddress = $shippingAddressServ->getAddressByAddressId(3);



$clientDAO = new ClientDAO();
$client = $clientDAO->insertNewClient($billingAddress, $shippingAddress);

print("<pre>");
print_r($client);
print("</pre>");

$userAccountServ = new UserAccountService();
$userAccount =  $userAccountServ->getUserAccountByUserAccountId(3);

$personDAO = new PersonDAO;
$person = $personDAO->insertNewPerson($client, "jurgen", "Lauwers", $userAccount);
print("<pre>");
print_r($person);
print("</pre>");
*/
/*
$userAccountDAO = new UserAccountDAO();
$userAccount = $userAccountDAO->insertNewUserAccount("jlauwers@kotmail.com", "123", "123");
print("<pre>");
print_r($userAccount);
print("</pre>");
*/

$firstName = "bJurgen";
$lastName = "bLauwers";
$function = "btester";
$email = "bjlauwers@snotmail.com";
$password = "b123";
$passwordRepeat = "b123";
$bStreet = "bLange Steenstraat";
$bNumber = "b26";
$bBox = "";
$bZip = 9000;
$bPlace = "Gent";
$sStreet = "bLange Steenstraat";
$sNumber = "26";
$sBox = "";
$sZip = 9000;
$sPlace = "Gent";

$placeServ = new PlaceService();
$place = $placeServ->getPlaceByZipAndName($bZip, $bPlace);
$addressServ = new AddressService();
$address = $addressServ->createNewAddress($bStreet, $bNumber, $bBox, $place);
$clientServ = new ClientService();
$client = $clientServ->createNewClient($address, $address);
/*
$companyDAO = new CompanyDAO();
$company  = $companyDAO->insertNewCompany($client, "mijnbedrijf", "1234567890");
*/

$userAccountServ = new UserAccountService();
$userAccount = $userAccountServ->createNewUserAccount($email, $password, $passwordRepeat);
/*
$personServ = new PersonService();
$person = $personServ->createNewPerson($client, $firstName, $lastName, $userAccount);
*/
$contantPersonServ = new ContactPersonDAO();
$contactPerson = $contantPersonServ->insertNewContactPerson($firstName, $lastName, $function, $client, $userAccount);

print("<pre>");
print_r($company);
print("</pre>");







