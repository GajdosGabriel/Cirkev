@extends('layouts.app')


@section('title',  $event->title)
@section('othermeta')
    <meta property="og:title"         content="{{ $event->title }}" />
    <meta property="og:description"   content="{!!  strip_tags( str_limit( $event->body, 150)) !!}" />
    <meta property="og:url"           content="{{ url($event->slug) }}" />
    <meta property="og:type"          content="article" />
    <meta property="og:image"         content="{{ Storage::url('events/' . $event->id . '/' . $event->picture) }}" />
@endsection

@section('content-8')

    <h1 class="mt-4 text-primary">{{ $event->title }}
        @can('update', $event)
        <a href="{{ route('event.edit', [$event->id, $event->slug]) }}" class="btn btn-default btn-sm  float-right">{{ trans('web.btn_edit') }}</a>
        @endcan
    </h1>

    <div style="background: #e0e0e0; padding: 15px; margin-top: 20px">
        <strong style="margin-top: -32px;font-size: 200%; background: white; border-radius: 22px; padding: 8px;" class="pull-right">{{ ucfirst( localized_date('l', $event->dateStart)) }} {{ localized_date('H.i', $event->dateStart)  }} hod.</strong>
    <h3> <strong>{{ trans('web.events_city') }}</strong>  <span  style="font-size: 80%">{{ $event->city }}, {{ $event->street }}</span><br>Dňa {{ $event->dateStart->format('d-m-Y') }}
        , o {{ $event->timeStart->format('H.i') }} hod.</h3>

    </div>

        <p>{!! $event->rich_text !!}</p>

    <img class="img-thumbnail" alt="{{ $event->title }}" src="{{ Storage::url('events/' . $event->id . '/' . $event->picture) }}">


    {{--Facebook share button--}}
    <div style="margin: 19px 0px;padding: 10px;background: #f50b40;color: white;">
        <div
                class="fb-like"
                data-share="true"
                data-width="450"
                data-show-faces="true">
        </div>
        </br><strong>{{ trans('web.events_fb') }}</strong> <br>
    </div>

    @if(isset($event->appendFile))
    <strong>Príloha: </strong> <a target="_blank" href="{{ Storage::url($event->appendFile) }}"><i class="fa fa-file-o" aria-hidden="true"></i> Príloha na stiahnutie</a>
    @endif


    <h4>{{ trans('web.events_time_to_start') }} {{ $event->dateStart->diffForHumans() }}.</h4>

    @if( isset($event->clientwww))
        <p><a target="_blank" href="{{ $event->clientwww }}">{{ trans('web.btn_link_to_web') }}</a></p>
    @endif

    <form action="{{ route('event.subscriptions', $event->id) }}" method="post">
        {{ csrf_field() }}
        @if($event->wants_record)
           <p class="text-center"><button type="submit" name="record" value="0">Požiadali ste o nahrávku <i class="fa fa-volume-up" aria-hidden="true"></i></button></p>
       @else
            @if(auth()->guest())
                <p class="text-center"><a type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-default" >{{ trans('web.events_record_wants') }} <i class="fa fa-volume-up" aria-hidden="true"></i></a></p>
            @else
                <p class="text-center"><button type="submit" name="record" value="1" >{{ trans('web.events_record_wants') }} <i class="fa fa-volume-up" aria-hidden="true"></i></button></p>
            @endif
       @endif
    </form>

    {{--<h4>Registračný formulár</h4>--}}
    <form action="{{ route('event.subscriptions', $event->id) }}" method="post">
        {{ csrf_field() }}
        @if($event->registration == 'recomended' && $event->IsSubscribedTo)
            <p class="text-muted mb-2">{{ trans('web.events_rezervation_recomended') }}</p>
            <button type="submit" name="registration" value="0" class="btn btn-primary btn-sm">{{ trans('web.events_rezervation_already') }}</button>
            {{--<a href=""><small class="text-muted mx-2">{{ trans('web.btn_unregister') }}</small></a>--}}
        @elseif($event->registration == 'recomended')
            <p class="text-muted mb-2">{{ trans('web.events_rezervation_recomended') }}</p>
            @if(auth()->check())
                <button type="submit" name="registration" value="1" class="btn btn-primary btn-sm">{{ trans('web.events_rezervation') }}</button>
            @else
                <a type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary btn-sm">{{ trans('web.events_rezervation') }}</a>
            @endif
        @elseif($event->registration == 'yes' && $event->IsSubscribedTo)
            <p class="text-muted mb-2">{{ trans('web.events_rezervation_need') }}</p>
            <button type="submit" name="registration" value="0" class="btn btn-primary btn-sm">{{ trans('web.events_rezervation_already') }}</button>
            {{--<a href=""><small class="text-muted mx-2">{{ trans('web.btn_unregister') }}</small></a>--}}
        @elseif($event->registration == 'yes')
            <p class="text-muted mb-2">{{ trans('web.events_rezervation_need') }}</p>
            @if(auth()->check())
                <button type="submit" name="registration" value="1" class="btn btn-primary btn-sm">{{ trans('web.events_rezervation') }}</button>
            @else
              <a data-toggle="modal" data-target="#exampleModal" class="btn btn-primary btn-sm">{{ trans('web.events_rezervation') }}</a>
            @endif
        @endif
    </form>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Najprv sa Prihláste alebo Registrujte</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('auth.loginForm')
                </div>
            </div>
        </div>
    </div>
    {{--<h4>Registračný formulár</h4>--}}
        {{--@if($event->registration == 'recomended' && $event->IsSubscribedTo)--}}
            {{--<p class="text-muted mb-2">{{ trans('web.events_rezervation_recomended') }}</p>--}}
            {{--<span class="btn btn-primary btn-sm">{{ trans('web.events_rezervation_already') }}</span>--}}
            {{--<a href=""><small class="text-muted mx-2">{{ trans('web.btn_unregister') }}</small></a>--}}
        {{--@elseif($event->registration == 'recomended')--}}
            {{--<p class="text-muted mb-2">{{ trans('web.events_rezervation_recomended') }}</p>--}}
            {{--<a href="{{ route('event.subscriptions', $event->slug) }}" class="btn btn-primary btn-sm">{{ trans('web.events_rezervation') }}</a>--}}
        {{--@elseif($event->registration == 'yes' && $event->IsSubscribedTo)--}}
            {{--<p class="text-muted mb-2">{{ trans('web.events_rezervation_need') }}</p>--}}
            {{--<span class="btn btn-primary btn-sm">{{ trans('web.events_rezervation_already') }}</span>--}}
            {{--<a href=""><small class="text-muted mx-2">{{ trans('web.btn_unregister') }}</small></a>--}}
        {{--@elseif($event->registration == 'yes')--}}
            {{--<p class="text-muted mb-2">{{ trans('web.events_rezervation_need') }}</p>--}}
            {{--<a href="{{ route('event.subscriptions', $event->slug) }}" class="btn btn-primary btn-sm">{{ trans('web.events_rezervation') }}</a>--}}
        {{--@endif--}}

@endsection


@section('side-4')

    <div class="card my-4">
        @if(!empty($event->picture))
            <img class="card-img-top img-fluid" src="{{ Storage::url('events/' . $event->id . '/' . $event->picture) }}">
         @else
            <img class="card-img-top img-fluid" src="{{ Storage::url('users/' . $event->user->id . '/' . $event->user->avatar) }}">
        @endif
    </div>


    <div class="card border-primary">
            <div class="card-header">{{ trans('web.events_info_panel') }}</div>
        <div class="card-body">
            <p>Organizuje: <strong class="float-right"> {{ $event->organizator }}</strong></p>
            <p>{{ trans('web.events_add_event') }} <strong class="float-right"><a href="{{ route('user.show', [$event->user->id, $event->user->slug]) }}"> {{ $event->user->fullName }}</a></strong></p>

            @if(isset($event->user->phone))
            <p>Tel.: <strong class="float-right">{{ $event->user->phone  }}</strong></p>
            @endif
            <p>Registrácia:
            @if($event->registration == 'yes')
            <strong class="float-right">Áno</strong>
            @else
            <strong class="float-right">Nie</strong>
            @endif </p>


            @if($event->entryFee == 'voluntarily')
            <p>Vstupné: <strong class="float-right">Dobrovoľné</strong></p>
            @endif
            @if($event->entryFee == 'no')
            <p>Vstupné: <strong class="float-right">Nie</strong></p>
            @endif
            @if($event->entryFee == 'yes')
            <p>Vstupné: <strong class="float-right">Áno</strong></p>
            @endif
            <p>Tel.: <strong class="float-right">{{ $event->user->phone ? : 'Neuvedený' }}</strong></p>
        </div>
    </div>

    <button class="btn btn-primary btn-xs float-right mt-3" data-toggle="modal" data-target="#user_sprava" data-whatever="@mdo" > Správa autorovi <i class="fa fa-envelope-o" aria-hidden="true"></i></button>
    @include( 'partials.contact-user-modal', ['post' => $event] )


@endsection




@section('faceBookScript')
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                appId      : '1703132446366464',
                xfbml      : true,
                version    : 'v2.10'
            });
            FB.AppEvents.logPageView();
        };

        (function(d, s, id){
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {return;}
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
@endsection

