<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use App\Services\AuthenService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RegisterCover extends Controller
{

  protected $authenService;

  public function __construct(AuthenService $authenService)
  {
    $this->authenService = $authenService;
  }

  public function index()
  {
    $pageConfigs = ['myLayout' => 'blank'];
    return view('content.authentications.auth-register-cover', ['pageConfigs' => $pageConfigs]);
  }

  public function registerUser(Request $request)
  {
    try {
      // Retrieve user input from request
      $fullname = $request->input('fullname');
      $email = $request->input('email');
      $password = $request->input('password'); // Ensure this is hashed in the service layer
      $phone = $request->input('phone');

      // Call the registration method from AuthenService
      $response = $this->authenService->registerUser($fullname, $email, $password, $phone);

      // Check if registration was successful
      if ($response['error_code'] === 0) {
        // Redirect to the login page with success message
        return redirect()->route('auth-login-cover')->with('status', [
          'success' => true,
          'message' => 'Registration successful. Please login.'
        ]);
      }

      // Handle unsuccessful registration
      return redirect()->back()->with('status', [
        'success' => false,
        'message' => $response['message'] ?? 'Registration failed'
      ]);
    } catch (\Exception $e) {
      // Log error and return error message
      Log::error('Registration error: ' . $e->getMessage());
      return redirect()->back()->with('status', [
        'success' => false,
        'message' => 'Failed to register user'
      ]);
    }
  }
}
