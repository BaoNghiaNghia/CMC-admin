<?php

namespace App\Http\Controllers\blogs;

use App\Services\BlogCategoryService;
use App\Services\BlogService;
use App\Http\Controllers\Controller;
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

  public function getLibraryImages()
  {
    try {
      $LatestBlogs = $this->blogService->getLibraryImages();
      // Fetch media data from the database or any source
      $media = [
        // Example data structure
        ['id' => 1, 'url' => asset('assets/img/backgrounds/5.jpg')],
        ['id' => 2, 'url' => asset('assets/img/backgrounds/16.jpg')],
        ['id' => 3, 'url' => asset('assets/img/backgrounds/15.jpg')],
        // Add more media items as needed
      ];
      return view('content.form-elements.forms-editors', ['media' => $media]);
    } catch (\Exception $e) {
      // Handle exception if HTTP request fails
      // Log error or return appropriate response
      return redirect()->back()->with('status', [
        'success' => false,
        'message' => 'Failed to login user'
      ]);
    }
  }
}
