<?php

namespace App\Services\Interfaces;



interface BlogServiceInterface
{
  public function getBlogs($page, $limit, $categoryId);

  public function getBlog($id);
}
