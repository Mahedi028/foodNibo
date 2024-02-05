<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Support\Str;
use App\Traits\ResponseTrait;
use App\Interfaces\AuthInterface;
use App\Mail\EmailVerificationMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cookie;
use App\Http\Requests\Auth\RegisterRequest;

class RegisterController extends Controller
{
    use ResponseTrait;
    protected $auth;

    public function __construct(AuthInterface $authInterface)
    {
        $this->auth=$authInterface;
    }

    //REGISTER API URL:http://127.0.0.1:8000/api/v1/register
    public function Register(RegisterRequest $request)
    {

        $data=[];
        $email=$request->email;
        $data['name']=$request->input('name');
        $data['email']=$request->input('email');
        $data['password']=Hash::make($request->input('password'));
        $data['phone_number']=$request->input('phone_number');
        $data['email_verification_token']=uniqid(time().$request->input('email').Str::random(16));

        try{
            $user=$this->auth->RegisterUser($data);

            //create token
            $token=$user->createToken('app')->plainTextToken;

            //send mail for email verification
            Mail::to($email)->send(new EmailVerificationMail($user));

            return response()->json([
                'message'=>'User registered successfully.please check your email for account activation',
                'token'=>$token,
                'user'=>$user,
            ], 200);
        }catch(\Exception $e){
            return response()->json([
                'error'=>$e->getMessage(),
                'message'=>'Invaild user and password',
                'user'=>null
            ], 400);
        }
    }//end of method

}
