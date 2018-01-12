@extends('layouts.app')

@section('autor', isset ( $post->user->firstName) ?  strip_tags($post->user->fullname) : 'Gabriel Gajdoš' )

@section('title', isset($title) ? strip_tags($title) : 'Najnovšie príspevky')

@section('othermeta')
    <meta property="og:title"         content="CirkevOnline.sk" />
    <meta property="og:description"   content="Kresťanský portál, správy, video a podujatia." />
    <meta property="og:url"           content="{{ url('/') }}" />
    <meta property="og:type"          content="article" />
    <meta property="og:image"         content="{{ url('images/cirkevFace.png') }}" />
@endsection



@section('banner_hore') @include('partials.carousel') @endsection




@section('content')
    @include('modul.googlemap')

    <div>@include('modul.spravy')</div>


    <section class="post-list">
        <h1 class="box-heading text-muted my-4">
            {!! $title or "Blog Cirkev Online.sk" !!}
        </h1>

        {{--@forelse( $posts->chunk(3) as $row )--}}
            <div class="row">
                {{--@foreach($row as $post)--}}
                    @foreach($posts as $post)
                    <div class="col-md-4 col-sm-6" style="margin-bottom: 20px;" >

                        <div class="card">

                            <div class="card-img-top" style="box-shadow: 7px 7px 5px #888888;overflow: hidden; max-height: 145px;"> @include('partials.image_title')</div>
                            <div style="padding: 1rem .5rem">
                                <h6 > @if($post->video_link) <img src="{{ url('images/play_icon.png') }}"> @endif <a href="{{ url($post->postShow()) }}">
                                        <strong>{{ $post->title }}</strong></a>
                                    {{--Count how article/min is long --}}
                                    @if(empty($post->video_link))
                                        <span class=" float-right">{{ round(str_word_count($post->body) /110) }} min.</span>
                                    @endif
                                </h6>

                                <time datetime="{{ $post->datetime }}" style=""></time>
                                <a href="{{ asset('/?by='. $post->user->id . '/'. $post->user->slug) }}">
                                    <span class="author">{{ $post->user->fullname }}</span>
                                </a>
                                <span class="text-muted"> {{ $post->format_date }} |
                                    <i class="fa fa-eye"> ({{ $post->count_view }}x) </i>
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        {{--@empty--}}
            {{--<p>{{ trans('web.post_empty') }}</p>--}}
        {{--@endforelse--}}

    </section>

    <div> {!! $posts->links() !!}</div>

    {{--Reklama spodná časť--}}
    @include('modul.ads', [ 'webposition' => 'PostDown' ] )

@endsection


@section('side')
    @include('modul.category')
    @include('modul.verse')
    @include('modul.latestcom')
{{--    @include('modul.latestusers')--}}
    @include('modul.statistika')
    @include('modul.ads', ['webposition' => 'Side'])
    {{--@include('modul.tags')--}}




@endsection

