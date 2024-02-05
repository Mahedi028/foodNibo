<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Interfaces\AuthInterface;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use GuzzleHttp\Exception\ClientException;


class SocialLoginController extends Controller
{
    use ResponseTrait;

    protected $auth;

    public function __construct(AuthInterface $authInterface)
    {
        $this->auth=$authInterface;
    }
    public function redirectToProvider($provider)
    {

        $validated=$this->validateProvider($provider);
        if(!is_null($validated)){
            return $validated;
        }

        try{
            // $scopes = [
            //     'https://www.googleapis.com/auth/webmasters',
            //     'https://www.googleapis.com/auth/webmasters.readonly',
            //     'https://www.googleapis.com/auth/analytics.readonly',
            //     'https://www.googleapis.com/auth/userinfo.profile',
            //     'https://www.googleapis.com/auth/userinfo.email',
            //   ];
            // $redirect_url=Socialite::driver($provider)->stateless()->redirect()->getTargetUrl();
            // $redirect_url=Socialite::driver($provider)
            // ->scopes($scopes) // For any extra scopes you need, see https://developers.google.com/identity/protocols/googlescopes for a full list; alternatively use constants shipped with Google's PHP Client Library
            // ->with(["access_type" => "offline", "prompt" => "consent select_account"])
            // ->redirect();
            // $redirect_url=Socialite::driver('google')->with(["access_type" => "offline", "prompt" => "consent select_account"])->redirect()->getTargetUrl();
            $redirect_url=Socialite::driver($provider)
            ->scopes(['openid','email','https://www.googleapis.com/auth/userinfo.email'])
            ->with(['access_type'=>'offline','prompt'=>'consent select_account'])
            ->stateless()
            ->redirect()
            ->getTargetUrl();
            // $redirect_url=Socialite::driver('google')->setScopes(['openid', 'email'])->redirect()->getTargetUrl();

            return $this->responseSuccess($redirect_url,'User redirect to provider',200);

        }catch(\Exception $e){
            return $this->responseError($e->getMessage(),'Error',400);
        }



    }//end of method

    public function handleProviderCallback($provider)
    {
        $validated=$this->validateProvider($provider);
        if(!is_null($validated)){
            return $validated;
        }
        try{

            // $token = Socialite::driver('google')->user()->token;
            // $userSocial = Socialite::driver('google')->userFromToken($token)->stateless();

            // $token=request()->input('code');




            // $userSocial=Socialite::driver('google')->userFromToken($token);


            // return response()->json([
                // 'data'=>$token,
                // 'user'=>$userSocial
            // ]);





            // $access_token = Socialite::driver($provider)->getAccessTokenResponse($token);
            // $userSocial = Socialite::driver($provider)->userFromToken($access_token['access_token'])->stateless()->user();

            // return response()->json([
                // 'details'=>$userSocialDetails,
                // 'data'=> $userSocial,
                // 'email'=>$email,
                // 'user'=>$user
            // ]);

            $userSocial=Socialite::driver($provider)->stateless()->user();
            // $userSocial=Socialite::driver($provider)->stateless()->user();
            // $userSocial=Socialite::driver($provider)->user();



            // $userSocialDetails=$userSocial->userFromToken(request()->input('access_token'));
            // $userSocialDetails=$userSocial->userFromToken($userSocial->token);





            //social user email
            $email=$userSocial->getEmail();

            $user = $this->auth->checkSocialUserEmail($email);


            if($user!=null){
                //check if user exist
                Auth::login($user);

                $loginUser=Auth::user();

                //assign access token and user data
                $token=$user->createToken('app')->plainTextToken;

                return response()->json([
                    'user'=>$loginUser,
                    'token'=>$token
                ]);
            }else{
                //check if user are not exist
                $data=[];
                $data['email']=$userSocial->getEmail();
                $data['email_verified_at']=now();
                $data['name']=$userSocial->getName()===null?'no-name':$userSocial->getNickname();
                $data['password']='12345';
                $data['phone_number']=null;
                $data['profile_photo_path']=$userSocial->getAvatar();

                //create user in user table
                $userCreated=$this->auth->createUser($data);

                //create provider in provider table
                $userCreated->providers()->updateOrCreate(
                    [
                        'provider'=>$provider,
                        'provider_id'=>$userSocial->getId(),
                    ],
                    [
                        'avatar'=>$userSocial->getAvatar()
                    ]
                    );

              //check if social user provider record is stored
              $userSocialAccount=$this->auth->socialUser($userCreated->id,$provider);

              if($userSocialAccount){
                //retrieve the user from users store
                $user=$this->auth->findSocialUser($userSocialAccount->user_id);

                //assign access token and user data
                $token=$user->createToken('app')->plainTextToken;


                //return access token and user data
                return response()->json([
                    'token'=>$token,
                    'user'=>$user,
                    'status'=>true
                ],200);
              }

            }

        }catch(\Exception $e){
            return $this->responseError($e->getMessage(),'Error',400);
        }



    }//end of method

    protected function validateProvider($provider)
    {
        if(!in_array($provider,['facebook','google','github'])){
            return $this->responseError(null,'Please login using facebook, google, github',422);
        }
    }//end of method

    private function issueToken(User $user) {

        $userToken = $user->token() ?? $user->createToken('socialLogin');

        return [
            "token_type" => "Bearer",
            "access_token" => $userToken->accessToken
        ];
    }




}
