<?php

namespace App\Providers;
use App\GetBooks;
use App\Slide;
use Illuminate\Support\Facades\View;
use App\Categories;
use Illuminate\Support\ServiceProvider;

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
        
        $cat = Categories::select('id','name', 'slug', 'description')->get();
        if($cat){
            View::share('cat_h', $cat);
        }
       
        $slide = Slide::select('title', 'description', 'image')->get();
        if($slide){
            View::share('slide_h', $slide);
        }
        $rq = GetBooks::where('status',1)->get()->count();
        $rf = GetBooks::where('status',3)->get()->count();
        
        View::share('rq', $rq);
     
       
        View::share('rf', $rf);
        
      

    }
}
