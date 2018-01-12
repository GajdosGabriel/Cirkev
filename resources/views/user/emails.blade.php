@extends('layouts.app')


@section('title', $user->fullname)


@section('content')
<div class="row">

    <div class="col-md-4">
        <h3>Import emailov</h3>
        <form action="{{ route('user.save.emails', $user->id) }}" method="post" class="form-control"> {{ csrf_field() }}
        <div class="form-group">
        <textarea name="body" placeholder="Vložte text v ktorom chcete nájť emaily na import" class="form-control" required></textarea>
        </div>
        <div class="form-group">
        <button class="btn btn-default btn-block btn-sm">Uložiť emaily</button>
        </div>
        </form>
    </div>

    <div class="col-lg-8">
        <h3>Vaše kontakty <span class="text-muted">({{ $user->contacts()->count() }})</span></h3>
        <ol>
            @forelse($user->contacts as $friend)
                <li><span class="text-capitalize">{{ $friend->name }}</span> <span class="text-muted">{{ $friend->email }}</span></li>
                @empty
                    <p>Žiadne kontakty</p>
            @endforelse
        </ol>

</div>
@endsection