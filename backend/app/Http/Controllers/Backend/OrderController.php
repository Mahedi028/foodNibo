<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Interfaces\OrderInterface;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $order;
    public function __construct(
        OrderInterface $orderInterface
    )
    {
        $this->order=$orderInterface;
    }

    //-----------------------------API------------------------------------------//
  
    //-------------------------API-----------------------------------------------//
}
