<?php

namespace App\Repositories;

use App\Models\Menu;
use App\Interfaces\MenuInterface;

class MenuRepository implements MenuInterface
{
    public function addMenu(array $data)
    {
        return Menu::insert($data);
    }//end of method

    public function getAllMenus()
    {
        return Menu::all();
    }//end of method

    public function getMenuById($id)
    {
        return Menu::findOrFail($id);
        // return Menu::where('id', $id)->get();
    }//end of method

    public function getMenuByTitle($title)
    {
        return Menu::where('title',$title)->first()->toArray();
    }//end of method

    public function updateMenu($id,array $data)
    {
        $menu=Menu::findOrFail($id);
        return $menu->update($data);
    }//end of method

    public function deleteMenu($id)
    {
        $menu=Menu::findOrFail($id);
        return $menu->delete();
    }//end of method





}
?>
