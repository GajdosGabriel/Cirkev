<form action="{{ route('comments.store', $post->id) }}" method="post">
    {{ csrf_field() }}

    <comments-form inline-template v-cloak>
        <div class="row">
            <div class="col-md-1"><i class="fa fa-user fa-4x"></i></div>
            <div class="col-md-11">
                    <div class="form-group {{ $errors->has('body') ? ' has-error' : '' }}">
                        <textarea minlength="3" v-model="body"  name="body" required rows="2" class="form-control" placeholder="Pridať nový komentár ..."></textarea>
                        @if ($errors->has('body'))
                            <span class="help-block"><strong>{{ $errors->first('body') }}</strong></span>
                        @endif
                    </div>

                    @if(Auth::guest())
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <transition name="slide-fade">
                                        <div v-if="body.length >3" class="col-md-4 {{ $errors->has('name') ? ' has-error' : '' }}">
                                            <input type="text" name="firstName" class="form-control" placeholder="Meno" required>
                                            @if ($errors->has('name'))
                                                <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
                                            @endif
                                        </div>
                                    </transition>

                                    <transition name="slide-fade">
                                        <div v-if="body.length >3" class="col-md-5 {{ $errors->has('email') ? ' has-error' : '' }}">
                                            <input type="email" name="email" class="form-control" placeholder="Email" required>
                                            <label class="text-danger text-center"><small>Email nebude nikde zverejnený.</small></label>
                                            @if ($errors->has('email'))
                                                <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
                                            @endif
                                        </div>
                                    </transition>

                                    <transition name="slide-fade">
                                        <div v-if="body.length >3" class="col-md-3 ">
                                            <input type="number" name="iamHuman" placeholder="Vpíšte číslo (5)" required><br>
                                            <label class="text-danger text-center"><small>Som človek  3+2 = 5</small></label>
                                        </div>
                                    </transition>
                                </div>
                            </div>
                        </div>
                    @endif
            </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary float-right">Vložiť komentár</button>
                    </div>
        </div>
    </comments-form>
</form>





    {{--{!! Form::open(['route' => 'comment.store', 'method' => 'post', 'class' => 'post']) !!}--}}

    {{--<div class="row">--}}
        {{--<div class="col-md-1"><i class="fa fa-user fa-4x"></i></div>--}}
        {{--<div class="col-md-11">--}}
            {{--<div class="form-group {{ $errors->has('text') ? ' has-error' : '' }}">--}}
                {{--{!! Form::textarea('text', null, [--}}
                {{--'class' => 'form-control', 'required' ,--}}
                {{--'placeholder' => "Pridať nový komentár ...",--}}
                {{--'rows' => 1,--}}
                {{--]) !!}--}}

                {{--@if ($errors->has('text'))--}}
                    {{--<span class="help-block"><strong>{{ $errors->first('text') }}</strong></span>--}}
                {{--@endif--}}
            {{--</div>--}}

            {{--@if(! Auth::check())--}}
                {{--<div class=" row form-group-sm col-sm-3 {{ $errors->has('name') ? ' has-error' : '' }}">--}}
                    {{--{!! Form::text('firstName', null, [--}}
                    {{--'class' => 'form-control', 'placeholder' => "Meno",--}}
                    {{--'required' => 'required',--}}
                    {{--]) !!}--}}

                    {{--@if ($errors->has('name'))--}}
                        {{--<span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>--}}
                    {{--@endif--}}
                {{--</div>--}}



                {{--<div class="form-group-sm col-sm-4 {{ $errors->has('email') ? ' has-error' : '' }}">--}}
                    {{--{!! Form::email('email', null, [--}}
                    {{--'class' => 'form-control',--}}
                    {{--'required' => 'required',--}}
                    {{--'placeholder' => "Email",--}}
                    {{--]) !!}--}}
                    {{--<label class="text-danger text-center"><small>Email nebude nikde zverejnený.</small></label>--}}

                    {{--@if ($errors->has('email'))--}}
                        {{--<span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>--}}
                    {{--@endif--}}
                {{--</div>--}}

                {{--Recapcha--}}
                {{--<div class="col-md-4">--}}
                    {{--{!!  app('captcha')->display() !!}--}}
                {{--</div>--}}
                {{--@if ($errors->has('g-recaptcha-response') )--}}
                    {{--<span class="help-block"><strong>{{ $errors->first('g-recaptcha-response') }}</strong></span>--}}
                {{--@endif--}}
        {{--</div>--}}
        {{--@endif--}}


        {{--<div>--}}
            {{--<div class="row">--}}
                {{-- Add comment Button --}}
                {{--<div class="form-group">--}}
                    {{--{!! Form::hidden('post_id', $post->id) !!}--}}
                    {{--{!! Form::button('Vložiť komentár', [--}}
                    {{--'type' => 'submit',--}}
                    {{--'class' => 'btn btn-primary pull-right',--}}
                    {{--'style' => 'margin-bottom: 20px'--}}
                    {{--]) !!}--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
{{--{!! Form::close() !!}--}}
