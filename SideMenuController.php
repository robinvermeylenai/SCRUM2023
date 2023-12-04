<?php

use Data\CategoryDAO;
use Business\CategoryService;

$categoryDAO = new CategoryDAO();
$categoryService = new CategoryService();

$categories = $categoryDAO->getAllCategories($asObjects = false);
$structuredCategories = $categoryService->buildTree($categories);
$availableCategoryIds = array();
foreach ($categories as $category) {
    $availableCategoryIds[$category['categorieId']] = $category['categorieId'];
}

//default -> get all products (happens without category filter)
//so use of empty array of categoryids to avoid filter of products by categoryid
//and selectedCategoryId = 0 as we didnt specify one -> represents "show all" in category-structure
$filterProductsByCategoryIds = array();
$selectedCategoryId = 0;

if (isset($_GET['catId']) and array_key_exists($_GET['catId'], $availableCategoryIds)) {

    $selectedCategoryId = (int) $_GET['catId'];

    //as we selected a category we need to get all categoryids from its subcategories
    $filterProductsByCategoryIds = $categoryService->getAllSubCategoryIds($selectedCategoryId);

    //we have now obtained all subcategoryids from the selected categoryid
    //last thing to do: include the selected categoryid itself to our result-array
    $filterProductsByCategoryIds[] = $selectedCategoryId;

} else {

    //if there is no categoryId present in the URL (show all)
    //then all possible categoryIds must be submitted
    //this in order to show only products that are linked with
    //the artikelcategorieen table

    $filterProductsByCategoryIds = $availableCategoryIds;
}