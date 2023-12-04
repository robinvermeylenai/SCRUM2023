<?php

declare(strict_types=1);

namespace Data;

use Data\BaseDAO;
use Entities\Category;

class CategoryDAO extends BaseDAO
{
    /*
    getAllCategories returns objects as default behavior, submit "false" as pareameter in order to receive raw database-data (array)
    */
    public function getAllCategories(bool $asObjects = true) : Array
    {

        $categories = array();

        $dbh = $this->db_connect();

        $sql  = "SELECT * FROM categorieen ORDER BY naam";
  
        $resultSet = $dbh->query($sql);
  
        foreach ($resultSet as $category) {
            if($asObjects) {
                $category = $this->createCategoryFromRow($category);
            }
            array_push($categories, $category);
        }
        return $categories;
    }

    /*
    getCategoriesByParentId without parameter returns only the top-categories
    */
    public function getCategoriesByParentId(?int $parentId = NULL, bool $asObjects = true) : Array
    {

        $categories = array();

        $dbh = $this->db_connect();

        if(is_null($parentId)) {

            $sql  = "SELECT * FROM categorieen WHERE hoofdCategorieId IS NULL ORDER BY naam";

            $resultSet = $dbh->query($sql);

        } else {
            
            $sql  = "SELECT * FROM categorieen WHERE hoofdCategorieId = :parentId ORDER BY naam";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([':parentId' => $parentId]);
    
            $resultSet = $stmt->fetchAll($dbh::FETCH_ASSOC);
        }
  
        foreach ($resultSet as $category) {
            if($asObjects) {
                $category = $this->createCategoryFromRow($category);
            }
            array_push($categories, $category);
        }
        return $categories;
    }

    public function createCategoryFromRow($row) {

        $category = new Category($row['categorieId'], $row['naam'], $row['hoofdCategorieId']);

        return $category;
    }

}