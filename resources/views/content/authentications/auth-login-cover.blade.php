@php
    $configData = Helper::appClasses();
    $customizerHidden = 'customizer-hide';
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Login Cover - Pages')

@section('vendor-style')
    <!-- Vendor -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
@endsection

@section('page-style')
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css') }}">
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/bundle/popular.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js') }}"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
@endsection

@section('page-script')
    <script type="module" src="{{ asset('assets/js/pages-auth.js') }}"></script>
    <script type="text/javascript">
      document.addEventListener("DOMContentLoaded", function() {
        @if(session('status'))
          Toastify({
            text: "{{ session('status')['message'] }}",
            duration: 3000,
            close: true,
            gravity: "bottom", // `top` or `bottom`
            position: "center", // `left`, `center` or `right`
            backgroundColor: "{{ session('status')['success'] ? 'green' : 'red' }}",
          }).showToast();
        @endif
      });
    </script>
@endsection

@section('content')
    <div class="authentication-wrapper authentication-cover">
        <!-- Logo -->
        <a href="{{ url('/') }}" class="auth-cover-brand d-flex align-items-center gap-2">
            <span class="app-brand-logo demo">@include('_partials.macros', ['width' => 25, 'withbg' => 'var(--bs-primary)'])</span>
            <span class="app-brand-text demo text-heading fw-bold">{{ config('variables.templateName') }}</span>
        </a>
        <!-- /Logo -->
        <div class="authentication-inner row m-0">
            <!-- /Left Section -->
            <div class="d-none d-lg-flex col-lg-7 col-xl-8 align-items-center justify-content-center p-5 pb-2">
                <img src="{{ asset('assets/img/illustrations/auth-login-illustration-' . $configData['style'] . '.png') }}"
                    class="auth-cover-illustration w-100" alt="auth-illustration"
                    data-app-light-img="illustrations/auth-login-illustration-light.png"
                    data-app-dark-img="illustrations/auth-login-illustration-dark.png" />
                <img src="{{ asset('assets/img/illustrations/auth-cover-login-mask-' . $configData['style'] . '.png') }}"
                    class="authentication-image" alt="mask"
                    data-app-light-img="illustrations/auth-cover-login-mask-light.png"
                    data-app-dark-img="illustrations/auth-cover-login-mask-dark.png" />
            </div>
            <!-- /Left Section -->

            <!-- Login -->
            <div
                class="d-flex col-12 col-lg-5 col-xl-4 align-items-center authentication-bg position-relative py-sm-5 px-4 py-4">
                <div class="w-px-400 mx-auto pt-5 pt-lg-0">
                    <h4 class="mb-2">Welcome to {{ config('variables.templateName') }}! 👋</h4>
                    <p class="mb-4">Please sign-in to your account</p>

                    <form id="formAuthentication" class="mb-3" action="{{ route('api.loginUser') }}" method="POST">
                      @csrf
                      <div class="form-floating form-floating-outline mb-3">
                          <input type="text" class="form-control" id="email" name="email"
                              placeholder="Enter your email or username" autofocus>
                          <label for="email">Email</label>
                      </div>
                      <div class="mb-3">
                          <div class="form-password-toggle">
                              <div class="input-group input-group-merge">
                                  <div class="form-floating form-floating-outline">
                                      <input type="password" id="password" class="form-control" name="password"
                                          placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                          aria-describedby="password" />
                                      <label for="password">Password</label>
                                  </div>
                                  <span class="input-group-text cursor-pointer"><i
                                          class="mdi mdi-eye-off-outline"></i></span>
                              </div>
                          </div>
                      </div>
                      <button class="btn btn-primary d-grid w-100">
                          Login
                      </button>
                    </form>

                    <p class="text-center mt-2">
                      <span>Don't have an account?</span>
                      <a href="{{url('auth/register-cover')}}">
                        <span>Register new account</span>
                      </a>
                    </p>
                </div>
            </div>
            <!-- /Login -->
        </div>
    </div>
@endsection
