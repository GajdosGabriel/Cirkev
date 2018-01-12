@extends('layouts.app')
@section('description', isset($metades) ? strip_tags($metades) : 'Cirkevonline.sk Kresťanský video-portál')
@section('autor', isset ( $post->user->fullname) ?  strip_tags($post->user->fullname) : 'Gabriel Gajdoš' )
@section('title', $post->title)
@section('othermeta')
    <meta property="og:title"         content="{{ $post->title }}" />
    <meta property="og:description"   content="{!! strip_tags( str_limit($post->body, 130)) !!}" />
    <meta property="og:url"           content="{{ url($post->slug) }}" />
    <meta property="og:type"          content="article" />
    <meta property="og:image"         content="{{ Storage::url($post->userPictureUrl() ) }}" />
@endsection

{{--{!! $post->video_link !!}--}}
@if ($post->video_link)
    @section('video-fool')
        <div class="embed-responsive embed-responsive-16by9" style="margin-bottom: 20px">
            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{ $post->video_link }}?rel=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
        </div>
    @endsection
@endif


@section('content')
    <section>
        <article  class="full-post">

            <header class="post-header">
                <h1 class="box-heading">
                    <a href="{{ url($post->postShow()) }}">
                        {{ $post->title }}
                    </a>

                    @can('update', $post)
                    <a href="{{ url($post->postDelete() ) }}" class="btn btn-xs edit-link float-right">&times;</a>
                    <a href="{{ url($post->postEdit() )  }}" class="btn btn-xs edit-link float-right">upraviť</a>
                    @endcan
                </h1>

                <postsubscribe-button :active2="{{ json_encode($post->IsSubscribedTo) }}"></postsubscribe-button>

                <time datetime="{{ $post->datetime }}">
                    <span class="lead">{{ $post->format_date }} | <i class="fa fa-eye"></i> ({{ $post->count_view }}x) - Napísal
                        {{ $post->user->fullname }}</span>
                </time>
            </header>

            <div class="post-content">

                {!! $post->body !!}

                <p class="written-by text-right">
                    <strong>Napísal
                        <a href="{{ route('user.show', [$post->user->id, $post->user->slug]) }}">{{ $post->user->fullname }}</a>
                    </strong>
                </p>

                {{--Facebook share button--}}
                <div
                        class="fb-like"
                        data-share="true"
                        data-width="450"
                        data-show-faces="true">
                </div>

                @if($post->picture)
                    <div class="row">
                        <div class="col-md-5">
                            <a href="#" class="thumbnail" data-toggle="modal" data-target="#lightbox">
                                <img src="{{ Storage::url('posts/' . $post->id . '/' . $post->picture ) }}" alt="{{ $post->title }}" style="width: 100%">
                            </a>
                        </div>
                    </div>
                @endif
            </div>


            @include('partials.tags')

            {{-- List of comments --}}
            <h3>{{ trans('web.comments') }}</h3>

            @forelse($comments = $post->comments()->paginate(10) as $comment)
                @include('comments.comments')
            @empty
                {{ trans('web.comments_add first') }}
            @endforelse



            {{--</reply>--}}
            @include('comments.commentsForm')

            {{--Comments paginate--}}
            <div class="text-center">{{ $comments->links() }}</div>
        </article>
    </section>

@endsection


@section('side')
    {{--<img title="Počet anjelov strážnych" style="height: 50px; position: absolute;top: 0px" src="images/angel.png">--}}

    <div class="card">
        <div class="card-header bg-primary text-center"><a role="button" data-toggle="collapse" aria-expanded="false" aria-controls="collapseExample" class="text-white" href="#{{ $post->user->id }}">{{ $post->user->fullname }}</a>
        </div>
        @if($post->user->avatar)
            <a href="{{ url($post->user->id, $post->user->slug) }}">
                <img class="card-img-top" src="{{ Storage::url($post->userPictureUrl() ) }}"></a>
        @else
            <a class="card-img-top" href="{{ url($post->user->id, $post->user->slug) }}"><img src="{{ asset('images/foto.jpg') }}" style="width: 100%"></a>
        @endif

        {{--Správa autorovi--}}
            <button style="cursor: pointer" class="btn btn-primary btn-xs text-center bg-dark" data-toggle="modal" data-target="#user_sprava">Správa autorovi</button>
        {{--<button class="btn btn-danger"  role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">{{ $post->user->fullname }}</button>--}}

        <div class="collapse" id="{{ $post->user->id }}">
            <div class="well" style="padding-bottom: 33px;">
                {!! htmlspecialchars_decode($post->user->about_user) !!}
            </div>
        </div>
    </div>

    {{-- Function for count knowUser--}}
    <div class="pt-1 pb-3">
        <form action="{{route('knowUser', $post->user->id)}}" method="post">
            {{ csrf_field() }}
            <button type="submit" @if (Session::get($post->user->slug) == $post->user->slug) disabled="disabled"  @endif  class="btn btn-success btn-block @if (Session::get($post->user->slug) == $post->user->slug) disabled  @endif " title="Dajte mu hlas!">Poznám autora osobne? <br> Dajte mu hlas! <span style="font-size: 110%; color: red" class="badge">{{ $post->user->knowHim }}</span></button>
        </form>
    </div>

    @if(!empty($post->picture))
        {{--Modal picture of post --}}
        <div id="lightbox" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <button type="button" class="pull-right" data-dismiss="modal" aria-hidden="true">Zatvoriť X</button>
            <div class="modal-dialog" role="document">
                <div class="modal-body">
                        <img src="{{ Storage::url('posts/' . $post->id . '/' . $post->picture ) }}" alt="" />
                </div>
            </div>
        </div>
    @endif

   @include('partials.contact-user-modal')
   @include('events.eventsModul')


@endsection


@section('faceBookScript')
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                appId      : '1703132446366464',
                xfbml      : true,
                version    : 'v2.10'
            });
            FB.AppEvents.logPageView();
        };

        (function(d, s, id){
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {return;}
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
@endsection