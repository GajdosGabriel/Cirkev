@extends('layouts.app')


@section('title', $title)


@section('video-fool')
        {{--<div class="container">--}}
            <h3 class="mt-3">{{ trans('web.events_user') }}<a href="{{url( auth()->user()->id . '/' .auth()->user()->slug .  '/akcia/vytvorit')}}">
                    <button class="float-right btn btn-danger btn-sm"> <i class="fa fa-plus" aria-hidden="true"></i>
                        {{ trans('web.events_new') }}
                    </button></a>
            </h3>

            <table class="table table-striped">
                <thead>
                <tr class="bg-primary text-white">
                    <td>{{ trans('web.td_thumb') }}</td>
                    <td>{{ trans('web.td_name') }}</td>
                    <td>{{ trans('web.td_day') }}</td>
                    <td>{{ trans('web.td_date') }}</td>
                    <td>{{ trans('web.td_time') }}</td>
                    <td>{{ trans('web.td_city') }}</td>
                    <td>{{ trans('web.td_view') }}</td>
                    <td>{{ trans('web.td_register_users') }}</td>
                    <td>{{ trans('web.td_admin_panel') }}</td>
                </tr>
                </thead>
                <tbody>
                @forelse($events as $event)
                <tr>
                    <td>
                        <a href="{{ route('event.show', [$event->id, $event->slug]) }}">
                            @if(isset($event->picture))
                                <img class="img-fluid img-rounded" src="{{ Storage::url('events/' . $event->id . '/small-' . $event->picture) }}">
                            @else
                                <img class="img-fluid img-rounded" src="{{ url('images/no_image.jpg') }}" title="Bez obrázka">
                            @endif
                        </a>
                    </td>
                    <td><a href="{{ route('event.show', [$event->id, $event->slug]) }}"><strong>{{ $event->title }}</strong></a></td>
                    <td>{{ ucfirst(localized_date('l', $event->dateStart)) }}</td>
                    <td>{{ $event->dateStart->format('d-m-Y') }}</td>
                    <td>{{ $event->timeStart->format('H:i') }}</td>
                    <td>{{ $event->city }}</td>
                    @if(! $event->displayStatus())
                        <td>{{ $event->count_view }} <label class="badge badge-default " title="Podujatie sa skončilo"> {{ trans('web.events_users_finished') }}</label></td>
                        @elseif($event->published)
                            <td title="Kliknutím pozastavíte publikovanie akcie.">{{ $event->count_view }}
                                <label class="badge badge-info"  title="Pozastaviť zobrazovanie?" style="cursor: pointer">{{ trans('web.events_users_is_active') }}</label>
                            </td>
                        @else
                            <td title="Spustíť publikovanie akcie.">{{ $event->count_view }} <label class="badge badge-danger" style="cursor: pointer">{{ trans('web.events_users_no_active') }}</label></td>
                        @endif

                    <td>{{ $event->subscriptions()->count() }}</td>
                    <td>
                        <div style="float: left">
                            <form  method="post" action="{{ route('event.delete', $event->id) }}" >
                            {{ method_field('DELETE') }} {{ csrf_field() }}
                            <button onclick="get_form(this).submit(); return false" title="{{ trans('web.btn_delete') }}" class="btn btn-default btn-sm btn-block" type="button">X</button>
                            </form>
                        </div>
                        <a href="{{ route('event.edit', [$event->id, $event->slug]) }}"><button title="{{ trans('web.btn_edit') }}" class="btn btn-info btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>
                        <a href="{{ route('event.copy', [$event->id, $event->slug]) }}"><button title="{{ trans('web.btn_copy') }}" class="btn btn-outline-primary btn-sm"><i class="fa fa-files-o" aria-hidden="true"></i></button></a>
                    </td>
                </tr>
                {{--List of registred Usesr--}}
                <tr style="background: #d5d5d5">
                    <td colspan="6">
                        <h4>
                            @if($event->registration == 'no')
                                {{ trans('web.events_registration_no_need') }}
                            @else
                            {{ trans('web.events_users_subcribe') }}
                                <strong>({{ $event->SubscribedToEvent->count() }})</strong>
                            @endif
                        </h4>
                        @if(isset($event->subscriptions))
                            @forelse($event->SubscribedToEvent as $prihlaseny)
                                <strong> {{ $prihlaseny->user->fullName }}</strong>,
                                @if( $prihlaseny->record)
                                    <label class="badge badge-success">Paid</label>
                                @else
                                    <label class="badge badge-danger">NoPaid</label>
                                @endif
                            @empty
                            @endforelse
                        @endif
                    </td>
                    <td colspan="6">
                        <h4>
                            @if($event->registration == 'no')
                                {{ trans('web.events_registration_no_need') }}
                            @else
                            Žiadoť o nahrávku
                                <strong>({{ $event->SubscribedForRecord->count() }})</strong>
                            @endif
                        </h4>
                        @if(isset($event->subscriptions))
                            @forelse($event->SubscribedForRecord as $prihlaseny)
                                <strong> {{ $prihlaseny->user->fullName }}</strong>,
                                @if( $prihlaseny->record)
                                    <label class="badge badge-success">Ano Record</label>
                                @else
                                    <label class="badge badge-danger">Nie Record</label>
                                @endif
                            @empty
                            @endforelse
                        @endif
                    </td>
                </tr>
{{--List of registred Usesr--}}

                @empty
                <table class="table">
                    <p>{{ trans('web.events_empty') }}</p>
                        </table>
                        @endforelse
                        </tbody>
                </table>
        {{--</div>--}}
@endsection


@section('script')
    <script>
        function get_form( element )
        {

            var r = confirm("Vymazať podujatie?");

            while( element )
            {
                element = element.parentNode;

                if( element.tagName.toLowerCase() == "form" )
                {

                    if (r == true) {
                        return element
                    } else {
                        return 0;
                    }
                    return element;
                }
            }
//        return 0; //error: no form found in ancestors
        }
    </script>


@endsection