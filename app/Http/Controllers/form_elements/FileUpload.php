<?php

namespace App\Http\Controllers\form_elements;

use App\Http\Controllers\Controller;
use App\Services\BlogCategoryService;
use App\Services\BlogService;
use Illuminate\Http\Request;

class FileUpload extends Controller
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
    $limit = 150;

    $listNews = $this->blogService->getListBlogs([
      'page' => $page,
      'limit' => $limit,
      'created_at_sort' => -1
    ]);
    if (isset($listNews['error_code']) && $listNews['error_code'] === 0) {
      return view('content.form-elements.forms-file-upload', [
        'listNews' => $listNews['data']['items'],
        'listNewsMeta' => $listNews['data']['meta'],
      ]);
    } else {
      $dataNews = [];
      $dataNews['status'] = [
        'success' => false,
        'message' => 'Failed to fetch data'
      ];

      return $dataNews;
    }
  }
}
