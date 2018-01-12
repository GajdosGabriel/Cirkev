@extends('layouts.app')


@section('title', $title)


@section('content')

    <h1>{{ trans('web.messenger_send_message') }}</h1>

    @include('partials.contact-form')

@endsection