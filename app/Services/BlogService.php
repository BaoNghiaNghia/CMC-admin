<?php

namespace App\Services;

use App\Libraries\Curl\CurlRequest;
use App\Services\Interfaces\BlogServiceInterface;
use Illuminate\Support\Facades\Config;

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

  public function getLibraryImages()
  {
    $curl = new CurlRequest();
    $response = $curl->get(Config::get('constants.IMAGES_LIBRARY_ENDPOINT'), [
      'language' => 'en',
    ]);

    return $response;
  }

  public function uploadImage($file, $additionalData)
  {
    $curl = new CurlRequest();
    $response = $curl->upload(Config::get('constants.IMAGE_UPLOAD_ENDPOINT'), $file, $additionalData, []);

    return $response;
  }
  public function publishPost($data)
  {
    $curl = new CurlRequest();
    $response = $curl->post(Config::get('constants.PUBLISH_POST_ENDPOINT'), $data, []);

    return $response;
  }

  public function getListBlogs($data)
  {
    $curl = new CurlRequest();
    $response = $curl->get(Config::get('constants.PUBLISH_POST_ENDPOINT'), $data, []);

    return $response;
  }
  public function getListTags($data)
  {
    $curl = new CurlRequest();
    $response = $curl->get(Config::get('constants.BLOG_TAGS_ENDPOINT'), $data, []);

    return $response;
  }

  public function getListAuthor($data)
  {
    $curl = new CurlRequest();
    $response = $curl->get(Config::get('constants.AUTHORS_ENDPOINT'), $data, []);

    return $response;
  }
}
