@extends('layouts.app')


@section('title', $post->title)

@section('style')
    <style>
        form.post input, form.post textarea {
            background: rgba(233, 30, 99, 0.58);
        }
    </style>
@endsection

@section('content')

	<section>
			<header class="post-header">
                <h1 class="bg-danger mt-3">{{ trans('web.post_delete_really') }}</h1>
                <blockquote>
				<h3>
					<a href="{{ url($post->postShow()) }}">
						{{ $post->title }} <small>{{ trans('web.post_read') }} ({{ $post->count_view }})</small></a>
				</h3>
                    {!! $post->teaser !!}
                <p>
                    @can('update', $post)
                    {!! Form::open(['route' => [ 'post.destroy', $post->id ], 'method' => 'DELETE']) !!}
                    {!! Form::submit(trans('web.post_delete'), ['class' =>'btn btn-danger']) !!} or {!! link_back('späť') !!}
                    {!! Form::close() !!}
                    @endcan
                </p>
			</header>
	</section>

@endsection