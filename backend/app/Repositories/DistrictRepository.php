<?php

namespace App\Repositories;

use App\Interfaces\DistrictInterface;
use App\Models\District;

class  DistrictRepository implements DistrictInterface
{
    public function addDistrict($data)
    {
        return District::create($data);

    }//end of method

    public function getAllDistricts()
    {
        return District::all();
    }//end of method

    public function getDivisionWiseDistrict($division_id)
    {
        return District::where('division_id',$division_id)->orderBy('name','ASC')->get();
    }//end of method
}
?>
