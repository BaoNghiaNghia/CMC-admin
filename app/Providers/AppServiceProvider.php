<?php

namespace App\Providers;

use App\Services\AuthenService;
use App\Services\BlogCategoryService;
use App\Services\BlogService;

use App\Services\Interfaces\AuthenInterface;
use App\Services\Interfaces\BlogCategoryServiceInterface;
use App\Services\Interfaces\BlogServiceInterface;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   */
  public function register(): void
  {
    //
    $this->app->bind(AuthenInterface::class, AuthenService::class);

    $this->app->bind(BlogServiceInterface::class, BlogService::class);

    $this->app->bind(BlogCategoryServiceInterface::class, BlogCategoryService::class);
  }

  /**
   * Bootstrap any application services.
   */
  public function boot(): void
  {
    //
  }
}
