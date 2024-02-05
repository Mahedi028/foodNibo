<?php

namespace App\Interfaces;


interface OrderInterface
{
    public function allOrders();

    public function postOrder(array $data);

    public function postAllItem(array $data);

    public function findOrderbyId($order_id);

    public function orderDetails($order_id);

    public function getOrderItems($order_id);

    public function getAllPendingOrders();

    public function getAllPendingOrderDetails($order_id);

    public function getAllConfirmedOrders();

    public function getAllProcessingOrders();

}

?>
