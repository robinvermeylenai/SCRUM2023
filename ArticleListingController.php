<?php
declare(strict_types=1);



use Business\ArticleService;

$artServ = new ArticleService();
$artList = array();

$sortOptions = array();
$sortOptions['PriceA'] = 'Prijs laag naar hoog';
$sortOptions['PriceD'] = 'Prijs hoog naar laag';
$sortOptions['NameA'] = 'Naam A tot Z';
$sortOptions['NameD'] = 'Naam Z tot A';

$sortOption = 'PriceA'; //default sortOption
$searchKey = '';

/*
$filterProductsByCategoryIds is set in SideMenuController.php
SideMenuController.php is included before ArticleListingController in index.php
so the variable $filterProductsByCategoryIds is allready set in this controller
*/

if (isset($_GET['sort']) and array_key_exists($_GET['sort'], $sortOptions)) {
    $sortOption = $_GET['sort'];
}
if (isset($_GET['search']) and trim($_GET['search']) !== '') {
    $searchKey = urldecode($_GET['search']);
}

$artList = $artServ->getArticleListForCatalogue($sortOption, $searchKey, $filterProductsByCategoryIds);

/*
if (isset($_POST["search"]) && trim($_POST["search"]) != "") {
//search button has been clicked to look for item with specific/partial name
//currently no options to sort these results
$artList = $artServ->searchByName(trim(strip_tags($_POST["search"])));
} elseif (isset($_GET["catId"])) {
//a category has been clicked (or has at least been received through URL)
//(int) conversion of possible string injection into $_GET["catId"] gets auto-converted to 0, so no issue with requesting articles
//result will simply be empty as no articles found with catId = 0
//sort options
$order = $_GET["sort"] ?? "";
switch ($order) {
case "NameA":
$artList = $artServ->getByCatSortByNameAsc((int) $_GET["catId"]);
break;
case "NameD":
$artList = $artServ->getByCatSortByNameDesc((int) $_GET["catId"]);
break;
case "PriceA":
$artList = $artServ->getByCatSortByPriceAsc((int) $_GET["catId"]);
break;
case "PriceD":
$artList = $artServ->getByCatSortByPriceDesc((int) $_GET["catId"]);
break;
case "StockA":
$artList = $artServ->getByCatSortByStockAsc((int) $_GET["catId"]);
break;
case "StockD":
$artList = $artServ->getByCatSortByStockDesc((int) $_GET["catId"]);
break;
default:
$artList = $artServ->getArticlesByCat((int) $_GET["catId"]);
}
} else {
//no category info - request list of all articles
$artList = $artServ->getArticleList();
//$artList = $artServ->getRandomArticleList(); //for random order of all articles
}
*/