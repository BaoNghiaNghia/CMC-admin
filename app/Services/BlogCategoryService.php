<?php

namespace App\Services;

use App\Libraries\Curl\CurlRequest;
use App\Services\Interfaces\BlogCategoryServiceInterface;
use App\Services\Interfaces\CategoryServiceInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BlogCategoryService implements BlogCategoryServiceInterface
{
    public function getCategories($page, $limit, $section)
    {
        $curl = new CurlRequest();
        $response = $curl->get('/admin/news/categories', [
            'page' => $page,
            'limit' => $limit,
            'section' => $section,
        ]);

        // Log::info($response);


        return $response['data']['item'];
    }
}
