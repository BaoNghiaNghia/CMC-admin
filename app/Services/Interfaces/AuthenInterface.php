<?php

namespace App\Services\Interfaces;



interface AuthenInterface
{
  public function loginUser($email, $password);

  public function registerUser($fullname, $email, $password, $phone);

  public function fetchProfile($params);

  public function updateProfile($params);

  public function updatePassword($params);
}
