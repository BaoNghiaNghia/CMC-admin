<?php

namespace App\Services;

use App\Libraries\Curl\CurlRequest;
use App\Services\Interfaces\BlogCategoryServiceInterface;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;

class BlogCategoryService implements BlogCategoryServiceInterface
{
  public function getCategories($page, $limit, $section)
  {
    try {
      $curl = new CurlRequest();
      $response = $curl->get(Config::get('constants.BLOG_CATEGORIES_ENDPOINT'), [
        'page' => $page,
        'limit' => $limit,
        'section' => $section,
      ]);

      return $response;
    } catch (\Exception $e) {
      // Log the error if needed
      Log::error('Failed to fetch blog categories', ['exception' => $e]);

      // Return an empty array if an error occurs
      return [];
    }
  }
}
