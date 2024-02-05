<?php

namespace App\Interfaces;


interface UserInterface
{
    public function getAllOrderFromUser();

    public function getUserById($id);

    public function updateUserData(array $data, $user);
}

?>
