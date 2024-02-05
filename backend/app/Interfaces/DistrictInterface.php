<?php

namespace App\Interfaces;


interface DistrictInterface
{
    public function addDistrict($data);

    public function getAllDistricts();

    public function getDivisionWiseDistrict($division_id);


}

?>
