<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

use App\Http\Requests;

class TagController extends Controller
{


    public function index($id) {

        $tag = Tag::findOrFail($id);
        return view ('posts.index')
            ->with('title' , $tag->tag)
            ->with('posts', $tag->posts);

    }

    public function show (Tag $tag) {

        $posts = Tag::find($tag->id)->posts()->paginate(12);

        return view('posts.index')
            ->with('posts', $posts)
            ->with('title', $tag->tag);
    }



}
