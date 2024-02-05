<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\OrderInterface;
use App\Interfaces\UserInterface;
use App\Traits\ResponseTrait;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class UserOrderController extends Controller
{
    use ResponseTrait;

    protected $user,$order;

    public function __construct(
        UserInterface $userInterface,
        OrderInterface $orderInterface
        )
    {
        $this->user=$userInterface;
        $this->order=$orderInterface;
    }

    public function UserAllOrders()
    {
        try{
            $allOrders=$this->order->allOrders();
            return $this->responseSuccess($allOrders,'all order fetch successfully',200);
        }catch(\Exception $e){
            return $this->responseError($e->getMessage(),'Error',401);
        }
    }

    public function UserOrder($user_id)
    {
        try{
            $orders=$this->user->getAllOrderFromUser($user_id);
            return $this->responseSuccess($orders,'Order fetch successfully',200);
        }catch(\Exception $e){
            return $this->responseError($e->getMessage(),'Error',401);
        }
    }//end of method

    public function OrderDetails($order_id)
    {
        try{
            $order=$this->order->orderDetails($order_id);
            $orderItems=$this->order->getOrderItems($order_id);

            return response()->json([
                'order'=>$order,
                'orderItems'=>$orderItems
            ]);
        }catch(\Exception $e){
            return $this->responseError($e->getMessage(),'Oder fetch details',401);
        }
    }//end of method

}
