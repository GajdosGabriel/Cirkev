<?php

namespace App\Http\Controllers;

use App\Filters\PostFilters;
use App\Http\Requests\SavePostRequest;
use App\Post;
use App\Repositories\Posts;
use app\Services\FileService;
use App\Services\UploadFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Repositories\PostRepositories;


class PostsController extends Controller
{

    protected $postRepositories;

    public function __construct(PostRepositories $postRepositories)
    {
        $this->postRepositories = $postRepositories;
        $this->middleware('auth')->except(['index', 'show']);
    }



    public function index (PostFilters $filters)
    {
//        $posts = $this->postRepositories->getAll();

        $posts = Post::filter($filters)->with('user')->latest()->paginate(18);

        return view('posts.index')
            ->with('title', trans('web.post_news'))
            ->with('posts', $posts);
    }


    public function show ($post, $slug)
    {
        return view('posts.show')->with('post', $this->postRepositories->getPost($post));
    }



    public function edit ($post)
    {
        $post = $this->postRepositories->getPost($post);
        $this->authorize('update', $post);
        return view('posts.edit')
            ->with('post', $post)
            ->with('title', trans('web.post_edit'));
    }


    public function create()
    {
        return view('posts.create')
                ->with('title', trans('web.post_new'))->with('user', auth()->user()->posts->take(10));
    }



    public function store(SavePostRequest $request, UploadFile $uploadFile)
    {
        $post = $this->postRepositories->storePost($request->all());

        $post->subscribe(); // Add user to list of comments notifications

        // Marek class
        //$fileService = new \App\Services\FileService();
        //$fileService->storeFile(request('picture'), $post);
        //$fileService->storeFile(request('subor'), $post, false);


        $uploadFile->saveFile(request('picture'), $post);
        $uploadFile->getVideoPicture(request('video_link'), $post);

        $this->syncTags($post, $request->get('tags'));  // attach tags


        return redirect( route('post.show', [$post->id, $post->slug]));
    }





    public function update(SavePostRequest $request, Post $post, UploadFile $uploadFile)
    {
        $this->authorize('update', $post);

        $post->postUpdate($request->all() );

        $post->tags()->sync($request->get('tags')?:[] );

        $uploadFile->saveFile(request('picture'), $post);
        $uploadFile->getVideoPicture(request('video_link'), $post);

        // attach tags
        $this->syncTags($post, $request->get('tags'));
        flash()->success(trans('web.post_updated'));
        return redirect('/')->with('title', trans('web.post_updated'));

    }


    public function delete($post, $slug)
    {
        return view('posts.delete')
            ->with('post', $this->postRepositories->getPost($post))
            ->with('title', trans('web.post_delete'));
    }


    public function destroy ($post)
    {
        $post = $this->postRepositories->getPost($post);
        $this->authorize('update', $post);

        $post->comments->each(function($comment){
            $comment->delete();
        });

        $post->delete();

        flash()->success(trans('web.post_deleted'));
        return redirect('/');
    }


    public function trash()
    {
        $trashed_posts = Post::onlyTrashed()->get();

        return view('posts.trash')->with('trashed_posts', $trashed_posts);
    }

    public function restore($id)
    {
        $post = Post::withTrashed()->findOrFail($id);

        $comments = \App\Comment::withTrashed()->wherePostId($post->id)->get();

        $post->restore();

        $comments->each(function($comment) {
           $comment->restore();
        });

        return redirect('/');
    }

    public function forceDelete($id)
    {
        $post = Post::onlyTrashed()->whereId($id)->firstOrFail();
        $post->forceDelete();

        //Vymazať adresar so súborom
        if(is_dir(storage_path('app/public/posts/' . $post->id))) {
            rmDirectory(storage_path('app/public/posts/' . $post->id));
        }

        return redirect('/trash');
    }



    private function syncTags($post, $tags)
    {
        $post->tags()->sync($tags ?: []);
    }


}
