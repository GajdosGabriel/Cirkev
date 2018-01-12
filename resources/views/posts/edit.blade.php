@extends('layouts.app')


@section('title', $title)


@section('content')

	<section class="">
        {!! Form::model($post, ['route'=>['post.update', $post->id], 'method'=>'put', 'files' => 'true' ]) !!}

		@include('posts.form')

		{!! Form::close() !!}
	</section>

@endsection

@section('side')


@endsection

