<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Http\Controllers\Controller;
use App\Interfaces\DistrictInterface;
use App\Interfaces\DivisionInterface;
use App\Http\Requests\Backend\AddDistrictRequest;

class DistrictController extends Controller
{
    use ResponseTrait;
    protected $district,$division;
    public function __construct(
        DistrictInterface $districtInterface,
        DivisionInterface $divisionInterface
        )
    {
        $this->district=$districtInterface;
        $this->division=$divisionInterface;
    }


    //---------------API------------------------//
    public function getAllDistricts()
    {
        try{
            $districts=$this->district->getAllDistricts();
            return $this->responseSuccess($districts,'Fetch districts',200);
        }catch(\Exception $e){
            return $this->responseError($e->getMessage(),'Error',400);
        }
    }
    public function DivisionWiseDistrict($division_id){
        try{
            $districts=$this->district->getDivisionWiseDistrict($division_id);
            return $this->responseSuccess($districts,'Fetch districts',200);
        }catch(\Exception $e){
            return $this->responseError($e->getMessage(),'Error',400);
        }
    }
    //---------------API------------------------//
    public function All()
    {
        try{
            $districts=$this->district->getAllDistricts();
            $divisions=$this->division->getAllDivisions();
            return view('backend.district.district_add',compact('districts','divisions'));
        }catch(\Exception $e){
            $notification=array(
                'message'=>$e->getMessage(),
                'type'=>'danger'
            );
            return redirect()->back();
        }
    }//end of method

    public function Add()
    {
        try{
            $districts=$this->district->getAllDistricts();
            $divisions=$this->division->getAllDivisions();
            return view('backend.district.district_add',compact('districts','divisions'));
        }catch(\Exception $e){
            $notification=array(
                'message'=>$e->getMessage(),
                'type'=>'danger'
            );
            return redirect()->back();
        }
    }//end of method

    public function Store(AddDistrictRequest $request)
    {
        $data=[];
        $data['name']=$request->input('name');
        $data['division_id']=$request->input('division_id');
        try{
            $data=$this->district->addDistrict($data);
            $notification=array(
                'message'=>'District Added Successfully',
                'type'=>'success'
            );
            return redirect()->route('district.all')->with($notification);
        }catch(\Exception $e){
            $notification=array(
                'message'=>$e->getMessage(),
                'type'=>'danger'
            );
            return redirect()->back();
        }
    }//end of method

    public function Edit()
    {

    }//end of method

    public function Update()
    {

    }//end of method


    public function Delete()
    {

    }//end of method

}
