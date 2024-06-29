<?php

namespace App\Http\Controllers\blogs;

use App\Services\BlogCategoryService;
use App\Services\BlogService;
use App\Services\Interfaces\BlogServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class BlogCategoryController extends Controller
{
  protected $blogCategoryService;

  public function __construct(BlogCategoryService $blogCategoryService)
  {
    $this->blogCategoryService = $blogCategoryService;
  }
}
