@extends('layouts.app')


@section('title', $user->fullname)


@section('content-12')
<div class="row">
    <div class="col-md-3">

            @if ($user->avatar)

                {{--/*---------------------- Dajte mu hlas ---------------------------------*/--}}
                <know-him inline-template>

                    <div class="card">
                        <div class="card-header bg-warning"><strong>{{ $user->fullName }}</strong></div>
                        <img class="card-img-top" src="{{ Storage::url('users/' . $user->id . '/' . $user->avatar ) }} ">
                        <div style="margin-top: -38px; z-index: 3; position: relative" class="numberCircle ml-auto " data-toggle="tooltip" title="{{ trans('web.user_count_vote') }}">{{ $user->knowHim }}</div>

                        {{--Kontakt form Start--}}
                        <button style="margin-bottom: 15px" class="btn btn-primary btn-xs pull-right" data-toggle="modal" data-target="#user_sprava" data-whatever="@mdo" >{{ trans('web.messenger_for_author') }}</button>
                        @include('partials.contact-user-modal', ['user' => $user])
                        {{--Kontakt form End--}}


                        <form action="{{route('knowUser', $user->id)}}" method="post">
                            {{ csrf_field() }}

                            <button style="margin-top: 15px; background: #285b51" type="submit" @if (Session::get($user->slug) == $user->slug) disabled="disabled"  @endif  class="btn btn-success btn-block @if (Session::get($user->slug) == $user->slug) disabled  @endif " title="{{ trans('web.user_vote_him') }}">
                                {{ trans('web.user_do_know_him') }} <br> {{ trans('web.user_vote_him') }} !
                                <transition name="slide-fade">
                                    <span style="font-size: 110%; color: red" class="badge">{{ $user->knowHim }}</span>
                                </transition>
                            </button>
                        </form>
                    </div>
                </know-him>
                {{--/*---------------------- END Dajte mu hlas ---------------------------------*/--}}

            @else
                <div class="col-md-6">
                    <p><strong>{{ trans('web.user_profile_picture') }}</strong></p>
                    <img style="height: 120px" src="{{ asset('images/avatar.png') }}">
                    @if(Auth::check())
                        <a href="{{ url($user->id, $user->slug) }}" ><button class="btn-info btn-xs">{{ trans('web.user_change_picture') }}</button></a>
                    @endif
                </div>
            @endif
    </div>

    <div class="col-md-4">

    @if(auth()->check() AND $user->id == auth()->id())
        <div class="card">
            <div class="card-header">
                Prijaté správy
            </div>
            <div class="card-body">
                    @forelse($user->messengers as $messenger)
                        <p><strong class="text-muted">{{ $messenger->user->fullName }}</strong> <br>{{ $messenger->body }} </p>
                        @empty
                        Nemáte žiadne správy
                    @endforelse
            </div>

            <div class="card-footer">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Sem píšte text" aria-label="" aria-describedby="basic-addon1">
                    <div class="input-group-prepend">
                        <button class="btn btn-outline-secondary" type="button">Odoslať</button>
                    </div>
                </div>
            </div>

        </div>
    @endif

        {{--                <h3><a href="{{ URL::current() }}">{{ $user->fullname }}</a></h3>--}}
        <h6>{{ trans('web.user_author_about') }}</h6>
        <p>{!! $user->info_popis !!}  Je členom portála od {{ $user->created_at }}</p>
        <h5><strong>{{ trans('web.user_spirutual_profil') }}</strong></h5>

        @if($user->maria)<span class="label label-default">{{ trans('web.user_profil_maria') }}</span>@endif
        @if($user->diakon)<span class="label label-primary">{{ trans('web.user_diakon_maria') }}</span>@endif
        @if($user->church_employee)<span class="label label-danger">{{ trans('web.user_profil_church_employee') }}</span>@endif
        @if($user->rehola)<span class="label label-danger">{{ trans('web.user_rehola') }}</span>@endif
        @if($user->missioner)<span class="label label-danger">{{ trans('web.user_missioner') }}</span>@endif
        @if($user->christian_abroad)<span class="label label-danger">{{ trans('web.user_profil_christian_abroad') }}</span>@endif
        @if($user->ministrant)<span class="label label-danger">{{ trans('web.user_profil_ministrant') }}</span>@endif
        @if($user->healing)<span class="label label-success">{{ trans('web.user_profil_healing') }}</span>@endif
        @if($user->exorsizmus)<span class="label label-success">{{ trans('web.user_profil_exorsizmus') }}</span>@endif
        @if($user->mariageservice)<span class="label label-success">{{ trans('web.user_profil_mariageservice') }}</span>@endif
        @if($user->homegroupe)<span class="label label-warning">{{ trans('web.user_profil_homegroupe') }}</span>@endif

    </div>

    <div class="col-md-5">
        <h5>Všetky články od <strong> {{ $user->fullName }}</strong></h5>

        @forelse( $user->posts as $post )

            <ul class="list-unstyled">
                <li class="media">
                    <div class="align-self-start mr-3" style="width: 100px" >
                        @include('partials.image_title')
                    </div>
                    <div class="media-body">
                        <h6 class="media-heading"> <a href="{{ url($post->postShow()) }}">{{ $post->title }}</a></h6>
                        <time datetime="{{ $post->datetime }}" style="">
                            <span style="color: rgb(166, 164, 7)">{{ $post->user->fullname }}</span>
                            <span class=""> {{ $post->format_date }} | <i class="fa fa-comment"> ({{ $post->comments->count() }}) </i> |
                                <i class="fa fa-eye"> ({{ $post->count_view }}x) </i>
                                {{--| Kat.({{ $post->group->name }})--}}
                            </span>
                        </time>
                    </div>
                </li>
            </ul>
        @empty
            <p>{{ trans('web.no_items') }}</p>
        @endforelse
    </div>


</div>





{{--    @include('partials.contact-user-modal')--}}

@endsection