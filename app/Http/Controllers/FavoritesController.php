<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;


class FavoritesController extends Controller
{
    public function store(Comment $comment) {

        $comment->favorite();
        return back();

    }
}
