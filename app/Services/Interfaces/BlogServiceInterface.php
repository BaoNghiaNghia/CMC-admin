<?php

namespace App\Services\Interfaces;



interface BlogServiceInterface
{
  public function getBlogs($page, $limit, $categoryId);

  public function getBlog($id);

  public function getLibraryImages();

  public function uploadImage($file, $additionalData);

  public function publishPost($data);
}
