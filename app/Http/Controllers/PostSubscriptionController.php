<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;


class PostSubscriptionController extends Controller
{
    public function store(Post $post) {

        $post->subscribe();

    }

    public function destroy(Post $post) {

        $post->unsubscribe();

    }
}
