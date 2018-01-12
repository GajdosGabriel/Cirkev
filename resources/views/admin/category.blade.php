@extends('layouts.app')


@section('title', isset($title) ? strip_tags($title) : 'All posts')


@section('content')
    @include('flash::message')
	<section class="post-list">

		<h1 class="box-heading text-muted">
			{!! $title or "this is a blog, bitch" !!}
		</h1>




    </section>


@endsection


@section('side')
    <div class="col-sm-12">
        <div class="panel panel-danger">
            <div class="panel-heading">Názvy kategórií</div>
            {!! Form::open(['url' => 'kategorie', 'method' => 'post', 'class' => 'post', 'id' => 'add-form']) !!}
            <div class="panel-footer">
                <div class="input-group">
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'nová kategória']) !!}
                    <span class="input-group-btn">
                        <button class="btn btn-primary btn-sm">Pridať</button>
                        </span>
                    {{ Form::close() }}
                </div>
            </div>
            <div class="panel-body">

                @forelse( $groups as $group )
                    <p><a href="{{ url('kategorie' ,$group->id) }}"> {{ $group->name }} - ({{ $group->id }})</a></p>
                @empty
                    Žiadna kategória.
                @endforelse
            </div>
        </div>
    </div>
    {{--@include('modul.statistika')--}}
    {{--@include('modul.latestcom')--}}
    {{--@include('modul.category')--}}



@endsection

