<?php
declare(strict_types=1);

spl_autoload_register();


use Business\ArticleService;
use Business\CartService;
use Business\OrderDetailService;

$artServ = new ArticleService();
$orDetServ = new OrderDetailService();
$cartServ = new CartService();

$cartList = array(); 

//empty cart has been clicked 
if (isset($_POST["emptyCart"])) {
    unset($_SESSION["cart"]);
    unset($_SESSION["cartArticles"]);
}
if (isset($_SESSION["cart"])) {
    //cart exists and it is not empty
    $cartList = unserialize($_SESSION["cart"]);
}


//buy has been clicked to add article to cart
if (isset($_POST["artId"]) && isset($_POST["buy"])) {
    $cartList = $cartServ->addToCart($cartList, (int) $_POST["artId"]);
    $_SESSION["cart"] = serialize($cartList);
}


//delete from cart has been clicked
if (isset($_POST["artId"]) && isset($_POST["deleteFromCart"])) {
    $cartList = $cartServ->removeFromCart($cartList, (int) $_POST["artId"]);
    $_SESSION["cart"] = serialize($cartList);
}


//+ or -1 has been clicked for an article ID 
if (isset($_POST["artId"]) && (isset($_POST["plus"]) || isset($_POST["minus"]))) {
    (isset($_POST["plus"])) ? $by = 1 : $by = -1;
    $cartList = $cartServ->modifyQuantity($cartList, (int) $_POST["artId"], (int) $by);
    $_SESSION["cart"] = serialize($cartList);
}

if (count($cartList) != 0) //there are items in the cart
{
    //create 2nd array that contains article objects based on article id's in cartList
    //cartArticleList will have indeces that match article Id in $cartList
    //$cartlist = array of orderDetail entities (containing artId and quantityOrdered = quantity in cart)
    //$cartArticleList = array of article entities with index = artId
    $cartArticleList = $cartServ->createCartArticles($cartList);
    //$_SESSION["cartArticles"] = serialize($cartArticleList);
}