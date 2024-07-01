<?php

namespace App\Libraries\Curl;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class CurlRequest
{
  private $headers;

  private function getToken()
  {
    return Cookie::get('token');
  }

  public function __construct($headers = [])
  {
    $this->headers = array_merge([
      'Accept' => 'application/json',
      'Access-Control-Allow-Origin' => '*',
      'User-Agent' => 'Swagger-Codegen/1.0.0/go',
      'Content-Type' => 'application/json',
      'Language' => 'en',
    ], $headers);
  }

  private function request($method, $route, $data = [], $extraHeaders = [])
  {
    try {

      $token = $this->getToken();

      if (!$token) {
        // Token does not exist or expired, block request
        return response()->json([
          'success' => false,
          'message' => 'Unauthorized: Token is missing or expired.',
        ], 401);
      }

      $options = [
        'headers' => array_merge($this->headers, [
          'Authorization' => 'Bearer ' . $token,
        ], $extraHeaders),
        'method' => $method,
      ];

      $base_api = env('BASE_API_URL');
      $route_api = $base_api . $route;

      if (!empty($data)) {
        if ($method == 'GET') {
          $route_api .= '?' . http_build_query($data);
        } else {
          $options['body'] = json_encode($data);
        }
      }

      $response = Http::withHeaders($this->headers)->send($method, $route_api, $options);
      return $response;
    } catch (\Exception $e) {
      // Handle exception if HTTP request fails
      // Log error or return appropriate response
      return response()->json([
        'success' => false,
        'message' => 'Error ',
        'data' => $e
      ]);
    }
  }
  private function requestWithoutToken($method, $route, $data = [], $extraHeaders = [])
  {
    try {
      $headers = array_merge($this->headers, $extraHeaders);
      $options = [
        'headers' => $headers,
        'method' => $method,
      ];

      $base_api = env('BASE_API_URL');
      $route_api = $base_api . $route;

      if (!empty($data)) {
        if ($method == 'GET') {
          $route_api .= '?' . http_build_query($data);
        } else {
          $options['body'] = json_encode($data);
        }
      }

      $response = Http::withHeaders($this->headers)->send($method, $route_api, $options);
      return $response;
    } catch (\Exception $e) {
      // Handle exception if HTTP request fails
      // Log error or return appropriate response
      return response()->json([
        'success' => false,
        'message' => 'Error ',
        'data' => $e
      ]);
    }
  }

  private function uploadFile($method, $route, $file, $data = [], $extraHeaders = [])
  {
    try {
      $token = $this->getToken();

      if (!$token) {
        // Token does not exist or expired, block request
        return response()->json([
          'success' => false,
          'message' => 'Unauthorized: Token is missing or expired.',
        ], 401);
      }

      // Merge headers with token authorization and any extra headers
      $headers = array_merge([
        'Authorization' => 'Bearer ' . $token,
      ], $this->headers, $extraHeaders);

      $base_api = env('BASE_API_URL');
      $route_api = $base_api . $route;

      // Ensure 'from' field is included in the data
      $data = array_merge($data, ['from' => 'blog']);

      // Prepare the file and additional data for upload
      $response = Http::withHeaders($headers)
        ->attach('file', file_get_contents($file->getRealPath()), $file->getClientOriginalName())
        ->post($route_api, $data);

      return $response;
    } catch (\Exception $e) {
      // Handle exception if HTTP request fails
      // Log error or return appropriate response
      return response()->json([
        'success' => false,
        'message' => 'An error occurred while uploading the file.',
        'error' => $e->getMessage(),
      ], 500);
    }
  }

  public function upload($url, $file, $data, $extraHeaders = [])
  {
    return $this->uploadFile('POST', $url, $file, $data, $extraHeaders);
  }

  public function get($url, $data = [], $extraHeaders = [])
  {
    return $this->request('GET', $url, $data, $extraHeaders);
  }

  public function getWithoutToken($url, $data = [], $extraHeaders = [])
  {
    return $this->requestWithoutToken('GET', $url, $data, $extraHeaders);
  }

  public function postWithoutToken($url, $data = [], $extraHeaders = [])
  {
    return $this->requestWithoutToken('POST', $url, $data, $extraHeaders);
  }


  public function getDetail($url, $id, $extraHeaders = [])
  {
    return $this->request('GET', $url . '/' . $id, $extraHeaders);
  }

  public function post($url, $data, $extraHeaders = [])
  {
    return $this->request('POST', $url, $data, $extraHeaders);
  }

  public function put($url, $data = [], $extraHeaders = [])
  {
    return $this->request('PUT', $url, $data, $extraHeaders);
  }

  public function patch($url, $data = [], $extraHeaders = [])
  {
    return $this->request('PATCH', $url, $data, $extraHeaders);
  }
}
