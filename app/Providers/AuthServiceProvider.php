<?php

namespace App\Providers;

use App\Comment;
use App\Event;
use App\Policies\CommentsPolicy;
use App\Policies\EventPolicy;
use App\Policies\PostPolicy;
use App\Post;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Post::class => PostPolicy::class,
        Event::class => EventPolicy::class,
        Comment::class => CommentsPolicy::class,
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

// ----------------- Nová verzia neodskúšaná ---------------------------
        \Gate::before( function ($user)
        {
        if( $user->isAdmin() ) return true;
        });
    }
}
