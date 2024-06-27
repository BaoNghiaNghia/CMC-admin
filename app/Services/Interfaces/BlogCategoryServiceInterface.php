<?php

namespace App\Services\Interfaces;



interface BlogCategoryServiceInterface
{
    public function getCategories($page, $limit, $section);
}
