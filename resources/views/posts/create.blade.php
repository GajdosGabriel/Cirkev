@extends('layouts.app')


@section('title', $title)


@section('content')

	<section>
		<header class="post-header" style="margin-top: 3rem">
			<h1 class="box-heading">{{ trans('web.post_new') }}<a href="{{url( auth()->user()->id, auth()->user()->slug )}}"><button class="pull-right btn btn-danger btn-sm"> <i class="fa fa-plus" aria-hidden="true"></i> {{ trans('web.post_me') }}</button></a></h1>
		</header>
	{!! Form::open(['url' => ['post', auth()->user()->id ], 'method' => 'post', 'files'=> 'true']) !!}

		@include('posts.form')

	{!! Form::close() !!}
	</section>

@endsection

@section('side')
	<h4>{{ trans('web.post_me') }}</h4>
	@include('user.userArticles')
@endsection








