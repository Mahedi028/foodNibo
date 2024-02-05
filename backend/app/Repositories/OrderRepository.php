<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\MenuOrder;
use App\Interfaces\OrderInterface;
use Illuminate\Support\Facades\Auth;

class OrderRepository implements OrderInterface
{
    public function allOrders()
    {
        return Order::all();
    }
    public function postOrder(array $data)
    {
        return Order::insertGetId($data);
    }//end of method
    public function postAllItem(array $data)
    {
        return MenuOrder::insert($data);
    }//end of method

    public function findOrderbyId($order_id)
    {
        return Order::where('id',$order_id)->get();
    }

    public function orderDetails($order_id)
    {
        return Order::with('division','district','state')->where('id',$order_id)->where('user_id',Auth::id())->first();
    }

    public function getOrderItems($order_id)
    {
        return MenuOrder::with('menu')->where('order_id',$order_id)->orderBy('id','DESC')->get();
    }

    public function getAllPendingOrders()
    {
        return Order::where('operational_status','pending')->orderBy('id','DESC')->get();
    }

    public function getAllPendingOrderDetails($order_id)
    {
        return Order::with('division','district','state')->where('id',$order_id)->first();
    }

    public function getAllConfirmedOrders()
    {
        return Order::where('operational_status','confirmed')->orderBy('id','DESC')->get();
    }

    public function getAllProcessingOrders()
    {
        return Order::where('operational_status','processing')->orderBy('id','DESC')->get();
    }







}
?>
