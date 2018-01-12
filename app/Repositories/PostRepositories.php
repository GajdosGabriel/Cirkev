<?php

namespace App\Repositories;

use App\Post;
use App\Events\PostVisitedNotification;


class PostRepositories
{

    protected $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }


    public function getPost($id)
    {
       $post = $this->post->where('id', $id)->firstOrFail();
        \Event::fire(new PostVisitedNotification($post));

        return $post;
    }

    public function getAll()
    {
       return $this->post->with('user')->latest()->paginate(18);
    }




    public function storePost($input)
    {
        $post = $this->savePost($input);
        flash()->success(trans('web.post_saved'));
        $this->checkIsLocked($post);
        return $post;
    }

    protected function getModel()
    {
         return ($this->isAdmin()) ? $this->post : auth()->user()->posts();
    }

    protected function savePost($input)
    {
        return $this->getModel()->create($input);
    }

    protected function checkIsLocked($post)
    {
        if ($this->isVerified()) {
            $post->update(['published' => 0]);
            flash()->error('Článok bol uložený, ale sa zobrazí až po overení účtu!');
        }
    }

    public function isAdmin()
    {
        return auth()->user()->isAdmin();
    }

    public function isVerified()
    {
        return ! auth()->user()->verified;
    }



//    public function savePost($postData)
//    {
//        $post = $this->savePostByUser();
//        $this->savePostLockedUser($post);
//        return $post;
//    }

//    protected function savePostByUser()
//    {
//        if( auth()->user()->isAdmin()) {
//            $post = $this->post->create(request()->all());
//        } else {
//           $post = auth()->user()->posts()->create(request()->all());
//        }
//
//        flash()->success( trans('web.post_saved'));
//
//        return $post;
//    }
//
//    protected function savePostLockedUser($post)
//    {
//        if( $post->user->locked )
//        {
//        $post->update(['published' => 0]);
//        flash()->error( 'Článok bol uložený, ale sa zobrazí až po overení účtu!');
//        }
//    }



}