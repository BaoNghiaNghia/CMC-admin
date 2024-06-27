<?php

namespace App\Http\Controllers;

use App\Services\BlogCategoryService;
use App\Services\BlogService;
use App\Services\Interfaces\BlogServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BlogCategoryController extends Controller
{
    protected $blogCategoryService;

    public function __construct(BlogCategoryService $blogCategoryService)
    {
        $this->blogCategoryService = $blogCategoryService;
    }

}