<?php

namespace App\Repositories;

use App\Interfaces\CouponInterface;
use App\Models\Coupon;
use Carbon\Carbon;

class  CouponRepository implements CouponInterface
{
    public function addCoupon($data)
    {
        return Coupon::create($data);

    }//end of method

    public function getAllCoupons()
    {
        return Coupon::orderBy('id','desc')->get();
    }//end of method

    public function couponExist($coupon_name)
    {
        return Coupon::where('coupon_name',$coupon_name)->where('coupon_validity','>=',Carbon::now()->format('Y-m-d'))->first();
    }//end of method

}
?>
