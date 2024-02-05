<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Carbon;
use App\Interfaces\AuthInterface;
use App\Models\Provider;
use Illuminate\Support\Facades\DB;


class AuthRepository implements AuthInterface
{
    public function RegisterUser(array $data)
    {
        return User::create($data);
    }//end of method

    public function VerifyToken($token)
    {
        // return User::where('email_verification_token',$token)->firstOrFail();
        return User::where('email_verification_token',$token)->get();
    }//end of method

    public function updateUser($token)
    {
        $user=User::where('email_verification_token',$token)->firstOrFail();
        $user->update([
            'email_verified_at'=>Carbon::now(),
            'email_verification_token'=>null
        ]);
    }//end of method
    public function emailNotMatch($email)
    {
        return User::where('email',$email)->doesntExist();
    }//end of method
    public function insertToken($email,$token)
    {
        return DB::table('password_resets')->insert([
            'email'=>$email,
            'token'=>$token
        ]);

    }//end of method

    public function emailCheck($email)
    {
        return DB::table('password_resets')->where('email',$email)->first();
    }//end of method
    public function tokenCheck($token)
    {
        return DB::table('password_resets')->where('token',$token)->first();
    }//end of method

    public function updatePassword($email,$password)
    {
        return DB::table('users')->where('email',$email)->update(['password'=>$password]);
    }//end of method

    public function deleteEmail($email)
    {
        return DB::table('password_resets')->where('email',$email)->delete();
    }//end of method

    public function createUser(array $data)
    {
        return User::firstOrCreate($data);
    }//end of method

    public function checkSocialUserEmail($email)
    {
        return User::where(['email' => $email])->first();
    }

    public function socialUser($user_id,$provider)
    {
        return Provider::where('user_id',$user_id)->where('provider',$provider)->first();
    }//end of method

    public function findSocialUser($user_id)
    {
        return User::find($user_id);
    }//end of method


}
?>
