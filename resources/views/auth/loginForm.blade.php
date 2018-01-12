
        <div  class="card">
            <div style="background: brown; color: wheat;" class="card-header" style="rgb(44, 62, 80); color: wheat;">{{ trans('auth.prihlasenie') }}</div>

            <div style="background: #cccccc;" class="card-body">
                <!--Facebook-->
                <a href="{{ url('auth/facebook') }}"><button type="button" class="btn btn-sm btn-fb btn-primary mt-2 mb-3"><i class="fa fa-facebook left"></i> Prihlásenie cez Facebook</button></a>

                <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                    {{ csrf_field() }}

                    <div class="form-group row{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">{{ trans('auth.email') }}</label>

                        <div class="col-md-8">
                            <input type="email" class="form-control" placeholder="email" name="email" value="{{ old('email') }}">

                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">{{ trans('auth.password') }}</label>

                        <div class="col-md-8">
                            <input type="password" placeholder="{{ trans('auth.password_holder') }}" class="form-control" name="password">

                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">

                        <div style="display: block" class="checkbox checkbox-default">
                            {!! Form::checkbox('remember', "1", null, ['id' => 'prihlaseny', 'checked']) !!}
                            {!! Form::label('prihlaseny',  trans('auth.zostat_prihlaseny'), []) !!}
                        </div>

                        {{--<div class="checkbox">--}}
                        {{--<label>--}}
                        {{--<input type="checkbox" name="remember" checked>--}}
                        {{--Neodhlasovať sa!--}}
                        {{--</label>--}}
                        {{--</div>--}}

                    </div>

                    <div class=" col-md-6 float-right mr-3">
                        <button type="submit" class="btn btn-primary btn-block btn-lg">
                            {{--<i class="fa fa-btn fa-sign-in"></i>--}}
                            {{ trans('auth.login_btn') }}
                        </button>

                        <a class="btn btn-info btn-block btn-sm" href="{{ url('/password/reset') }}">{{ trans('auth.zabudnute_heslo') }}</a>
                        {{--<a class="btn btn-link" href="{{ url('login/facebook') }}">FB</a>--}}

                        <a class="btn btn-default btn-block btn-sm" href="{{ url('register') }}">{{ trans('auth.novy_ucet') }}</a>
                        {{--<a class="btn btn-link" href="{{ url('login/facebook') }}">FB</a>--}}
                    </div>
                </form>
            </div>
        </div>
    {{--</div>--}}
{{--</div>--}}