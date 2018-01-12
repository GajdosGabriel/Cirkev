@extends('layouts.app')


@section('title', isset($title) ? strip_tags($title) : 'All posts')


@section('content')
	<section class="post-list">
		<h1 class="box-heading text-muted">
			{!! $title or "Používatelia" !!}
		</h1>
{{--Email list--}}
        <table class="table table-hover table-bordered">
            <thead class="thead-primary">
            <tr>
                <th>id</th>
                <th><a href="{{asset('admin/')}}/?firstName=asc">Meno</a></th>
                <th>{{ trans('web.user_email') }}</th>
                <th>{{ trans('web.td_date') }}</th>
                <th>Odber</th>
                <th>Titulka</th>
                <th>Blokovať</th>
                <th>Akcia</th>
            </tr>
            </thead>
        </table>
                @forelse( $users as $user )
            {!! Form::model($user, ['route' => [ 'adminUpdateUser', $user->id ], 'method' => 'patch', 'class' => 'post']) !!}
        <table class="table table-hover table-bordered">
            <tbody>
                    <tr class="{{  $user->locked ? 'bg-danger' : ''}}">
                        <td>{{ $user->id }}</td>
                        <td ><a href="{{ url($user->id, $user->slug) }}">{{ $user->Fullname }}</a></td>
                        <td > {!! Form::email('email') !!}</td>
                        <td >{{ $user->created_at }}</td>
                        <td >
                            {!! Form::checkbox('send_email', "1", null, ['id' => 'send_email']) !!}
                            {!! Form::label('send_email', 'Emailom', []) !!}
                        </td>
                        <td class="col-md-1">
                            {!! Form::checkbox('frontAuthor', "1", null, ['id' => 'frontAuthor']) !!}
                        </td>

                        <td class="col-md-1">
                            {!! Form::checkbox('locked', "1", null, ['id' => 'locked']) !!}
                        </td>
                        <td class="col-md-1"><button type="submit">Uložiť</button></td>
                    </tr>
            </tbody>
        </table>
            {!! Form::close() !!}
        @empty
            {{ trans('web.user_no') }}
        @endforelse

    </section>


@endsection


@section('side')

    {{--@include('modul.statistika')--}}
    {{--@include('modul.latestcom')--}}
    {{--@include('modul.category')--}}



@endsection

