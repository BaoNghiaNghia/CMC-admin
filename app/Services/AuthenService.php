<?php

namespace App\Services;

use App\Libraries\Curl\CurlRequest;
use App\Services\Interfaces\AuthenInterface;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class AuthenService implements AuthenInterface
{
  public function loginUser($email, $password)
  {
    try {
      $curl = new CurlRequest();

      $response = $curl->postWithoutToken(Config::get('constants.LOGIN_ENDPOINT'), [
        'email' => $email,
        'password' => $password
      ]);

      return $response;
    } catch (\Exception $e) {
      // Handle exception if HTTP request fails
      // Log error or return appropriate response
      return response()->json([
        'success' => false,
        'message' => $e,
      ]);
    }
  }

  public function registerUser($fullname, $email, $password, $phone)
  {
    $curl = new CurlRequest();
    $response = $curl->postWithoutToken(Config::get('constants.REGISTER_ENDPOINT'), [
      'email' => $email,
      'fullname' => $fullname,
      'password' => $password,
      'phone' => $phone
    ]);

    return $response;
  }

  public function updatePassword($params)
  {
    $curl = new CurlRequest();
    $response = $curl->put(Config::get('constants.UPDATE_PASSWORD_ENDPOINT'), [
      'email' => $params->email,
      'old_password' => $params->old_password,
      'new_password' => $params->new_password
    ]);

    return $response['data'];
  }

  public function updateProfile($params)
  {
    $curl = new CurlRequest();
    $response = $curl->put(Config::get('constants.UPDATE_PROFILE_ENDPOINT'), [
      'name' => $params->name,
      'email' => $params->email
    ]);

    return $response['data'];
  }

  public function fetchProfile($params)
  {
    $curl = new CurlRequest();
    $response = $curl->get(Config::get('constants.DETAIL_PROFILE_ENDPOINT'), [
      'email' => $params->email
    ]);

    return $response['data'];
  }

  public function logout()
  {
    // Perform any necessary cleanup
    Session::forget('user');
    Session::forget('token');

    return redirect()->route('login');
  }
}
