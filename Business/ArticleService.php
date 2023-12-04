<?php

declare(strict_types=1);
namespace Business;


use Data\ArticleDAO;
use Entities\Article;

class ArticleService
{
    //*MV* function to request all products, regardless of category, default sorted by artikelId asc
    public function getArticleList() : Array //(of Article objects)
    {
        $articleDAO = new ArticleDAO();
        $list = $articleDAO->getAll();
        return $list;
    }

    // VV get all articles for catalogue (taking relations with categories into consideration)
    public function getArticleListForCatalogue(string $sortOption = '', string $searchKey = '', array $filterProductsByCategoryIds = array()) : Array //(of Article objects)
    {
        
        //sort by
        switch ($sortOption) {
            case "NameA":
                $orderBy = 'ORDER BY name ASC, price ASC';
                break;
            case "NameD":
                $orderBy = 'ORDER BY name DESC, price ASC';
                break;
            case "PriceA":
                $orderBy = 'ORDER BY price ASC, name ASC';
                break;
            case "PriceD":
                $orderBy = 'ORDER BY price DESC, name ASC';
                break;
            case "StockA":
                $orderBy = 'ORDER BY stock ASC';
                break;
            case "StockD":
                $orderBy = 'ORDER BY stock DESC';
                break;
            default:
                $orderBy = 'ORDER BY price ASC, name ASC';
        }

        $articleDAO = new ArticleDAO();
        $list = $articleDAO->getAllArticlesForCatalogue($orderBy, $searchKey, $filterProductsByCategoryIds);
        return $list;
    }

    //*MV* function to request all products, regardless of category but in different random order
    //maybe useful for home/main page to not always show same few products first?
    public function getRandomArticleList() : Array //(of Article objects)
    {
        $articleDAO = new ArticleDAO();
        $list = $articleDAO->getAllRandomly();
        return $list;
    }

    //*MV* function to request all products in a specific category + subcategories, default sort by artikelId asc
    public function getArticlesByCat(int $catId) : Array //(of Article objects)
    {
        $articleDAO = new ArticleDAO();
        $list = $articleDAO->getByCat($catId);
        return $list;
    }

    //*MV* function to get products in a specific category + subcategories, sorted by name asc
    public function getByCatSortByNameAsc(int $catId) : Array //(of Article objects)
    {
        $articleDAO = new ArticleDAO();
        $list = $articleDAO->getByCatAndSort($catId, 1);
        return $list;
    }
    //*MV* function to get products in a specific category + subcategories, sorted by name desc
    public function getByCatSortByNameDesc(int $catId) : Array //(of Article objects)
    {
        $articleDAO = new ArticleDAO();
        $list = $articleDAO->getByCatAndSort($catId, 2);
        return $list;
    }

    //*MV* function to get products in a specific category + subcategories, sorted by price asc
    public function getByCatSortByPriceAsc(int $catId) : Array //(of Article objects)
    {
        $articleDAO = new ArticleDAO();
        $list = $articleDAO->getByCatAndSort($catId, 3);
        return $list;
    }

    //*MV* function to get products in a specific category + subcategories, sorted by price desc
    public function getByCatSortByPriceDesc(int $catId) : Array //(of Article objects)
    {
        $articleDAO = new ArticleDAO();
        $list = $articleDAO->getByCatAndSort($catId, 4);
        return $list;
    }

    //*MV* function to get products in a specific category + subcategories, sorted by stock asc
    public function getByCatSortByStockAsc(int $catId) : Array //(of Article objects)
    {
        $articleDAO = new ArticleDAO();
        $list = $articleDAO->getByCatAndSort($catId, 5);
        return $list;
    }

    //*MV* function to get products in a specific category + subcategories, sorted by stock desc
    public function getByCatSortByStockDesc(int $catId) : Array //(of Article objects)
    {
        $articleDAO = new ArticleDAO();
        $list = $articleDAO->getByCatAndSort($catId, 6);
        return $list;
    }

    //*MV* function to get products in a specific category + subcategories, where there is stock
    public function getByCatStockAvailable(int $catId) : Array //(of Article objects)
    {
        $articleDAO = new ArticleDAO();
        $list = $articleDAO->getByCatCheckStock($catId, TRUE);
        return $list;
    }

    //*MV* function to get products in a specific category + subcategories, where there is no stock available
    public function getByCatNoStock(int $catId) : Array //(of Article objects)
    {
        $articleDAO = new ArticleDAO();
        $list = $articleDAO->getByCatCheckStock($catId, FALSE);
        return $list;
    }

    //*MV* function to get article info by Id
    public function getArticle(int $artId) : ?Article
    {
        $articleDAO = new ArticleDAO();
        $article = $articleDAO->getById($artId);
        return $article;
    }

    //*MV* function to get article info by name search
    public function searchByName(string $search) : Array //(of Article objects)
    {
        $articleDAO = new ArticleDAO();
        $list = $articleDAO->getByName($search);
        return $list;
    }
}