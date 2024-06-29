<?php

namespace App\Http\Controllers\form_elements;

use App\Http\Controllers\Controller;
use App\Services\BlogCategoryService;
use App\Services\BlogService;
use Illuminate\Support\Facades\Config;

class Editors extends Controller
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
    try {
      $blogCategories = $this->blogCategoryService->getCategories(1, 10, 'blog');
      return view(
        'content.form-elements.forms-editors',
        [
          'blogCategories' => $blogCategories,
          'languages' => Config::get('constants.LANGUAGE_LOCALE')
        ]
      );

      // return response()->json([
      //   'data' => $blogCategories,
      // ]);
    } catch (\Exception $e) {
      /// Log the error if needed
      logger()->error('Failed to fetch data initialize', ['exception' => $e]);

      // Return view with error message
      return view('content.form-elements.forms-editors')->with('status', [
        'success' => false,
        'message' => 'Failed to fetch data initialize'
      ]);
    }
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
