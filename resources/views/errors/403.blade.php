@extends('layouts.app')

@section('content')

    <h2>Na úkon nie ste autorizovaný</h2>
    <p>Chyba 403 {{ $exception->getMessage() }} </p>

    @endsection