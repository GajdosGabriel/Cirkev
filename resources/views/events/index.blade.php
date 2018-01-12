@extends('layouts.app')


@section('title', trans('web.events_actual_list'))



@section('content')

    <h1 class="my-4">{{ trans('web.events_actual_list') }}</h1>

    @forelse($events as $event)
<div class="mb-5">
        <div class="clearfix" style="border-bottom: 2px solid #5c5c5c">
            <strong style="font-size: 150%" class="d-inline float-left">{{ localized_date('d.m.Y', $event->dateStart) }}</strong>
            <strong style="font-size: 150%" class="d-inline float-right">{{  localized_date('l', $event->dateStart) }}</strong><br>
        </div>

        <div class="d-flex flex-row">
            <div class="col-md-3 row"> <a href="{{ route('event.show', [$event->id, $event->slug]) }}">
                    @if(isset($event->picture))
                        <img  class="img-thumbnail" style="width: 200px" src="{{ Storage::url('events/' . $event->id . '/small-' . $event->picture) }}" alt="...">
                    @else
                        <img  class="img-thumbnail" src="{{ url('images/no_image.jpg') }}" alt="...">
                    @endif
                </a>
            </div>
            <div class="d-flex flex-column col-md-7">
                <div class="">
                    <a href="{{ route('event.show', [$event->id, $event->slug]) }}">
                        <h4 class=""><strong>{{ $event->title }}</strong></h4>
                    </a>
                </div>
                <span class="text-muted">
                {{ html_entity_decode( strip_tags( str_limit( $event->body,200 ))) }}
                </span>


                <div id="casomiera" class="mt-auto">
                    <div class="">začiatok {{ $event->dateStart->diffForHumans() }}</div>
                    @can('update', $event)
                    <i title="Počet zobrazení"  class="fa fa-eye"> {{ $event->count_view }} </i>
                    @endcan
                </div>
            </div>
            <div class="ml-auto">
                <div class="text-right">
                    {{--                <strong class="pull-right">{{ localized_date('l', $event->dateStart) }}</strong><br>--}}
                    <strong class="">{{ $event->city }} </strong><br>
                    <span class="">{{ $event->dateStart->diffForHumans() }}</span><br>
                    <strong class="">Kraj: {{ $event->region }} </strong><br>
                </div>
            </div>
        </div>
</div>
        @empty
            <p>{{ trans('web.events_empty') }}</p>
    @endforelse

    @endsection

@section('side')
    @if(auth()->check())
        <a href="{{ url( auth()->user()->id . '/' .auth()->user()->slug .  '/akcia/vytvorit') }}"><button class="mt-3 btn btn-primary btn-block" title="Prihláste sa alebo registrújte!">{{ trans('web.events_new_add') }}</button></a>
    @else
        <a href="{{ url('login') }}"><button class="mt-3 btn btn-primary btn-block" title="Prihláste sa alebo registrújte!">{{ trans('web.events_new_add') }}</button></a>
    @endif

@endsection



