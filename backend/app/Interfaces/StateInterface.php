<?php

namespace App\Interfaces;


interface StateInterface
{
    public function addState(array $data);

    public function getAllStates();

    public function getDistrictWiseState($district_id);

}

?>
