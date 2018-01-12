<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Events\CommentNewNotification;
use App\Http\Requests\SaveCommentsRequest;
use App\Post;
use App\Services\SpamDetector;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;



class CommentsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('store');
    }

    public function update(SaveCommentsRequest $request, Comment $comment) {

       $this->authorize('update', $comment);

       $comment->update(request(['body']));
    }


    public function store(Post $post, SaveCommentsRequest $request) {

        if($userRequested = User::whereEmail(auth()->user()->email ?? request('email'))->first()) {
            \Auth::login($userRequested);
            } else {

            $userRequested = new User([
                'firstName' => request('firstName'),
                'email' => request('email'),
                'password' => 'registracnyformularheslo',
            ]);
            $userRequested->save();
            \Auth::login($userRequested);
            }

            $post->addComment([
                'user_id'=> auth()->user()->id ?? $userRequested->id ,
                'body'=> request('body')
            ]);


        flash()->success(trans('web.comments_added'));

        return back();
    }


    public function destroy(Comment $comment) {

        $this->authorize('update', $comment);
        $comment->delete();
        if(request()->expectsJson()) {
            return response(['status' => 'Comment was deleted!']);
        }
        flash()->success(trans('web.comments_deleted'));
        return back();
    }

//    Send report all users each week
    public function reportComments() {

        $posts = Post::reportComments()->get();

        if($posts->count() >= 1) {

//            \Mail::send ('emails.commentRepost',
//                $data = array(
//                    'posts' => $posts,
//                ), function($message) use($data)
//                {
//                    $message->from('admin@cirkevonline.sk', 'Cirkev-Online - Informuje');
//                    $message->to('gajdosgabo@gmail.com')->subject('Týždenný súhrn komentárov');
//                });

        }



        return view('emails.commentRepost')->with('posts',$posts);

    }

}
