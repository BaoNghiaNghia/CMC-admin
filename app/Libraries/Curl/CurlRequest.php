<?php

namespace App\Libraries\Curl;

use Illuminate\Support\Facades\Http;

class CurlRequest
{
  private $headers;

  public function __construct($headers = [])
  {
    $this->headers = array_merge([
      'accept' => 'application/json',
      'Access-Control-Allow-Origin' => '*',
      'User-Agent' => 'Swagger-Codegen/1.0.0/go',
      'Language' => 'en',
    ], $headers);
  }

  private function request($method, $route, $data = [])
  {
    $options = [
      'headers' => $this->headers,
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
  }

  public function get($url, $data = [])
  {
    return $this->request('GET', $url, $data);
  }

  public function getDetail($url, $id)
  {
    return $this->request('GET', $url . '/' . $id);
  }

  public function post($url, $data = [])
  {
    return $this->request('POST', $url, $data);
  }

  public function put($url, $data = [])
  {
    return $this->request('PUT', $url, $data);
  }

  public function patch($url, $data = [])
  {
    return $this->request('PATCH', $url, $data);
  }
}
