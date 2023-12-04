<?php

spl_autoload_register();
use Business\PlaceService;
use Business\PersonService;

//include of all necessary controllers for index page
session_start();

include_once('./SideMenuController.php');


$currentUrl = 'index.php';
if (isset($_GET['catId'])) {
    $currentUrl .= '?catId=' . $_GET['catId'];



}

$plcserv = new PlaceService;
$allPlaces = $plcserv->getAllPlaces();

// get Klant by ID

$profileSrvc = new PersonService;
$thisPerson1 = $profileSrvc->getPersonByClientId(1);
$thisPerson2 = $profileSrvc->getPersonByEmail('anoniemeKlant@prularia.com');
print_r($_SESSION);
print_r($thisPerson2);
// get Company if it is exists

// get Delivery AdressbyID

// get Shipping Adress by ID

?>

<html>

<head>
    <title></title>
    <link rel="stylesheet" href="./Design/css/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:wght@300;500;700&display=swap"
        rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>


</head>

<body>
    <header>

        <?php include_once("./Presentation/MainMenuHeader.php"); ?>
    </header>

    <aside>
        <?php include_once("./Presentation/SideMenu.php"); ?>
    </aside>

    <section class="product-grid">
        <?php
        include_once("./Presentation/Profile.php");

        ?>
    </section>

    <div class="footer">
        <?php include_once("./Presentation/Footer.php"); ?>
    </div>

</body>
<!-- <pre>
<?php // print_r($allPlaces); ?>
</pre> -->

</html>