<?php

namespace App\Http\Controllers\form_elements;

use App\Http\Controllers\Controller;
use App\Services\BlogCategoryService;
use App\Services\BlogService;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cookie;

class Picker extends Controller
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
    $data = [
      'languages' => Config::get('constants.LANGUAGE_LOCALE'),
      'userCurrent' => json_decode(Cookie::get('user'), true),
    ];

    $blogCategories = $this->blogCategoryService->getCategories(1, 100, 'blog');

    if (isset($blogCategories['error_code']) && $blogCategories['error_code'] === 0) {
      $data['blogCategories'] = $blogCategories['data']['categories'];
      $data['blogCategoriesMeta'] = $blogCategories['data']['meta'];
    } else {
      $data['status'] = [
        'success' => false,
        'message' => 'Failed to fetch data'
      ];
    }

    return view('content.form-elements.blog-category', $data);
  }
}
