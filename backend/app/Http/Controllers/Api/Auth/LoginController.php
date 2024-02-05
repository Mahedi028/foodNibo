<?php

namespace App\Http\Controllers\Api\Auth;

use Exception;
use Illuminate\Http\Request;
use App\Interfaces\AuthInterface;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use App\Http\Requests\Auth\LoginRequest;

class LoginController extends Controller
{
    protected $auth;
    public function __construct(AuthInterface $authInterface)
    {
        $this->auth=$authInterface;
    }

    // LOGIN API URL:http://127.0.0.1:8000/api/v1/login
    public function Login(LoginRequest $request)
    {
        try{

            if(Auth::attempt($request->only('email','password'))){

                //create authenticated user
                $user=Auth::user();

                //email_verification_token is null or not
                if($user->email_verification_token!=null){
                    return response()->json([
                        'isLoggedIn'=>false,
                        'message'=>"User Account not activated please check your email and activate your account to login",
                        ], 200);
                }else{
                    //create token
                    $token=$user->createToken('app')->plainTextToken;

                    return response()->json([
                        'isLoggedIn'=>true,
                        'message'=>"User successfully loggedIn",
                        'user'=>$user,
                        'token'=>$token
                        ], 200);
                }
            }
        }catch(\Exception $e){
            return response()->json([
                'error'=>$e->getMessage(),
                'message'=>$e->getMessage(),
                'user'=>null,
            ]);
        }

        return response()->json([
            'message'=>'Invalid email and password',
            'data'=>$request->all()
            // 'user'=>null,
        ],201);

    }//end of method
}
