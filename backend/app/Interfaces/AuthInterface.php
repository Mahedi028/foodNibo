<?php

namespace App\Interfaces;


interface AuthInterface
{
    public function RegisterUser(array $data);

    public function VerifyToken($token);

    public function updateUser($token);

    public function emailNotMatch($email);

    public function insertToken($email,$token);

    public function emailCheck($email);

    public function tokenCheck($token);

    public function updatePassword($email,$password);

    public function deleteEmail($email);

    public function createUser(array $data);

    public function checkSocialUserEmail($email);

    public function socialUser($user_id,$provider);

    public function findSocialUser($user_id);


}

?>
