<?php

namespace App\Repositories;

use App\Interfaces\MenuCartInterface;
use App\Models\MenuCart;

class MenuCartRepository implements MenuCartInterface
{
    public function PostAddToCart(array $data)
    {
        return MenuCart::create($data);
    }//end of method

    public function getCartCount($email)
    {
        return MenuCart::where('email',$email)->count();
    }//end of method

    public function getCartListByEmail($email)
    {
        return MenuCart::where('email',$email)->get();
    }//end of method

    public function removeCartById($id)
    {
        return MenuCart::where('id',$id)->delete();
    }//end of method

    public function removeAllFromCart($email)
    {
        return MenuCart::where('email',$email)->delete();
    }//end of method

    public function incrementCartItem($id,$quantity,$price)
    {

    }//end of method

    public function decrementCartItem($id,$quantity,$price)
    {

    }//end of method

   

}
?>
