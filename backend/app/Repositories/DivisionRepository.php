<?php

namespace App\Repositories;

use App\Interfaces\DivisionInterface;
use App\Models\Division;

class DivisionRepository implements DivisionInterface
{
    public function addDivision($data)
    {
        return Division::create($data);
    }//end of method

    public function getAllDivisions()
    {
        return Division::all();
    }//end of method

    public function deleteDivision($id)
    {
        $division=Division::findOrFail($id);
        return $division->delete();
    }//end of method

}
?>
