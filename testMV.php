<?php

spl_autoload_register();

use Business\ArticleService;

$testObj = new ArticleService();

//Show all articles, no category selected, default sorted by artikelId
/*echo "all articles";
$list = $testObj->getArticleList();
var_dump($list);*/

//Show all articles, no category selected, randomly sorted
/*echo "all articles - randomly";
$list = $testObj->getRandomArticleList();
var_dump($list);*/

//Show all articles of a specific category + its subcategories, default sorted by artikelId
/*echo "all articles by category";
$list = $testObj->getArticlesByCat(23);
var_dump($list);*/

//Show all articles of a specific category + its subcategories, sorted by name asc
/*echo "all articles sorted by name asc";
$list = $testObj->getByCatSortByNameAsc(3);
var_dump($list);*/

//Show all articles of a specific category + its subcategories, sorted by name desc
/*echo "all articles sorted by name desc";
$list = $testObj->getByCatSortByNameDesc(3);
var_dump($list);*/

//Show all articles of a specific category + its subcategories, sorted by price asc
/*echo "all articles sorted by price asc";
$list = $testObj->getByCatSortByPriceAsc(3);
var_dump($list);*/

//Show all articles of a specific category + its subcategories, sorted by price desc
/*echo "all articles sorted by price desc";
$list = $testObj->getByCatSortByPriceDesc(3);
var_dump($list);*/

//Show all articles of a specific category + its subcategories, sorted by stock asc
/*echo "all articles sorted by stock asc";
$list = $testObj->getByCatSortByStockAsc(3);
var_dump($list);*/

//Show all articles of a specific category + its subcategories, sorted by stock desc
/*echo "all articles sorted by stock desc";
$list = $testObj->getByCatSortByStockDesc(3);
var_dump($list);*/

//Show all articles of a specific category + its subcategories that are in stock
/*echo "all articles with stockavailable";
$list = $testObj->getByCatStockAvailable(3);
var_dump($list);*/

//Show all articles of a specific category + its subcategories that are not in stock
/*echo "all articles without stock";
$list = $testObj->getByCatNoStock(3);
var_dump($list);*/

//Show article with specific id
/*echo "article info by id";
$art = $testObj->getArticle(23);
var_dump($art);*/

//Show results of searching on name
echo "article info after name search";
$art = $testObj->searchByName("AfEL");
var_dump($art);