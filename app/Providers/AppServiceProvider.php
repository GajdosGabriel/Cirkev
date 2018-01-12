<?php

namespace App\Providers;

use App\Denomination;
use App\Event;
use App\Post;
use App\Group;
use App\Comment;
use App\Tag;
use App\User;
use App\Ver;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//        Set of local datatime
        Carbon::setLocale(config('app.locale'));

//        Set of migration limit
        Schema::defaultStringLength(191);


        //Validation Rule of antispam
        \Validator::extend('spamDetection', '\App\Rules\SpamFree@passes');


        view()->composer('events.eventsModul', function ($view) {
            $view->with('events', Event::activeEventsList()->take(5)->get());
        });


        view()->composer('partials.navigation', function ($view) {
//            $view->with('posledny', Post::latest()->first());
            $view->with('user', \Auth::user());
        });

        view()->composer('modul.statistika',  function($view) {
            $view->with('posledne_prispevky', Post::orderBy('count_view', 'desc')->take(5)->get());
            $view->with('posledne_com', Comment::orderBy('created_at', 'desc')->take(5)->get());
        });


        view()->composer('modul.spravy',  function($view) {
            $view->with('posts', Post::where('group_id', '=', 5)->orderBy('id', 'desc')->take(1)->get());
            $view->with('postsNext', Post::where('group_id', '=', 5)->orderBy('id', 'desc')->skip(1) ->take(5)->get());
        });


        view()->composer('modul.latestcom', function($view) {
            $view->with('posledne_com', Comment::orderBy('id', 'desc')->take(7)->get());
        });

        view()->composer('modul.latestusers', function($view) {
            $view->with('newUsers', User::orderBy('id', 'desc')->take(7)->get());
        });


//        view()->composer(['modul.category', 'posts.form' ], function($view)
//        {
//        $groups = Cache::rememberForever('groups', function(){
//            return Group::all();
//        });
////        $view->with('categories',  $groups);
//            $view->with('categories', Group::pluck('name', 'id'));
//
//        });

        view()->composer(['modul.category', 'posts.form' ], function($view)
        {
            $view->with('categories', Group::all());
            $view->with('users', User::orderBy('lastName')->get());
        });


//        Profil Google map
        view()->composer('user.edit', function($view)
        {
            $view->with('denomination', Denomination::pluck('title', 'id') );

        });


        view()->composer('modul.tags', function($view)
        {
            $view->with('tags', Tag::all());
        });

        view()->composer('partials.carousel', function($view)
        {
            $view->with('users', \DB::table('users')->where([['avatar', '!=' , ''],['frontAuthor', '=', '1']] )->orderBy('knowHim', 'desc')->get());
        });

    //pass Users to google map modul
        view()->composer('modul.googlemap', function($view)
        {
            googleMap();
            $view->with('users', \DB::table('users')->get());
        });




    }











    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        require_once __DIR__ . '/../Http/helpers.php';

        if($this->app->isLocal()) {
            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
        }

    }
}
