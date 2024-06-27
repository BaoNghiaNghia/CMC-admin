<?php

namespace App\Services;

use App\Libraries\Curl\CurlRequest;
use App\Services\Interfaces\BlogServiceInterface;

class BlogService implements BlogServiceInterface
{
  public function getBlogs($page, $limit, $categoryId)
  {
    $curl = new CurlRequest();
    $response = $curl->get('/news', [
      'page' => $page,
      'limit' => $limit,
      'category_id' => $categoryId,
    ]);

    return $response['data']['items'];
  }

  public function getBlog($id)
  {
    $curl = new CurlRequest();
    $response = $curl->getDetail('/news', $id);
    return $response['data'];
  }
}
