<div class="bg-dark">
    <nav class=" container navbar navbar-expand-sm bg-dark navbar-dark">

        <!-- Brand -->
        <a class="navbar-brand" href="{{url('/')}}">{{ trans('web.about') }}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul  class="navbar-nav mr-3">
                <li class="nav-item mr-3"><a class="nav-link" title="Zoznam členov" href="{{ url('online') }}">{{ trans('web.online_live') }}</a></li>
                <li class="nav-item  dropdown"><a class="nav-link dropdown-toggle" href="#" id="radio" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ trans('web.radio_stations') }}</a>
                    <div class="dropdown-menu" aria-labelledby="radio">
                        <a class="dropdown-item" href="#"  onClick="window.open('http://www.radio7.sk/onair/popup.php?mp3ID=apmp3id162&style=stylelive&show_current_time_live=1&baseDir=http://www.radio7.sk/&width=300px&height=0&list=0&autoplay=1&muted=0&loop=1&volume=0.75&css=&defaultitem=1&mp3name=%C5%BDIV%C3%89%20VYSIELANIE&mp3link=http://109.71.67.72/128.mp3&artist=','pagename','resizable,height=500,width=470')">{{ trans('web.radio_7') }}</a>
                        <a class="dropdown-item" href="#" onClick="window.open('http://www.lumen.sk/radio-streaming.html?ff=1','pagename','resizable,height=500,width=470')"  >{{ trans('web.radio_lumen') }}</a>
                    </div>
                </li>
            </ul>

            <form class="form-inline input-group-sm d-sm-none d-md-block" action="{{ route('search.index') }}" method="post"> {{ csrf_field() }}
                <input class="form-control mr-sm-2" name="search" type="search" placeholder="Hľadať" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0 btn-sm mr-2" type="submit">{{ trans('web.search') }}</button>
            </form>

            <ul  class="navbar-nav">
                <li class="nav-item mr-3"><a class="nav-link" title="Zoznam členov" href="{{url('user')}}">{{ trans('web.users') }}</a></li>
                <li class="nav-item mr-3"><a class="nav-link" title="Zamyslenie na každý deň" href="{{url('zamyslenia')}}">{{ trans('web.daily_reading') }}</a></li>
                <li class="nav-item mr-3"><a class="nav-link" title="Podujatia" href="{{url('akcia')}}"><span style="background: red; color: whitesmoke; padding: 2px; border-radius: 5px">{{ trans('web.events_all') }}</span></a></li>
            </ul>

            <ul  class="navbar-nav  ml-auto">
                {{--Začiatok Notifikačná lišta--}}
                @if(Auth::check())
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" id="notify" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-bell"></i>
                        @if(auth()->user()->unreadNotifications()->exists())
                            <span class="badge badge-dark">{{ auth()->user()->unreadNotifications()->count() }}</span>
                        @endif
                    </a>

                    <div class="dropdown-menu" aria-labelledby="notify">
                        @forelse(auth()->user()->notifications()->paginate() as $notification)
                            <a onclick="event.preventDefault(); document.getElementById('destroyNotify').submit();" class="dropdown-item" href="{{ url($notification->data['LINK']) }}">
                                @if( $notification->read_at === null )
                                <strong style="color: red"> {{ str_limit($notification->data['TODO'], 35) }}</strong>
                                @else
                                <span style="color: black"> {{ str_limit($notification->data['TODO'], 35) }}</span>
                                @endif
{{--                                <strong> {{ $notification->data['USER'] }}</strong>--}}
                            </a>

                            <form id="destroyNotify" action="{{ route('user.destroyNotifications', [ auth()->user()->id, $notification->id])  }}" method="post">
                            {{ csrf_field() }} {{ method_field('DELETE') }}
                            </form>

                        @empty
                            <a class="dropdown-item" href="#">{{ trans('web.no_record') }}</a>
                        @endforelse
                    </div>
                </li>
                @endif
                {{--Koniec Notifikačnej lišty--}}


                @if(auth()->check())
                <li class="nav-item  dropdown"><a class="nav-link dropdown-toggle" href="{{url('/login')}}" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ $user->fullName }}</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">

                        <a class="dropdown-item" href="{{ route('post.create', [auth()->user()->slug, auth()->user()->id ]) }}">{{ trans('web.add_article') }}</a>
                        <a class="dropdown-item" href="{{ route('user.edit', [auth()->user()->id, auth()->user()->slug])  }}">{{ trans('web.profile') }}</a>
                        {{--<a class="dropdown-item" href="{{ url($user->id, $user->slug)  }}">Správy??</a>--}}
                        <a class="dropdown-item" href="{{ url( auth()->user()->id. '/'. auth()->user()->slug .  '/akcie/admin')}}">{{ trans('web.events_all') }}</a>
                        @can('admin')
                        <div class="dropdown-header">Admin panel</div>
                        <a class="dropdown-item" href="{{url('admin')}}">{{ trans('web.users') }}</a>
                        <a class="dropdown-item" href="{{url('kategorie')}}">{{ trans('web.categories') }}</a>
                        <a class="dropdown-item"  href="{{url('reklama')}}">{{ trans('web.adwertismes') }}</a>
                        <a class="dropdown-item"  href="{{url('trash')}}">Vym.Príspevky</a>
                        <a class="dropdown-item"  href="{{ route('contacts.import', [ auth()->user()->id, auth()->user()->slug]) }}">Kontakty</a>
                        @endcan
                        <div class="dropdown-header">-----------</div>

                        <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        {{ trans('auth.logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                        </form>
                    </div>
                </li>

                @else
                <li class="nav-item"><a class="nav-link" href="{{ url('login') }}">Prihlásenie</a></li>
                <li title="Prihlásenie alebo registrácie cez FB." class="nav-item"><a class="nav-link" href="{{ url('auth/facebook') }}"><i class="fa fa-facebook-square" style="font-size:24px"></i></a></li>
                @endif
            </ul>
        </div>
    </nav>
</div>

