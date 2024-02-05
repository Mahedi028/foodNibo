<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\MenuController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\StateController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\DistrictController;
use App\Http\Controllers\Backend\DivisionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth:sanctum,admin',config('jetstream.auth_session'),'verified'
])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.admin_master');
    })->name('admin.dashboard')->middleware('auth:admin');
});


Route::prefix('admin')->group(function (){
    //-------------------categories-----------------------//
    Route::prefix('category')->group(function(){
        Route::controller(CategoryController::class)->group(function(){
            //all
            Route::get('/all','All')->name('category.all');
            //add
            Route::get('/add','Add')->name('category.add');
            //add
            Route::post('/add','Store')->name('category.store');
            //edit
            Route::get('/edit/{id}','Edit')->name('category.edit');
            //update
            Route::put('/update/{id}','Update')->name('category.update');
            //delete
            Route::delete('/delete/{id}','Delete')->name('category.delete');
        });
    });

    //-------------------end categories-------------------//

    //-------------------banner-----------------------//
    Route::prefix('banner')->group(function(){
        Route::controller(BannerController::class)->group(function(){
            //all
            Route::get('/all','All')->name('banner.all');
            //add
            Route::get('/add','Add')->name('banner.add');
            //add
            Route::post('/add','Store')->name('banner.store');
            //edit
            Route::get('/edit/{id}','Edit')->name('banner.edit');
            //update
            Route::put('/update/{id}','Update')->name('banner.update');
            //delete
            Route::delete('/delete/{id}','Delete')->name('banner.delete');
        });
    });

    //-------------------end banner-------------------//

    //-------------------menus-----------------------//
    Route::prefix('menu')->group(function(){
        Route::controller(MenuController::class)->group(function(){
            //all
            Route::get('/all','All')->name('menu.all');
            //add
            Route::get('/add','Add')->name('menu.add');
            //add
            Route::post('/add','Store')->name('menu.store');
            //edit
            Route::get('/edit/{id}','Edit')->name('menu.edit');
            //update
            Route::put('/update/{id}','Update')->name('menu.update');
            //delete
            Route::delete('/delete/{id}','Delete')->name('menu.delete');
        });
    });

    //-------------------end menu-------------------//


    //-------------------division-----------------------//
    Route::prefix('division')->group(function(){
        Route::controller(DivisionController::class)->group(function(){
            //all
            Route::get('/all','All')->name('division.all');
            //add
            Route::get('/add','Add')->name('division.add');
            //add
            Route::post('/add','Store')->name('division.store');
            //edit
            Route::get('/edit/{id}','Edit')->name('division.edit');
            //update
            Route::put('/update/{id}','Update')->name('division.update');
            //delete
            Route::delete('/delete/{id}','Delete')->name('division.delete');
        });
    });
    //-------------------end division-------------------//


    //-------------------coupon-----------------------//
    Route::prefix('coupon')->group(function(){
        Route::controller(CouponController::class)->group(function(){
            //all
            Route::get('/all','All')->name('coupon.all');
            //add
            Route::get('/add','Add')->name('coupon.add');
            //add
            Route::post('/add','Store')->name('coupon.store');
            //edit
            Route::get('/edit/{id}','Edit')->name('coupon.edit');
            //update
            Route::put('/update/{id}','Update')->name('coupon.update');
            //delete
            Route::delete('/delete/{id}','Delete')->name('coupon.delete');
        });
    });
    //-------------------end coupon-------------------//


    //-------------------District-----------------------//
    Route::prefix('district')->group(function(){
        Route::controller(DistrictController::class)->group(function(){
            //all
            Route::get('/all','All')->name('district.all');
            //add
            Route::get('/add','Add')->name('district.add');
            //add
            Route::post('/add','Store')->name('district.store');
            //edit
            Route::get('/edit/{id}','Edit')->name('district.edit');
            //update
            Route::put('/update/{id}','Update')->name('district.update');
            //delete
            Route::delete('/delete/{id}','Delete')->name('district.delete');
        });
    });
    //-------------------end district-------------------//

    //-------------------State-----------------------//
    Route::prefix('state')->group(function(){
        Route::controller(StateController::class)->group(function(){
            //all
            Route::get('/all','All')->name('state.all');
            //add
            Route::get('/add','Add')->name('state.add');
            //add
            Route::post('/add','Store')->name('state.store');
            //edit
            Route::get('/edit/{id}','Edit')->name('state.edit');
            //update
            Route::put('/update/{id}','Update')->name('state.update');
            //delete
            Route::delete('/delete/{id}','Delete')->name('state.delete');
        });
    });

    Route::prefix('orders')->group(function(){
        Route::controller(OrderController::class)->group(function(){
            //pending order
            Route::get('/pending','PendingOrder')->name('pending.order');
            //pending order details
            Route::get('/pending/{order_id}','PendingOrderDetails')->name('pending.order.details');
            //confirmed order
            Route::get('/confirmed','ConfirmedOrder')->name('confirmed.order');
            //processing order
            Route::get('/processing','ProcessingOrder')->name('processing.order');
            //picked order
            Route::get('/picked','PickedOrder')->name('picked.order');
            //processing order
            Route::get('/shipped','ShippedOrder')->name('shipped.order');
            //processing order
            Route::get('/cancel','CancelOrder')->name('cancel.order');
        });
    });


});




Route::redirect('/', config('app.frontend_url'));

