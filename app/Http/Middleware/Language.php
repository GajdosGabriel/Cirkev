<?php

namespace App\Http\Middleware;

use App;
use Closure;
use Config;
use Session;


class Language
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if( Session::has('applocal') AND array_key_exists( Session::get('applocal'), Config::get('language') ) )
        {
            $locale = Session::get('applocal');
        } else {
            $locale = Config::get('app.locale');
        }
        App::setLocale($locale);
        return $next($request);
    }
}
