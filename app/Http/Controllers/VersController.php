<?php

namespace App\Http\Controllers;

use App\Ver;
use Illuminate\Http\Request;

use App\Http\Requests;

class VersController extends Controller
{
    public function index($slug=null) {

        if($slug==null){
            $ver = Ver::find(now()->dayOfYear);
            $id = $ver->id;
        }else{
            $ver = Ver::whereSlug($slug)->first();
            $id = $ver->id;
        }

        // Previous link - get slug
        if ( ($id) < 1 ) {
            $previous = Ver::find( Ver::count() )->slug;
        } else {
            $previous = Ver::find($id - 1)->slug;
        }

        // Next link
        if ( ($id) < Ver::count() ) {
            $next = Ver::find($id + 1)->slug;
        } else {
            $next = Ver::first()->slug;
        }

        $date = date_from_day_of_year(null, $id);

    return view('pages.verse')
        ->with('previous', $previous)
        ->with('next', $next)
        ->with('post', $ver)
        ->with('date', $date)
        ->with('title', trans('web.daily_read'));


}

//    public function index($id=null) {
//        $id=($id==null)?date('z'):$id;
//
//        // get the current post
//        $post = Ver::find($id);
//
//        // get previous post id
//        $previous = Ver::where('id', '<', $post->id)->max('id');
//
//        // get next post id
//        $next = Ver::where('id', '>', $post->id)->min('id');
//
//        return view('posts.verse')
//            ->with('previous', $previous)
//            ->with('next', $next)
//            ->with('post', $post)
//            ->with('title', 'Denné stíšenie');
//
//
//    }





}
