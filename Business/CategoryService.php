<?php

declare(strict_types=1);
namespace Business;


use Data\CategoryDAO;
use Entities\Category;

class CategoryService
{
    

    public function buildTree(array $elements, $parentId = NULL) {

        $branch = array();
    
        foreach ($elements as $element) {
            if ($element['hoofdCategorieId'] == $parentId) {
                $children = $this->buildTree($elements, $element['categorieId']);
                if ($children) {
                    $element['children'] = $children;
                }
                $branch[] = $element;
            }
        }
    
        return $branch;
    }

    public function getAllSubCategoryIds($parentId = NULL, $categoryIds = array()) {

        $categoryDAO = new CategoryDAO();

        $categories = $categoryDAO->getCategoriesByParentId($parentId, $asObjects = false);

        if(count($categories) > 0) {

            foreach($categories AS $category) {

                $categoryIds[] = $category['categorieId'];
                
                $categoryIds = $this->getAllSubCategoryIds($category['categorieId'], $categoryIds);
            }
        }

        return $categoryIds;
    }

}