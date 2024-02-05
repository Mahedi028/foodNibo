<?php

namespace App\Interfaces;


interface CategoryInterface
{
    public function getAllCategories();

    public function createCategory(array $data);

    public function categoryRelatedMenus($categoryName);

    public function getCategoryById($id);

    public function getCategoryByOrder();

    public function updateCategoryWithoutPhoto($id,array $data);

    public function updateCategoryWithPhoto($id,$data);

    public function deleteCategory($id);
}

?>
