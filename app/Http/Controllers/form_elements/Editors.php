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

      $latestBlogs = $this->blogService->getLibraryImages();

      $data = [
        'languages' => Config::get('constants.LANGUAGE_LOCALE'),
        'blogCategories' => [],
        'blogCategoriesMeta' => null,
        'status' => [
          'success' => true,
          'message' => 'Data fetched successfully'
        ]
      ];

      if ($blogCategories['error_code'] === 0) {
        $data['blogCategories'] = $blogCategories['data']['item'];
        $data['blogCategoriesMeta'] = $blogCategories['data']['meta'];
      } else {
        $data['status'] = [
          'success' => false,
          'message' => 'Failed to fetch data'
        ];
      }

      if ($latestBlogs['error_code'] === 0) {
        $data['imageLibrary'] = $latestBlogs['data'];
      } else {
        $data['status'] = [
          'success' => false,
          'message' => 'Failed to fetch data'
        ];
      }
      return view('content.form-elements.forms-editors', $data);
    } catch (\Exception $e) {
      logger()->error('Failed to fetch data initialize', ['exception' => $e]);

      // return view('content.form-elements.forms-editors')->with('status', [
      //   'success' => false,
      //   'message' => 'Failed to fetch data initialize'
      // ])->with('languages', Config::get('constants.LANGUAGE_LOCALE'))
      //   ->with('blogCategories', [])
      //   ->with('blogCategoriesMeta', null);
    }
  }

  public function getLibraryImages()
  {
    try {
      $LatestBlogs = $this->blogService->getLibraryImages();
      // Fetch media data from the database or any source

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
