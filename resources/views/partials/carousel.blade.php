@if(Request::is('/'))
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @foreach($users as $user)
                        <a href="{{ route( 'user.show', [$user->id, $user->slug] ) }}">
                            <div style="float: left; width: 95px;" >
                                <span style="position: absolute; padding:2px 7px; background: #d40000; color: white; font-size: 12px;
                                margin-bottom: -25px; border-radius: 50%" title="{{ trans('web.user_count_vote') }}"><strong>{{ $user->knowHim  }}</strong></span>
                                <img  data-toggle="tooltip" data-placement="bottom" title="{{$user->firstName}} {{$user->lastName}}" style="max-height: 100px" src="{{ Storage::url('users/' . $user->id . '/small-' . $user->avatar ) }}" alt="autor {{ $user->firstName }}">
                            </div>
                        </a>
                    @endforeach
                    @if(auth()->guest())
                        <a href="{{ url('register') }}">
                            <img class="hidden-xs" style="max-height: 100px" src="{{ asset('images/pridajtesa.jpg' ) }}" alt="...">
                        </a>
                    @endif
                </div>
            </div>
        </div>
@endif
