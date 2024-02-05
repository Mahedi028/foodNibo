<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Http\Controllers\Controller;
use App\Interfaces\DivisionInterface;
use App\Http\Requests\Backend\AddDivisionRequest;
use App\Http\Requests\Backend\DivisionUpdateRequest;

class DivisionController extends Controller
{
    use ResponseTrait;
    protected $division;
    public function __construct(DivisionInterface $divisionInterface)
    {
        $this->division=$divisionInterface;
    }
    //---------------------------------API-----------------------//
    public function getAllDivitions()
    {
        try{
            $divisions=$this->division->getAllDivisions();
            return $this->responseSuccess($divisions,'fetch all divitions',200);
        }catch(\Exception $e){
            return $this->responseError($e->getMessage(),'error',401);
        }
    }
    //---------------------------------API-----------------------//
    public function All()
    {
        try{
            $divisions=$this->division->getAllDivisions();
            return view('backend.division.division_add',compact('divisions'));
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
            $divisions=$this->division->getAllDivisions();
            return view('backend.division.division_add',compact('divisions'));
        }catch(\Exception $e){
            $notification=array(
                'message'=>$e->getMessage(),
                'type'=>'danger'
            );
            return redirect()->back();
        }
    }//end of method

    public function Store(AddDivisionRequest $request)
    {
        $data=[];
        $data['name']=$request->input('name');
        try{
            $data=$this->division->addDivision($data);
            $notification=array(
                'message'=>'Division Added Successfully',
                'type'=>'success'
            );
            return redirect()->route('division.all')->with($notification);
        }catch(\Exception $e){
            $notification=array(
                'message'=>$e->getMessage(),
                'type'=>'danger'
            );
            return redirect()->back();
        }
    }//end of method

    public function Edit($id)
    {

    }//end of method

    public function Update($id, DivisionUpdateRequest $request)
    {

    }//end of method


    public function Delete($id)
    {
        try{
            $this->division->deleteDivision($id);
            $notification=array(
                'message'=>'Division Deleted Successfully',
                'type'=>'success'
            );
            return redirect()->route('division.all')->with($notification);
        }catch(\Exception $e){
            $notification=array(
                'message'=>$e->getMessage(),
                'type'=>'success'
            );
            return redirect()->back();
        }
    }//end of method






}
