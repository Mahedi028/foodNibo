<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MenuCartController;
use App\Http\Controllers\Backend\MenuController;
use App\Http\Controllers\Backend\StateController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Api\User\ProfileController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\DistrictController;
use App\Http\Controllers\Backend\DivisionController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\User\UserOrderController;
use App\Http\Controllers\Api\Auth\SocialLoginController;
use App\Http\Controllers\Payment\StripePaymentController;
use App\Http\Controllers\Api\Auth\ResetPasswordController;
use App\Http\Controllers\Api\Auth\ForgetPasswordController;
use App\Http\Controllers\Payment\SslCommerzPaymentController;
use App\Http\Controllers\Api\Auth\AccountActivationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::prefix('v1')->group(function(){
    //-----------------Authentication starts-----------------------------//

    //----login api
    Route::post('/login', [LoginController::class, 'Login']);
    //----register api
    Route::post('/register', [RegisterController::class, 'Register']);
    //----account activation by email
    Route::get('/active/{token}', [AccountActivationController::class, 'ActiveAccount']);
    //----update token
    Route::put('/updatetoken/{token}', [AccountActivationController::class,'UpdateToken']);
    //-----account activation with activation code
    // Route::get('/verification/{id}', [UserController::class, 'Verification']);
    //validated email verification otp
    // Route::post('/verified',[UserController::class, 'VerifyOtp']);
    //resend otp
    // Route::get('/resend-otp', [UserController::class, 'ResendOtp']);

    //forget-password
    Route::post('/forgetpassword',[ForgetPasswordController::class,'ForgetPassword']);
    //reset-password
    Route::post('/resetpassword', [ResetPasswordController::class,'ResetPassword']);
    //social login
    Route::get('/login/{provider}/redirect',[SocialLoginController::class, 'redirectToProvider']);
    Route::get('/login/{provider}/callback',[SocialLoginController::class, 'handleProviderCallback']);


    //-------------------Authenticated routes start---------------------//

    Route::controller(ProfileController::class)->middleware(['auth:sanctum', 'verified'])->group(function(){
        Route::get('/user','Profile');
        Route::get('/profile/{id}/user','UpdateProfile');
        Route::put('/user/{id}/edit','ProfileEdit');
    });

    //-------------Cart api starts------------------------------------//
    Route::controller(MenuCartController::class)->middleware(['auth:sanctum', 'verified'])->group(function(){
        //add cart
        Route::post('/addtocart','AddToCart');
        //cart count
        Route::get('/cartcount/{email}','CartCount');
        //cart list
        Route::get('/cartlist/{email}','CartList');
        //remove cart item
        Route::delete('/removecartlist/{id}','RemoveCartList');
        //cartitem plus
        Route::get('/cartitemplus/{id}/{quantity}/{price}','CartItemPlus');
        //cartitem minus
        Route::get('/cartitemminus/{id}/{quantity}/{price}','CartItemMinus');
        //cart order
        Route::post('/cartorder','CartOrder');
        //orderlist bi user
        Route::get('/orderlistbyuser/{email}','OrderListByUser');
    });


    Route::controller(UserOrderController::class)->middleware(['auth:sanctum', 'verified'])->group(function(){
        //authenticate user
        Route::get('/{user_id}/orders','UserOrder');
        Route::get('/{order_id}/order_details','OrderDetails');
        Route::get('/{order_id}/invoice_download','InvoiceDownload');
    });
    //--------------------------------Authenticated routes-end-----------------//


    //--------------------Category api starts-----------------------------//
    Route::get('/allcategory', [CategoryController::class, 'ShowAllCategories']);
    // Route::get('/menu/{id}', [CategoryController::class, 'GetMenusByCategoryId']);
    Route::get('/menulistbycategory',[CategoryController::class, 'MenuListByCategory']);
    //--------------------Category api starts-----------------------------//

    //--------------------Menus api starts-----------------------------//
    Route::get('/allmenu', [MenuController::class, 'ShowAllMenus']);
    Route::get('/menu/{id}', [MenuController::class, 'MenuDetails']);
    //--------------------Menus api starts-----------------------------//







        //--------------------Coupon api starts-----------------------------//
        Route::controller(CouponController::class)->group(function(){
    Route::get('/coupon/apply', [CouponController::class, 'applyCoupon']);
    Route::get('/coupon/remove', [CouponController::class, 'removeCoupon']);
   });
   //--------------------Coupon api starts-----------------------------//

   //-----------------------Divition-----------------------------------//
   Route::get('/alldivitions',[DivisionController::class,'getAllDivitions']);
   //-----------------------Divition-----------------------------------//
   //-----------------------District-----------------------------------//
//    Route::get('/alldistricts',[DistrictController::class,'getAllDistricts']);
   Route::get('/district-get/{division_id}', [DistrictController::class, 'DivisionWiseDistrict']);
   //-----------------------Divition-----------------------------------//
   //-----------------------District-----------------------------------//
//    Route::get('/allstates',[StateController::class,'getAllStates']);
   Route::get('/state-get/{district_id}', [StateController::class, 'DistrictWiseState']);
   //-----------------------District-----------------------------------//


   //-----------------------Banner-----------------------------------//
   Route::get('/allbanners',[BannerController::class,'getAllBanners']);
   //-----------------------Banner-----------------------------------//




   //-----------------------Stripe-payment-----------------------------------//
   Route::post('/stripe/order',[StripePaymentController::class,'StripePayment']);
   //-----------------------Stripe-payment-----------------------------------//

   //-----------------------SSL-Commerce--------------------------------------//
   Route::post('/sslcommerce/order',[SslCommerzPaymentController::class,'SSLCommercePayment']);
   //-----------------------SSL-Commerce--------------------------------------//


});





// Route::middleware(['auth:sanctum', 'verified'])->get('/user', function (Request $request) {
//     return $request->user();
// });
