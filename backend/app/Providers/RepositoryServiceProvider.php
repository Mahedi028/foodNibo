<?php

namespace App\Providers;

use App\Interfaces\AuthInterface;
use App\Interfaces\MenuInterface;
use App\Interfaces\UserInterface;
use App\Interfaces\OrderInterface;
use App\Interfaces\StateInterface;
use App\Interfaces\BannerInterface;
use App\Interfaces\CouponInterface;
use App\Repositories\AuthRepository;
use App\Repositories\MenuRepository;
use App\Repositories\UserRepository;
use App\Interfaces\CategoryInterface;
use App\Interfaces\DistrictInterface;
use App\Interfaces\DivisionInterface;
use App\Interfaces\MenuCartInterface;
use App\Repositories\OrderRepository;
use App\Repositories\StateRepository;
use App\Repositories\BannerRepository;
use App\Repositories\CouponRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\CategoryRepository;
use App\Repositories\DistrictRepository;
use App\Repositories\DivisionRepository;
use App\Repositories\MenuCartRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //bind all repositories
        $this->app->bind(AuthInterface::class,AuthRepository::class);
        $this->app->bind(UserInterface::class,UserRepository::class);
        $this->app->bind(CategoryInterface::class,CategoryRepository::class);
        $this->app->bind(MenuInterface::class,MenuRepository::class);
        $this->app->bind(MenuCartInterface::class,MenuCartRepository::class);
        $this->app->bind(StateInterface::class,StateRepository::class);
        $this->app->bind(DistrictInterface::class,DistrictRepository::class);
        $this->app->bind(DivisionInterface::class,DivisionRepository::class);
        $this->app->bind(CouponInterface::class,CouponRepository::class);
        $this->app->bind(BannerInterface::class,BannerRepository::class);
        $this->app->bind(OrderInterface::class,OrderRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
