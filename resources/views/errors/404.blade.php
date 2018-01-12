@extends('layouts.app')

@section('content')

    <h1>Stránka sa nenašla!</h1>
    <p>Chyba 404</p>
<a href="{{ URL::previous() }}"><button style="margin-bottom: 20px" class="btn btn-info">Vrátiť sa Späť</button></a>
@endsection