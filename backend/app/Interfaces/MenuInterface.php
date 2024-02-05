<?php

namespace App\Interfaces;


interface MenuInterface
{
    public function addMenu(array $data);

    public function getAllMenus();

    public function getMenuById($id);

    public function getMenuByTitle($title);

    public function updateMenu($id,array $data);

    public function deleteMenu($id);
}

?>
