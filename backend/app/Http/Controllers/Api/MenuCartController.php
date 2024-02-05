<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Interfaces\MenuInterface;
use App\Http\Controllers\Controller;
use App\Interfaces\MenuCartInterface;
use Intervention\Image\Facades\Image;
use App\Http\Requests\Api\AddToCartRequest;

class MenuCartController extends Controller
{
    use ResponseTrait;

    protected $menu, $menuCart;

    public function __construct(
        MenuInterface $menuInterface,
        MenuCartInterface $menuCartInterface
        )
    {
        $this->menu=$menuInterface;
        $this->menuCart=$menuCartInterface;
    }
    public function AddToCart(AddToCartRequest $request)
    {
        $data=[];
        //all data send from frontend
        $id=$request->input('id');
        $data['menu_id']=$id;
        $data['email']=$request->input('email');
        $data['quantity']=$request->input('quantity')?$request->input('quantity'):1;

        //get product information using id
        $menuDetails=$this->menu->getMenuById($id);
        $data['menu_image']=$menuDetails['meal_thumbnail'];
        $data['menu_name']=$menuDetails['title'];
        $discount_price=$menuDetails['discount_price'];


        if($discount_price=="null"){
            $data['total_price']=$menuDetails['price']*$data['quantity'];
            $data['unit_price']=$menuDetails['price'];
        }else{
            $data['total_price']=$discount_price*$data['quantity'];
            $data['unit_price']=$menuDetails['price'];
        }

        //get existing all cart items
        $existing_carts=$this->menuCart->getCartListByEmail($data['email']);


        // if($menuDetails->id==$existing_carts[$menuDetails->id]['menu_id']){
        //     $existing_carts[$menuDetails->id]['quantity']++;
        //     $existing_carts[$menuDetails->id]['total_price']=$existing_carts[$menuDetails->id]['quantity']*$existing_carts[$menuDetails->id]['unit_price'];
        // }else{
            try{
                $cart=$this->menuCart->PostAddToCart($data);
                return $this->responseSuccess($cart,'Cart items added',200);
            }catch(\Exception $e){
                 return $this->responseError($e->getMessage(),'Error',401);
                }
        // }
    }//end of method

    public function CartCount($email)
    {
        try{
            $count=$this->menuCart->getCartCount($email);
            return $this->responseSuccess($count,'Cart count success',200);
        }catch(\Exception $e){
            return $this->responseError($e->getMessage(),'Error',401);
        }
    }//end of method

    public function CartList($email)
    {
        try{
            $cartList=$this->menuCart->getCartListByEmail($email);
            return $this->responseSuccess($cartList,'cart data fetch',200);
        }catch(\Exception $e){
            return $this->responseError($e->getMessage(),'Error',401);
        }

    }//end of method

    public function RemoveCartList($id)
    {
        try{
            $data=$this->menuCart->removeCartById($id);
            return $this->responseSuccess($data,'Remove Cart successfulli',200);
        }catch(\Exception $e){
            return $this->responseError($e->getMessage(),'Error',400);
        }
    }//end of method

    public function CartItemPlus()
    {

    }//end of method

    public function CartItemMinus()
    {

    }//end of method








}
