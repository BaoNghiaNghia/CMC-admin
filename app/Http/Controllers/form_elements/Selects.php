<?php

namespace App\Http\Controllers\form_elements;

use App\Http\Controllers\Controller;
use App\Services\BlogCategoryService;
use App\Services\BlogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cookie;

class Selects extends Controller
{
  protected $blogService;
  protected $blogCategoryService;

  public function __construct(BlogService $blogService, BlogCategoryService $blogCategoryService)
  {
    $this->blogService = $blogService;
    $this->blogCategoryService = $blogCategoryService;
  }

  public function index()
  {
    $page = 1;
    $limit = 100;

    $data = [
      'languages' => Config::get('constants.LANGUAGE_LOCALE'),
      'userCurrent' => json_decode(Cookie::get('user'), true),
    ];

    $listTags = $this->blogService->getListTags([
      'page' => $page,
      'limit' => $limit
    ]);

    if (isset($listTags['error_code']) && $listTags['error_code'] === 0) {
      $data['listTags'] = $listTags['data']['items'];
      $data['listTagsMeta'] = $listTags['data']['meta'];
    }

    return view('content.form-elements.blog-tags', $data);
  }
}
