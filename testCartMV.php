<?php
spl_autoload_register();
use Business\OrderDetailService;
use Business\CartService;

$orDetServ = new OrderDetailService();
$cartServ = new CartService();

//!\ When testing:
//comment session_start() (L5) and $cartList = array() (L15) in CartController.php

//////////////TEST////////////////
//creating $cartList with a few articles/OrderDetails
$cartList = array();
for($i=0;$i<5;$i++)
{
    $orDet = $orDetServ->getOrderDetailforCart($i+1,rand(1,10)); 
    array_push($cartList, $orDet);
}
echo "Random Cart List: ";
var_dump($cartList);


$_POST["artId"] = 3;
//$_POST["buy"] ="LETSGOOOOOOOOOOOO";
//$_POST["deleteFromCart"] = "LETSDELEEETTTEEEEE";
//$_POST["plus"] = "LETSMODIFFFYYYYYY";
$_POST["minus"] = "LETSMODIFFFYYYYYY";


include_once("CartController.php");

echo "Cart List after Test run: ";
var_dump($cartList);

echo "Cart Article List after Test Run: ";
var_dump($cartArticleList);

echo "Total price: ";
echo $cartServ->calculateTotalCartPrice($cartList, $cartArticleList);

?>