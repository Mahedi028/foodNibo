<?php

namespace App\Repositories;

use App\Models\Banner;
use App\Interfaces\BannerInterface;


class BannerRepository implements BannerInterface
{
    public function getAllBanners()
    {
        return Banner::all();
    }//end of method
    public function createBanner(array $data)
    {
        return Banner::create($data);
    }//end of method
}
?>
