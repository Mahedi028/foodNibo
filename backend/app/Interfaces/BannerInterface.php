<?php

namespace App\Interfaces;


interface BannerInterface
{
    public function getAllBanners();
    public function createBanner(array $data);
}

?>
