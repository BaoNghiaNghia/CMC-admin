<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Services\AuthenService;

class LoginBasic extends Controller
{

  protected $authenService;

  public function __construct(AuthenService $authenService)
  {
    $this->authenService = $authenService;
  }

  public function index()
  {
    $pageConfigs = ['myLayout' => 'blank'];
    return view('content.authentications.auth-login-basic', ['pageConfigs' => $pageConfigs]);
  }

  public function loginUser(Request $request)
  {
    // Handle your API logic here
    $email = $request->input('email');
    $password = $request->input('password');

    $response = $this->authenService->loginUser($email, $password);
    return $response;
  }
}
