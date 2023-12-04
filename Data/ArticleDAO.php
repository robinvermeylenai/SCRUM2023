<?php

declare(strict_types=1);
namespace Data;

use Entities\Article;
use Data\BaseDAO;

class ArticleDAO extends BaseDAO
{
    //*MV* function to request all products, regardless of category, sorted by ID asc
    public function getAll(): array //(of Article objects)
    {
        $baseDAO = new BaseDAO();
        $dbh = $baseDAO->db_connect();
        $sql = "select artikelId as id, ean, naam as name, beschrijving as description, prijs as price, gewichtInGram as weight, 
        voorraad as stock, levertijd as deliveryTime from artikelen order by artikelId asc";
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $resultSet = $stmt->fetchAll($dbh::FETCH_ASSOC);
        $list = array();
        foreach($resultSet as $row) {
            $article = new Article((int)$row["id"], $row["ean"], $row["name"], $row["description"], (float)$row["price"],
            (int)$row["weight"], (int)$row["stock"], (int)$row["deliveryTime"]);
            array_push($list, $article);
        }
        $dbh = null;
        return $list;
    }
    
    //VV function to request all products in catalogue 
    //-> join with table containing relations between products and categories
    public function getAllArticlesForCatalogue($orderBy = '', $searchKey = '', $filterProductsByCategoryIds = array()): array //(of Article objects)
    {

        $baseDAO = new BaseDAO();
        $dbh = $baseDAO->db_connect();

        $sqlOrderBy = $orderBy;
        $sqlJoin = '';
        $sqlGroupBy = '';
        $whereClauses = array();
        $stmtReplacements = array();
        if(count($filterProductsByCategoryIds) > 0) {

            $sqlJoin = 'INNER JOIN artikelcategorieen ON artikelen.artikelId = artikelcategorieen.artikelId';
            $sqlGroupBy = 'GROUP BY artikelen.artikelId';

            if(count($filterProductsByCategoryIds) === 1) {
                //only 1 categoryid as filter
                $whereClauses[] = 'artikelcategorieen.categorieId = ?';
                $stmtReplacements[] = $filterProductsByCategoryIds[0];
            } else {
                //multiple categoryids as filter
                $place_holders = implode(',', array_fill(0, count($filterProductsByCategoryIds), '?'));
                $whereClauses[] = "artikelcategorieen.categorieId IN($place_holders)";
                $stmtReplacements = array_merge($stmtReplacements, $filterProductsByCategoryIds);
            }
        }
        if($searchKey !== '') {
            $whereClauses[] = "(naam LIKE ? OR ean LIKE ? OR beschrijving LIKE ?)";
            $stmtReplacements[] = "%$searchKey%";
            $stmtReplacements[] = "%$searchKey%";
            $stmtReplacements[] = "%$searchKey%";
        }
        $sqlWhere = '';
        if(count($whereClauses) > 0) {
            $sqlWhere = 'WHERE '.implode(' AND ', $whereClauses);
        }

        $sql = "SELECT artikelen.artikelId AS id, ean, naam AS name, beschrijving AS description, prijs AS price, gewichtInGram AS weight, 
        voorraad AS stock, levertijd AS deliveryTime FROM artikelen $sqlJoin $sqlWhere $sqlGroupBy $sqlOrderBy";

        $stmt = $dbh->prepare($sql);
        $stmt->execute($stmtReplacements);
        $resultSet = $stmt->fetchAll($dbh::FETCH_ASSOC);
        $list = array();
        foreach($resultSet as $row) {
            $article = new Article((int)$row["id"], $row["ean"], $row["name"], $row["description"], (float)$row["price"],
            (int)$row["weight"], (int)$row["stock"], (int)$row["deliveryTime"]);
            array_push($list, $article);
        }
        $dbh = null;
        return $list;
    }

    //*MV* function to request all products, regardless of category but in different random order
    //maybe useful for home/main page to not always show same few products first?
    public function getAllRandomly(): array //(of Article objects)
    {
        $baseDAO = new BaseDAO();
        $dbh = $baseDAO->db_connect();
        $sql = "select artikelId as id, ean, naam as name, beschrijving as description, prijs as price, gewichtInGram as weight, 
        voorraad as stock, levertijd as deliveryTime from artikelen order by rand()";
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $resultSet = $stmt->fetchAll($dbh::FETCH_ASSOC);
        $list = array();
        foreach($resultSet as $row) {
            $article = new Article((int)$row["id"], $row["ean"], $row["name"], $row["description"], (float)$row["price"],
            (int)$row["weight"], (int)$row["stock"], (int)$row["deliveryTime"]);
            array_push($list, $article);
        }
        $dbh = null;
        return $list;
    }

    //*MV* function to request all products in a specific category and its subcategories, default sort by artikelId asc
    //inner join between artikelen and artikelcategorieen table
    //relevant categorieId's are selected first through a subquery
    public function getByCat(int $catId): array //(of Article objects)
    {
        $baseDAO = new BaseDAO();
        $dbh = $baseDAO->db_connect();
        $sql = "select artikelen.artikelId as id, artikelen.ean as ean, artikelen.naam as name, artikelen.beschrijving as description, 
        artikelen.prijs as price, artikelen.gewichtInGram as weight, artikelen.voorraad as stock, artikelen.levertijd as deliveryTime
        from artikelen, artikelcategorieen where artikelen.artikelId = artikelcategorieen.artikelId and 
        artikelcategorieen.categorieId in (select categorieId from categorieen where categorieId = :cat or hoofdCategorieId = :cat2)
        order by id asc";
        $stmt = $dbh->prepare($sql);
        //using :cat twice in query throws error, hence why the use of :cat2 with same $catId value
        $stmt->execute(array(':cat'=>$catId, ':cat2'=>$catId));
        $resultSet = $stmt->fetchAll($dbh::FETCH_ASSOC);
        $list = array();
        foreach($resultSet as $row) {
            $article = new Article((int)$row["id"], $row["ean"], $row["name"], $row["description"], (float)$row["price"],
            (int)$row["weight"], (int)$row["stock"], (int)$row["deliveryTime"]);
            array_push($list, $article);
        }
        $dbh = null;
        return $list;
    }

    //*MV* function to request all products in a specific category, sorted as indicated via $sort
    //inner join between artikelen and artikelcategorieen table
    //relevant categorieId's are selected first through a subquery
    public function getByCatAndSort(int $catId, int $sort): array //(of Article objects)
    {
        $sorting = "";
        switch($sort) {
            case 1: $sorting = "order by name asc";
            break;
            case 2: $sorting = "order by name desc";
            break;
            case 3: $sorting = "order by price asc";
            break;
            case 4: $sorting = "order by price desc";
            break;
            case 5: $sorting = "order by stock asc";
            break;
            case 6: $sorting = "order by stock desc";
            break;
        }
        $baseDAO = new BaseDAO();
        $dbh = $baseDAO->db_connect();
        $sql = "select artikelen.artikelId as id, artikelen.ean as ean, artikelen.naam as name, artikelen.beschrijving as description, 
        artikelen.prijs as price, artikelen.gewichtInGram as weight, artikelen.voorraad as stock, artikelen.levertijd as deliveryTime
        from artikelen, artikelcategorieen where artikelen.artikelId = artikelcategorieen.artikelId and 
        artikelcategorieen.categorieId in (select categorieId from categorieen where categorieId = :cat or hoofdCategorieId = :cat2) "
        .$sorting;
        $stmt = $dbh->prepare($sql);
        //using :cat twice in query throws error, hence why the use of :cat2 with same $catId value
        $stmt->execute(array(':cat'=>$catId, ':cat2'=>$catId));
        $resultSet = $stmt->fetchAll($dbh::FETCH_ASSOC);
        $list = array();
        foreach($resultSet as $row) {
            $article = new Article((int)$row["id"], $row["ean"], $row["name"], $row["description"], (float)$row["price"],
            (int)$row["weight"], (int)$row["stock"], (int)$row["deliveryTime"]);
            array_push($list, $article);
        }
        $dbh = null;
        return $list;
    }

    //*MV* function to request all products in a specific category + subcategories depending on whether they are in stock or not
    //inner join between artikelen and artikelcategorieen table
    //relevant categorieId's are selected first through a subquery
    public function getByCatCheckStock(int $catId, bool $stock)
    {
        $stockcheck = "";
        switch ($stock) {
            case TRUE: $stockcheck = " and artikelen.voorraad > 0";
            break;
            case FALSE: $stockcheck = " and artikelen.voorraad = 0";
            break;
        }
        $baseDAO = new BaseDAO();
        $dbh = $baseDAO->db_connect();
        $sql = "select artikelen.artikelId as id, artikelen.ean as ean, artikelen.naam as name, artikelen.beschrijving as description, 
        artikelen.prijs as price, artikelen.gewichtInGram as weight, artikelen.voorraad as stock, artikelen.levertijd as deliveryTime
        from artikelen, artikelcategorieen where artikelen.artikelId = artikelcategorieen.artikelId and 
        artikelcategorieen.categorieId in (select categorieId from categorieen where categorieId = :cat or hoofdCategorieId = :cat2)"
        .$stockcheck;
        $stmt = $dbh->prepare($sql);
        //using :cat twice in query throws error, hence why the use of :cat2 with same $catId value
        $stmt->execute(array(':cat'=>$catId, ':cat2'=>$catId));
        $resultSet = $stmt->fetchAll($dbh::FETCH_ASSOC);
        $list = array();
        foreach($resultSet as $row) {
            $article = new Article((int)$row["id"], $row["ean"], $row["name"], $row["description"], (float)$row["price"],
            (int)$row["weight"], (int)$row["stock"], (int)$row["deliveryTime"]);
            array_push($list, $article);
        }
        $dbh = null;
        return $list;
    }

    //*MV* function to request article info for 1 specific article
    public function getById(int $artId) : ?Article
    {
        $baseDAO = new BaseDAO();
        $dbh = $baseDAO->db_connect();
        $sql = "select ean, naam as name, beschrijving as description, prijs as price, gewichtInGram as weight, 
        voorraad as stock, levertijd as deliveryTime from artikelen 
        where artikelId = :art";
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':art'=>$artId));
        $row = $stmt->fetch($dbh::FETCH_ASSOC);
        if($row){
            $article = new Article((int)$artId, $row["ean"], $row["name"], $row["description"], (float)$row["price"],
            (int)$row["weight"], (int)$row["stock"], (int)$row["deliveryTime"]);
            return $article;
        }
        $dbh = null;
        return null;
    }

    //*MV* function to search for articles by string
    public function getByName(string $search) : array
    {
        $baseDAO = new BaseDAO();
        $dbh = $baseDAO->db_connect();
        $sql = "select artikelId as id, ean, naam as name, beschrijving as description, prijs as price, gewichtInGram as weight, 
        voorraad as stock, levertijd as deliveryTime from artikelen 
        where lower(naam) like :search";
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':search'=>"%".strToLower($search)."%"));
        $resultSet = $stmt->fetchAll($dbh::FETCH_ASSOC);
        $list = array();
        foreach($resultSet as $row) {
            $article = new Article((int)$row["id"], $row["ean"], $row["name"], $row["description"], (float)$row["price"],
            (int)$row["weight"], (int)$row["stock"], (int)$row["deliveryTime"]);
            array_push($list, $article);
        }
        $dbh = null;
        return $list;
    }
}