<?php

namespace App\Repositories;

use App\Interfaces\StateInterface;
use App\Models\State;

class StateRepository implements StateInterface
{
    public function addState(array $data)
    {
        return State::create($data);
    }//end of method

    public function getAllStates()
    {
        return State::all();
    }//end of method

    public function getDistrictWiseState($district_id)
    {
        return State::where('district_id',$district_id)->orderBy('name','ASC')->get();
    }
}
?>
