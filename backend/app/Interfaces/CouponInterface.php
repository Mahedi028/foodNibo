<?php

namespace App\Interfaces;


interface CouponInterface
{
    public function addCoupon($data);

    public function getAllCoupons();

    public function couponExist($coupon_name);
}

?>
