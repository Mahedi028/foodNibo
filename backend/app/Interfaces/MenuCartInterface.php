<?php

namespace App\Interfaces;

use PhpParser\Node\Expr\FuncCall;

interface MenuCartInterface
{
    public function PostAddToCart(array $data);

    public function getCartCount($email);

    public function getCartListByEmail($email);

    public function removeCartById($id);

    public function removeAllFromCart($email);

    public function incrementCartItem($id,$quantity,$price);

    public function decrementCartItem($id,$quantity,$price);


}

?>
