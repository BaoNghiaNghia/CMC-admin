<?php

namespace App\Http\Controllers;

use App\Services\BlogCategoryService;
use App\Services\BlogService;
use App\Services\CategoryService;
use App\Services\Interfaces\BlogServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BlogController extends Controller
{
  protected $blogService;
  protected $blogCategoryService;

  public function __construct(BlogService $blogService, BlogCategoryService $blogCategoryService)
  {
    $this->blogService = $blogService;
    $this->blogCategoryService = $blogCategoryService;
  }

  public function list()
  {
    $latestBlogs = $this->blogService->getBlogs(1, 10, '667a660c389e2780b0d779c5');
    $blogCategories = $this->blogCategoryService->getCategories(page: 1, limit: 5, section: 'blog');
    // Log::info('LANGUAGE: '. VI_LANGUAGE);

    return view('/home/blog/pages/blogList', [
      'latestBlogs' => $latestBlogs,
      'categories' => $blogCategories,
    ]);
  }

  public function detail($id)
  {
    // $blog = $this->blogService->getBlog($id);
    // $blog = [];

    $LatestBlogs = $this->blogService->getBlogs(1, 5, '667a660c389e2780b0d779c5');
    $detailedBlog = $this->blogService->getBlog($id);
    $blogCategories = $this->blogCategoryService->getCategories(1, 5, 'blog');

    return view('/home/blog/pages/blogDetail', [
      'latestBlogs' => $LatestBlogs,
      'detailedBlog' => $detailedBlog,
      'categories' => $blogCategories,
    ]);
  }
}
