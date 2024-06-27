<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\AuthenService;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cookie;

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
    try {
      // Handle your API logic here
      $email = $request->input('email');
      $password = $request->input('password');

      $response = $this->authenService->loginUser($email, $password);

      if ($response['error_code'] === 0) {
        // Save token and user data to cookies
        Cookie::queue('token', $response['data']['token'], Config::get('COOKIES_SESSION_TIME')); // Cookie for 60 minutes
        Cookie::queue('user', json_encode($response['data']['user']), Config::get('COOKIES_SESSION_TIME')); // Cookie for 60 minutes

        // Redirect to the desired path with success message
        return redirect()->route('dashboard-analytics')->with('status', [
          'success' => true,
          'message' => 'Login successful'
        ]);
      }

      return redirect()->back()->with('status', [
        'success' => false,
        'message' => 'Invalid credentials'
      ]);
    } catch (\Exception $e) {
      // Handle exception if HTTP request fails
      // Log error or return appropriate response
      return redirect()->back()->with('status', [
        'success' => false,
        'message' => 'Failed to login user'
      ]);
    }
  }
}
