<?php

namespace App\Http\Controllers\form_elements;

use App\Http\Controllers\Controller;
use App\Services\BlogCategoryService;
use App\Services\BlogService;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

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

      $libraryImg = $this->blogService->getLibraryImages();

      $data = [
        'languages' => Config::get('constants.LANGUAGE_LOCALE'),
        'userCurrent' => json_decode(Cookie::get('user'), true),
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

      if ($libraryImg['error_code'] === 0) {
        $data['imageLibrary'] = $libraryImg['data'];
      } else {
        $data['status'] = [
          'success' => false,
          'message' => 'Failed to fetch data'
        ];
      }
      return view('content.form-elements.forms-editors', $data);
    } catch (\Exception $e) {
      logger()->error('Failed to fetch data initialize', ['exception' => $e]);

      return view('content.form-elements.forms-editors')->with('status', [
        'success' => false,
        'message' => 'Failed to fetch data initialize'
      ])->with('languages', Config::get('constants.LANGUAGE_LOCALE'))
        ->with('blogCategories', [])
        ->with('blogCategoriesMeta', null);
    }
  }

  public function getLibraryImages()
  {
    try {
      $libraryImg = $this->blogService->getLibraryImages();
      // Fetch media data from the database or any source
      if ($libraryImg['error_code'] === 0) {
        return view('content.form-elements.forms-editors', ['imageLibrary' => $libraryImg['data']]);
      }

      return view('content.form-elements.forms-editors', ['imageLibrary' => []]);
    } catch (\Exception $e) {
      // Handle exception if HTTP request fails
      // Log error or return appropriate response
      return redirect()->back()->with('status', [
        'success' => false,
        'message' => 'Failed to login user'
      ]);
    }
  }

  public function uploadImage(Request $request)
  {
    try {
      // Validate the file input
      $request->validate([
        'image_file' => 'required|file|max:10240', // max file size is 10MB
      ], [
        'image_file.required' => 'The file is required.',
        'image_file.file' => 'The file must be a valid file.',
        'image_file.max' => 'The file size must not exceed 10MB.'
      ]);

      if ($request->hasFile('image_file')) {
        $file = $request->file('image_file');

        // Additional data to be sent with the file
        $additionalData = [
          'from' => 'blog',
        ];

        $uploadedImage = $this->blogService->uploadImage($file, $additionalData);

        if ($uploadedImage['error_code'] === 0) {
          return $uploadedImage['data'];
        }
      } else {
        return response()->json([
          'status' => false,
          'message' => 'No file found in the request'
        ]);
      }
    } catch (\Illuminate\Validation\ValidationException $e) {
      // Handle validation errors
      return response()->json([
        'status' => false,
        'message' => 'Validation error',
        'errors' => $e->errors()
      ], 422);
    } catch (\Exception $e) {
      // Handle other exceptions
      return response()->json([
        'status' => false,
        'message' => 'Failed to upload image',
        'error' => $e->getMessage()
      ], 500);
    }
  }

  public function publishPost(Request $request)
  {
    try {
      // Get all data from the request
      // Assuming the JSON data is in the body of the request
      $data = $request->json()->all();

      // Extracting specific fields
      $categoryId = $data['category_id'];
      $title = $data['title'];
      $content = $data['content'];
      $summary = $data['summary'];
      $thumbnailId = $data['thumbnail_id'];
      $languages = $data['languages'];
      $author = $data['author'];

      // Example of how you can use the extracted data
      $publishResponse = $this->blogService->publishPost([
        'category_id' => $categoryId,
        'title' => $title,
        'content' => $content,
        'summary' => $summary,
        'thumbnail_id' => $thumbnailId,
        'languages' => $languages,
        'author' => $author,
      ]);


      return $publishResponse;
    } catch (\Exception $e) {
    }
  }
}
