<?php

namespace App\Providers;

use App\Services\BlogService;
use Illuminate\Support\ServiceProvider;

class BlogServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Bind BlogService as singleton
        $this->app->singleton(BlogService::class, function ($app) {
            return new BlogService();
        });

        // Create alias for easier access
        $this->app->alias(BlogService::class, 'blog');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
