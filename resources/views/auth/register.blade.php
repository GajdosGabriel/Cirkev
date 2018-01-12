@extends('layouts.app')

    @section('headerScript')
        <script src='https://www.google.com/recaptcha/api.js'></script>
    @endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div style="background: brown; color: wheat;" class="card-header">Registrácia - Vytvorenie nového profilu! </div>
                <div style="background: rgba(153, 126, 51, 0.92)" class="card-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {!! csrf_field() !!}

                        <div class="form-group row{{ $errors->has('firstName') ? ' has-error' : '' }}">
                            <label class="col-sm-3 col-form-label">{{ trans('auth.name') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" required placeholder="Ján, Eva, ... " name="firstName" value="{{ old('firstName') }}">

                                @if ($errors->has('firstName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('firstName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row{{ $errors->has('lastName') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">{{ trans('auth.last_name') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" required placeholder="Novotný, Majkovský, ... " name="lastName" value="{{ old('lastName') }}">

                                @if ($errors->has('lastName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lastName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">{{ trans('auth.email') }}</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" placeholder="{{ trans('auth.email_yours') }}" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">{{ trans('auth.password') }}</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password" placeholder="{{ trans('auth.password_info') }}">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">{{ trans('auth.password_repete') }}</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password_confirmation" placeholder="{{ trans('auth.password_repete') }}">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                            {!! app('captcha')->display() !!}
                            </div>
                        </div>

                    @if ($errors->has('g-recaptcha-response') )
                            <span class="help-block">
                        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                    </span>
                        @endif


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button style="margin-bottom: 15px;" type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i> {{ trans('auth.registration') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
