@extends('layouts.app')


@section('title', isset($title) ? strip_tags($title) :  trans('web.user_all') )


@section('content')
    @include('flash::message')
<section class="post-list">
        <h1 class="box-heading text-muted">
            {{ $title }}
        </h1>

    <div class="row">
    @forelse( $users as $user )
        <div class="col-md-6">
                <div class="media" style="border: 2px solid; margin: 8px 0px;">
                    <a href="{{ route( 'user.show', [$user->id, $user->slug] ) }}"><img class="mr-3" style="width: 100px"
                    @if(!empty($user->avatar))
                    src="{{ Storage::url($user->userSmallPictureUrl()) }}">
                    @else
                    src="{{ asset('images/avatar.png') }}" style="">
                    @endif
                    </a>

                    <div class="media-body">
                        <h4><a href="{{ route( 'user.show', [$user->id, $user->slug] ) }}">
                            {{ $user->fullname }}</a>
                        </h4>

                        <p>
                            <i class="fa fa-user-plus"> od {{ $user->created_at }}</i> | <i class="fa fa-comment"> {{ trans('web.comments_more') }}</i> | <i class="fa fa-folder">
                                {{ $user->posts->count() }}
                            </i>
                            | <a href="{{ route( 'user.show', [$user->id, $user->slug] ) }}" class="text-warning ">
                                Detaily...</a>
                        </p>

                    </div>
                </div>
        </div>
    @empty

        <p>{{ trans('web.no_items') }}</p>

    @endforelse
</div>
</section>

@endsection


@section('side')
    @include('modul.latestusers')

@endsection

