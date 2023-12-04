<?php

declare(strict_types=1);

session_start();
spl_autoload_register();

use Business\AddressService;
use Business\ClientService;
use Business\CompanyService;
use Business\ContactPersonService;
use Business\PersonService;
use Business\PlaceService;
use Business\UserAccountService;
use Exceptions\PlaceDoesNotExistException;
use Data\AddressDAO;
use Data\ClientDAO;
use Data\PersonDAO;
use Data\UserAccountDAO;

$PlaceServ = new PlaceService();
$PlaceException = new PlaceDoesNotExistException();

//include of all necessary controllers for index page

include_once('./SideMenuController.php');

$currentUrl = $activePage = 'registrationController.php';

$errors_natuurlijkepersoon = array();
$errors_rechtspersoon = array();

$natuurlijkepersoonChecked = '';
$rechtspersoonChecked = '';

//persoonlijke info
$voornaam = '';
$familienaam = '';
$emailadres = '';
$wachtwoord = '';
$herhaalwachtwoord = '';
//Bedrijfsinformatie (rechtspersoon)
$company = '';
//Leveradres
$plaatsLevering = '';
$postcodeLevering = '';
$straatLevering = '';
$huisNummerLevering = '';
$busLevering = '';
//Facturatieadres
$plaatsFacturatie = '';
$postcodeFacturatie = '';
$straatFacturatie = '';
$huisNummerFacturatie = '';
$busFacturatie = '';

if(isset($_POST['company-registration'])) {

    $rechtspersoonChecked = 'checked';

    //quick sanitize

    //persoonlijke info
    $voornaam = trim($_POST['voornaam']);
    $familienaam = trim($_POST['familienaam']);
    $emailadres = trim($_POST['emailadres']);
    $wachtwoord = trim($_POST['wachtwoord']);
    $herhaalwachtwoord = trim($_POST['herhaalwachtwoord']);
    //Bedrijfsinformatie (rechtspersoon)
    $company = trim($_POST['company']);
    $btwNummer = trim($_POST['btwNummer']);
    $functie = trim($_POST['function']);
    //Leveradres
    $plaatsLevering = trim($_POST['delivery-city']);
    $postcodeLevering = trim($_POST['delivery-zip']);
    $straatLevering = trim($_POST['delivery-street']);
    $huisNummerLevering = trim($_POST['delivery-house-number']);
    $busLevering = trim($_POST['delivery-bus']);
    //Facturatieadres
    $plaatsFacturatie = trim($_POST['delivery-city']);
    $postcodeFacturatie = trim($_POST['delivery-zip']);
    $straatFacturatie = trim($_POST['delivery-street']);
    $huisNummerFacturatie = trim($_POST['delivery-house-number']);
    $busFacturatie = trim($_POST['delivery-bus']);

    //errorchecks

    //persoonlijke info
    if($voornaam === '') {
        $errors_rechtspersoon[] = 'Geen voornaam';
    }
    if($familienaam === '') {
        $errors_rechtspersoon[] = 'Geen familienaam';
    }
    if($emailadres === '') {
        $errors_rechtspersoon[] = 'Geen email';
    }
    if($wachtwoord === '') {
        $errors_rechtspersoon[] = 'Geen wachtwoord';
    } else {
        if($herhaalwachtwoord === '') {
            $errors_rechtspersoon[] = 'Herhaal wachtwoord';
        } elseif($wachtwoord !== $herhaalwachtwoord) {
            $errors_rechtspersoon[] = 'Wachtwoord komt niet overeen met herhaald wachtwoord';
        }
    }
    if($company === '') {
        $errors_rechtspersoon[] = 'Geen bedrijf';
    }
    if($btwNummer === '') {
        $errors_rechtspersoon[] = 'Geen BTW nummer';
    } elseif(strlen($btwNummer) <> 10) {
        $errors_rechtspersoon[] = 'Ongeldig BTW nummer';
    }
    //Leveradres
    if($plaatsLevering === '') {
        $errors_rechtspersoon[] = 'Geen gemeente (Leveradres)';
    }
    if($postcodeLevering === '') {
        $errors_rechtspersoon[] = 'Geen postcode (Leveradres)';
    } elseif(strlen($postcodeLevering) <> 4) {
        $errors_rechtspersoon[] = 'Geen geldige postcode (Leveradres)';
    }
    if($straatLevering === '') {
        $errors_rechtspersoon[] = 'Geen straat (Leveradres)';
    }
    if($huisNummerLevering === '') {
        $errors_rechtspersoon[] = 'Geen huisnummer (Leveradres)';
    }
    //Facturatieadres
    if($plaatsFacturatie === '') {
        $errors_rechtspersoon[] = 'Geen gemeente (Facturatieadres)';
    }
    if($postcodeFacturatie === '') {
        $errors_rechtspersoon[] = 'Geen postcode (Facturatieadres)';
    } elseif(strlen($postcodeFacturatie) <> 4) {
        $errors_rechtspersoon[] = 'Geen geldige postcode (Facturatieadres)';
    }
    if($straatFacturatie === '') {
        $errors_rechtspersoon[] = 'Geen straat (Facturatieadres)';
    }
    if($huisNummerFacturatie === '') {
        $errors_rechtspersoon[] = 'Geen huisnummer (Facturatieadres)';
    }

    if(count($errors_rechtspersoon) === 0) {

        //add to database        
        $placeServ = new PlaceService();
        $placeFacturatie = $placeServ->getPlaceByZipAndName((int)$postcodeFacturatie, $plaatsFacturatie);
        $placeLevering = $placeServ->getPlaceByZipAndName((int)$postcodeLevering, $plaatsLevering);
        $addressServ = new AddressService();
        $addressFacturatie = $addressServ->createNewAddress($straatFacturatie, $huisNummerFacturatie, $busFacturatie, $placeFacturatie);
        $addressLevering = $addressServ->createNewAddress($straatLevering, $huisNummerLevering, $busLevering, $placeLevering);
        $clientServ = new ClientService();
        $client = $clientServ->createNewClient($addressFacturatie, $addressLevering);
        $userAccountServ = new UserAccountService();
        $userAccount = $userAccountServ->createNewUserAccount($emailadres, $wachtwoord, $herhaalwachtwoord);
        $companyServ = new CompanyService();
        $company = $companyServ->createNewCompany($client, $company, $btwNummer);
        $contactPersonServ = new ContactPersonService();
        $contactPerson = $contactPersonServ->createNewContactPerson($voornaam, $familienaam, $functie, $client, $userAccount);

        $_SESSION['user'] = serialize($contactPerson);
        header('Location: index.php?message=registered');
        exit;
    }
} elseif(isset($_POST['person-registration'])) {

    $natuurlijkepersoonChecked = 'checked';

    //persoonlijke info
    $voornaam = trim($_POST['voornaam']);
    $familienaam = trim($_POST['familienaam']);
    $emailadres = trim($_POST['emailadres']);
    $wachtwoord = trim($_POST['wachtwoord']);
    $herhaalwachtwoord = trim($_POST['herhaalwachtwoord']);
    //Leveradres
    $plaatsLevering = trim($_POST['delivery-city']);
    $postcodeLevering = trim($_POST['delivery-zip']);
    $straatLevering = trim($_POST['delivery-street']);
    $huisNummerLevering = trim($_POST['delivery-house-number']);
    $busLevering = trim($_POST['delivery-bus']);
    //Facturatieadres
    $plaatsFacturatie = trim($_POST['billing-city']);
    $postcodeFacturatie = trim($_POST['billing-zip']);
    $straatFacturatie = trim($_POST['billing-street']);
    $huisNummerFacturatie = trim($_POST['billing-house-number']);
    $busFacturatie = trim($_POST['billing-bus']);

    //persoonlijke info
    if($voornaam === '') {
        $errors_natuurlijkepersoon[] = 'Geen voornaam';
    }
    if($familienaam === '') {
        $errors_natuurlijkepersoon[] = 'Geen familienaam';
    }
    if($emailadres === '') {
        $errors_natuurlijkepersoon[] = 'Geen email';
    }
    if($wachtwoord === '') {
        $errors_natuurlijkepersoon[] = 'Geen wachtwoord';
    } else {
        if($herhaalwachtwoord === '') {
            $errors_natuurlijkepersoon[] = 'Herhaal wachtwoord';
        } elseif($wachtwoord !== $herhaalwachtwoord) {
            $errors_natuurlijkepersoon[] = 'Wachtwoord komt niet overeen met herhaald wachtwoord';
        }
    }
    //Leveradres
    if($plaatsLevering === '') {
        $errors_natuurlijkepersoon[] = 'Geen gemeente (Leveradres)';
    }
    if($postcodeLevering === '') {
        $errors_natuurlijkepersoon[] = 'Geen postcode (Leveradres)';
    } elseif(strlen($postcodeLevering) <> 4 OR !is_numeric($postcodeLevering)) {
        $errors_natuurlijkepersoon[] = 'Geen geldige postcode (Leveradres)';
    }
    if($straatLevering === '') {
        $errors_natuurlijkepersoon[] = 'Geen straat (Leveradres)';
    }
    if($huisNummerLevering === '') {
        $errors_natuurlijkepersoon[] = 'Geen huisnummer (Leveradres)';
    }
    try {
        $placeCheck = $PlaceServ->getPlaceByZipAndName((int)$postcodeLevering, $plaatsLevering);
    } catch(PlaceDoesNotExistException $e) {
        $errors_natuurlijkepersoon[] = 'Combinatie gemeente en postcode onbekend (Leveradres)';
    }
    

    //Facturatieadres
    if($plaatsFacturatie === '') {
        $errors_natuurlijkepersoon[] = 'Geen gemeente (Facturatieadres)';
    }
    if($postcodeFacturatie === '') {
        $errors_natuurlijkepersoon[] = 'Geen postcode (Facturatieadres)';
    } elseif(strlen($postcodeFacturatie) <> 4 OR !is_numeric($postcodeFacturatie)) {
        $errors_natuurlijkepersoon[] = 'Geen geldige postcode (Facturatieadres)';
    }
    if($straatFacturatie === '') {
        $errors_natuurlijkepersoon[] = 'Geen straat (Facturatieadres)';
    }
    if($huisNummerFacturatie === '') {
        $errors_natuurlijkepersoon[] = 'Geen huisnummer (Facturatieadres)';
    }
    try {
        $placeCheck = $PlaceServ->getPlaceByZipAndName((int)$postcodeFacturatie, $plaatsFacturatie);
    } catch(PlaceDoesNotExistException $e) {
        $errors_natuurlijkepersoon[] = 'Combinatie gemeente en postcode onbekend (Facturatieadres)';
    }

    if(count($errors_natuurlijkepersoon) === 0) {

        //add to database        
        $placeServ = new PlaceService();
        $placeFacturatie = $placeServ->getPlaceByZipAndName((int)$postcodeFacturatie, $plaatsFacturatie);
        $placeLevering = $placeServ->getPlaceByZipAndName((int)$postcodeLevering, $plaatsLevering);
        $addressServ = new AddressService();
        $addressFacturatie = $addressServ->createNewAddress($straatFacturatie, $huisNummerFacturatie, $busFacturatie, $placeFacturatie);
        $addressLevering = $addressServ->createNewAddress($straatLevering, $huisNummerLevering, $busLevering, $placeLevering);
        $clientServ = new ClientService();
        $client = $clientServ->createNewClient($addressFacturatie, $addressLevering);
        $userAccountServ = new UserAccountService();
        $userAccount = $userAccountServ->createNewUserAccount($emailadres, $wachtwoord, $herhaalwachtwoord);
        $personServ = new PersonService();
        $person = $personServ->createNewPerson($client, $voornaam, $familienaam, $userAccount);

        $_SESSION['user'] = serialize($person);
        //header location naar index
        header('Location: index.php?message=registered');
        exit;
    }


} else {
    $natuurlijkepersoonChecked = 'checked';
}




?>

<!DOCTYPE html>
    <head>
        <title>Prularia - Registratieformulier</title>
        <link rel="stylesheet" href="./Design/css/main.css">
        <link rel="stylesheet" href="./Design/css/popup.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link
            href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:wght@300;500;700&display=swap"
            rel="stylesheet">
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script src="./Design/js/main.js"></script>
    </head>

    <body>
        <header>
            <?php include_once("./Presentation/MainMenuHeader.php"); ?>
        </header>

        <section class="fullWidth">
            <?php
            include_once("./Presentation/Registration.php");
            //include_once("./Presentation/Login.php");
            //include_once("./Presentation/Registration-person.php");
            //include_once("./Presentation/Registration-company.php");
            ?>
        </section>

        <div class="footer">
            <?php include_once("./Presentation/Footer.php"); ?>
        </div>

    </body>
</html>