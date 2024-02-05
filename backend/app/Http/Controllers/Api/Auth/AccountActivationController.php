<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Interfaces\AuthInterface;
use App\Http\Controllers\Controller;

class AccountActivationController extends Controller
{
    use ResponseTrait;
    protected $auth;

    public function __construct(AuthInterface $authInterface)
    {
        $this->auth=$authInterface;
    }

    public function ActiveAccount($token=null)
    {
        if($token=null){
            return response()->json([
                'account_active_status'=>false,
                'message'=>'Invalid token'
            ]);
        }

        try{
            $user=$this->auth->VerifyToken($token);
            if($user){
                return response()->json([
                    'account_active_status'=>true,
                    'message'=>'Account Active successful'
                ]);
            }else{
                return response()->json([
                    'account_active_status'=>false,
                    'message'=>'Invalid token'
                ]);
            }
        }catch(\Exception $e){
            return response()->json([
                'account_active_status'=>false,
                'message'=>'Invalid token',
                'error'=>$e->getMessage()
            ]);
        }
    }//end of method

    public function UpdateToken($token)
    {

        try{
            $data=$this->auth->updateUser($token);
            return response()->json([
                'message'=>'Account Activate successful please login now',
                'data'=>$data
            ]);
        }catch(\Exception $e){
            return response()->json([
                'message'=>'Invalid token',
                'error'=>$e->getMessage()
            ]);
        }

    }//end of method


}
