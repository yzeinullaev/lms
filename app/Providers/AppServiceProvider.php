<?php

namespace App\Providers;

use App\Models\Language;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        View::composer('*', function($view)
        {
            $langs = Language::orderBy('id', 'ASC')->get();

            $view->with('langs', $langs);
        });

        View::composer('*', function($view)
        {
            $lang = Language::orderBy('id', 'ASC')->pluck('slug')->first();

            $view->with('lang', $lang);
        });
        
    }
}
