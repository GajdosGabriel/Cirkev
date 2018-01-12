@extends('layouts.app')
@section('description', isset($metades) ? strip_tags($metades) : 'Cirkevonline.sk Kresťanský video-portál')
@section('autor', isset ( $post->user->fullname) ?  strip_tags($post->user->fullname) : 'Gabriel Gajdoš' )
@section('title', $post->title)


@section('content')
<span class="lead"> {{ trans('web.daily_reading_today') }} {{ $date }}</span>
<section class="dayli_reading">

	<div class="row">
			<div class="col-md-8 mt-4">

				<header class="post-header">
					<h1 class="box-heading ">{{ $post->title }}</h1>
				</header>

               <div style="font-size: 120%"> {!! $post->zamyslenie !!}
				<p class="text-muted" >{{ $post->autor }}</p>
			   </div>
				<div class="clearfix mb-5 mt-5">
						@if($previous)
						<a  class="badge badge-primary float-left p-2" href="{{ URL::to( 'zamyslenia/' . $previous ) }}"><< {{ trans('web.daily_yesterday') }}</a>
						@endif

						@if($next)
						<a  class="badge badge-primary float-right p-2" href="{{ URL::to( 'zamyslenia/' . $next ) }}">{{ trans('web.daily_tomorow') }} >></a>
						@endif
				</div>
			</div>

			<div class="col-sm-4 mt-4">
				<div class="card border-primary">
					<div class="card-header lead text-primary font-weight-bold">{{ trans('web.daily_reading_NT') }}</div>

					<div class="card-body">
						<blockquote class="blockquote">
							{{ $post->biblicky_vers }}
							<footer class="blockquote-footer">{{ $post->biblicky_vers_ref }}</footer>
						</blockquote>
					</div>
				</div>

				<div class="card border-danger mt-3">
					<div class="card-header lead text-danger font-weight-bold ">{{ trans('web.daily_reading_OT') }}</div>

					<div class="card-body">
						{{ $post->szvers_text }}

						<blockquote class="blockquote">
							<footer class="blockquote-footer">{{ $post->szvers_ref }}</footer>
						</blockquote>
					</div>
				</div>


			</div>
	</div>
</section>

@endsection


@section('side')
		<div class="col-md-3 hidden-xs img-fluid"><img src="{{ asset('images/biblia1.jpg' ) }}"></div>

@endsection