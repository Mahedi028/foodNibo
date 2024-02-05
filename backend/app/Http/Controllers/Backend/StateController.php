<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Interfaces\StateInterface;
use App\Http\Controllers\Controller;
use App\Interfaces\DistrictInterface;
use App\Interfaces\DivisionInterface;
use App\Http\Requests\Backend\AddStateRequest;

class StateController extends Controller
{
    use ResponseTrait;
    protected $state,$district,$division;

    public function __construct(
        StateInterface $stateInterface,
        DistrictInterface $districtInterface,
        DivisionInterface $divisionInterface
        )
    {
        $this->state=$stateInterface;
        $this->district=$districtInterface;
        $this->division=$divisionInterface;
    }

    //---------------API-----------------------//
    public function getAllStates()
    {
        try{
            $states=$this->state->getAllStates();
            return $this->responseSuccess($states,'Fetch States',200);
        }catch(\Exception $e){
            return $this->responseError($e->getMessage(),'Error',401);
        }

    }//end of method

    public function DistrictWiseState($district_id)
    {
        try{
            $states=$this->state->getDistrictWiseState($district_id);
            return $this->responseSuccess($states,'Fetch States',200);
        }catch(\Exception $e){
            return $this->responseError($e->getMessage(),'Error',401);
        }
    }
    //---------------API-----------------------//
    public function All()
    {
        try{
            $states=$this->state->getAllStates();
            return view('backend.state.state_view',compact('states'));
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
            $states=$this->state->getAllStates();
            $districts=$this->district->getAllDistricts();
            $divisions=$this->division->getAllDivisions();
            return view('backend.state.state_add',compact('states','districts','divisions'));
        }catch(\Exception $e){
            $notification=array(
                'message'=>$e->getMessage(),
                'type'=>'danger'
            );
            return redirect()->back();
        }
    }//end of method

    public function Store(AddStateRequest $request)
    {
        $data=[];
        $data['name']=$request->input('name');
        $data['division_id']=$request->input('division_id');
        $data['district_id']=$request->input('district_id');
        try{
            $data=$this->state->addState($data);
            $notification=array(
                'message'=>'State Added Successfully',
                'type'=>'success'
            );
            return redirect()->route('state.add')->with($notification);
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
