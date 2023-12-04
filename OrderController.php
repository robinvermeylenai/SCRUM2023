<?php

declare(strict_types=1);
session_start();
spl_autoload_register();

use Business\PlaceService;
use Business\AddressService;
use Business\ClientService;
use Entities\Place;
use Business\OrderDetailService;
use Business\OrderService;
use Entities\Order;
use Entities\Address;
include_once('./SideMenuController.php');
include_once("CartController.php");

$placeServ = new PlaceService();
$postList = "";

$checked = "checked";
$hidden = "hidden";

//$placeList = $placeServ->searchPlaces("");

/*if(isset($_POST["searchDeliveryZipCityBtn"])) {
    $deliveryPlaceList = $placeServ->searchPlaces(htmlspecialchars(trim($_POST["searchDeliveryZipCity"])));
    $postList = $_POST;
    (!isset($_POST["noInvoiceAddress"])) ? $checked = "" : $checked = "checked";
    include_once("Presentation/Order.php");
} elseif(isset($_POST["searchInvoiceZipCityBtn"])) {
    $invoicePlaceList = $placeServ->searchPlaces(htmlspecialchars(trim($_POST["searchInvoiceZipCity"])));
    $postList = $_POST;
    include_once("Presentation/Order.php");
} <else>*/
if(isset($_POST["placeOrder"])) {
    //form has been posted, check values, then continue to payment
    $postList = $_POST;

    $errorList = array();

    // Validation for orderLastName field
    if (empty($postList["orderLastName"])) {
        $errorList["orderLastName"] = "Gelieve een naam in te vullen";
    } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $postList["orderLastName"])) {
        $errorList["orderLastName"] = "Alleen letters, spaties, apostrofs en streepjes toegestaan";
    }

    // Validation for orderFirstName field
    if (empty($postList["orderFirstName"])) {
        $errorList["orderFirstName"] = "Gelieve een voornaam in te vullen";
    } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $postList["orderFirstName"])) {
        $errorList["orderFirstName"] = "Alleen letters, spaties, apostrofs en streepjes toegestaan";
    }

    // Validation for deliveryStreet field
    if (empty($postList["deliveryStreet"])) {
        $errorList["deliveryStreet"] = "Gelieve een straatnaam in te vullen";
    }

    // Validation for deliveryNumber field
    if (empty($postList["deliveryNumber"])) {
        $errorList["deliveryNumber"] = "Gelieve een huisnummer in te vullen";
    }
    // Validation for deliveryZip field
    if (empty($postList["deliveryZip"])) {
        $errorList["deliveryZip"] = "Gelieve een postcode in te vullen";
    } elseif (!is_numeric($postList["deliveryZip"]) || !($postList["deliveryZip"] >= 1000 && $postList["deliveryZip"] <= 9999)) {
        echo $postList["deliveryZip"];
        $errorList["deliveryZip"] = "Gelieve een geldige postcode in te vullen";
    }

    // Validation for deliveryCity field
    if (empty($postList["deliveryCity"])) {
        $errorList["deliveryCity"] = "Gelieve een stad in te vullen";
    } elseif (!preg_match('/^[a-zA-Z]+$/', $postList["deliveryCity"])) {
        $errorList["deliveryCity"] = "De stad mag alleen letters bevatten";
    }

    // Checking that zip/city is a valid combo
    if(!empty($postList["deliveryZip"]) && !empty($postList["deliveryCity"])) {
        $place = $placeServ->getPlaceByZipAndCity((int)$postList["deliveryZip"], $postList["deliveryCity"]);
        if(is_null($place)) {
            // no valid zip/city combo
            $errorList["deliveryZipCityCombo"] = "Deze postcode en stad combinatie bestaat niet.";
        }
    }

    // Validate invoiceStreet
    if (empty($postList["noInvoiceAddress"]) && empty($postList["invoiceStreet"])) {
        $errorList["invoiceStreet"] = "Gelieve een facturatieadres in te vullen.";
        $hidden = "";
    }

    // Validate invoiceNumber
    if (empty($postList["noInvoiceAddress"]) && empty($postList["invoiceNumber"])) {
        $errorList["invoiceNumber"] = "Gelieve een huisnummer in te vullen.";
    }

    // Validation for invoiceZip field
    if (empty($postList["noInvoiceAddress"])) {
        if (empty($postList["invoiceZip"])) {
            $errorList["invoiceZip"] = "Gelieve een postcode in te vullen";
        } elseif (!is_numeric($postList["invoiceZip"]) || !($postList["invoiceZip"] >= 1000 && $postList["invoiceZip"] <= 9999))  {
            $errorList["invoiceZip"] = "Gelieve een geldige postcode in te vullen";
        }
        $hidden = "";
        $checked = "";
    } else { //for when corrections are being made and noInvoiceAddress gets ticked, to avoid filled out invoice fields still throwing errors
        unset($postList["invoiceStreet"]);
        unset($postList["invoiceNumber"]);
        unset($postList["invoiceBox"]);
        unset($postList["invoiceZip"]);
        unset($postList["invoiceCity"]);
    }
    // Validate invoiceCity
    if (empty($postList["noInvoiceAddress"]) && empty($postList["invoiceCity"])) {
        $errorList["invoiceCity"] = "Gelieve een stad in te vullen";
    }
    // Checking that zip/city is a valid combo
    if(!empty($postList["invoiceZip"]) && !empty($postList["invoiceCity"])) {
        $place = $placeServ->getPlaceByZipAndCity((int)$postList["invoiceZip"], $postList["invoiceCity"]);
        if(is_null($place)) {
            // no valid zip/city combo
            $errorList["invoiceZipCityCombo"] = "Deze postcode en stad combinatie bestaat niet.";
        }
    }

    // If there are any errors, display the form again with the error messages
    if (!empty($errorList)) {
        include_once("Presentation/Order.php");
    } else {
        // values give no error's
        // Redirect to paymentpage
        $_SESSION["postList"] = $postList;
        include_once("Presentation/Payment.php");
    }
} elseif(isset($_POST["payOrder"])) { //payment form has been posted, check action code, then write to db
    /*if(isset($_POST["actionCode"]) && $_POST["actionCode"]!="") {
        
    }*/
    //start transaction with database updates; end with commit to db
    //Add to adressen - get adresId
    /// insert into adressen (straat, huisNummer, bus, plaatsId, actief) values ($postList["deliveryStreet"],$postList["deliveryNumber"],
    /// $postList["deliveryBus"], $deliveryPlace->getId(), 1)
    //Add to klanten - get klantId
    /// insert into klanten (leveringsAdresId, facturatieAdresId) values (deliveryPlace->getId(), invoicePlace->getId())
    //Add to bestellingen - get bestelId
    /// create Order object with correct date info and 0 as orderId
    //Add to bestellijnen - cartList
    $postList = $_SESSION["postList"];
    $addressServ = new AddressService();
    $clientServ = new ClientService();
    $deliveryPlace = $placeServ->getPlaceByZipAndCity((int) $postList["deliveryZip"], $postList["deliveryCity"]);
    $delAddress = $addressServ->createNewAddress($postList["deliveryStreet"], $postList["deliveryNumber"], $postList["deliveryBox"] ?? "", $deliveryPlace);
    if(isset($postList["invoiceStreet"])){
        //separate invoice info entered
        $invoicePlace = $placeServ->getPlaceByZipAndCity((int) $postList["invoiceZip"], $postList["invoiceCity"]);
        $invoiceAddress = $addressServ->createNewAddress($postList["invoiceStreet"], $postList["invoiceNumber"], $postList["invoiceBox"] ?? "", $invoicePlace);    
    } else {
        $invoiceAddress = $delAddress;
    }
    $client = $clientServ->createNewClient($invoiceAddress, $delAddress);
    $order = new Order(0, date("Y-m-d G:i:s"), $client->getClientId(), ($_POST["paymentMethod"] == 1) ? true : false, "", (int) $_POST["paymentMethod"], false, "", "", 
    1, false, "", "", $postList["orderFirstName"], $postList["orderLastName"], $invoiceAddress->getAddressId(), $delAddress->getAddressId());
    $orderServ = new OrderService;
    $order = $orderServ->add($order);
    $odServ = new OrderDetailService();
    foreach($cartList as $cartItem){
        $cartItem->setOrderId((int) $order->getId());
        $cartItem = $odServ->create($cartItem);
    }
    $orderId = $order->getId();

    unset($postList);
    unset($errorList);
    include_once("Presentation/OrderConfirmation.php");
    unset($_SESSION["cart"]);
    unset($_SESSION["postList"]);
}  
else {
    include_once("Presentation/Order.php");
}