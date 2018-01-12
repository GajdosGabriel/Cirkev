@extends('layouts.app')


@section('title', $user->fullname)
@section('headerScript')
    {{--Javasscript for google maps --}}
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript">
        var geocoder = new google.maps.Geocoder();

        function geocodePosition(pos) {
            geocoder.geocode({
                latLng: pos
            }, function(responses) {
                if (responses && responses.length > 0) {
                    updateMarkerAddress(responses[0].formatted_address);
                } else {
                    updateMarkerAddress('Cannot determine address at this location.');
                }
            });
        }

        function updateMarkerStatus(str) {
            document.getElementById('markerStatus').innerHTML = str;
        }

        function updateMarkerPosition(latLng) {
            document.getElementById('info').innerHTML = [
                latLng.lat(),
                latLng.lng()
            ].join(', ');
            document.getElementById('lat').value = latLng.lat();
            document.getElementById('lng').value = latLng.lng();
        }

        function updateMarkerAddress(str) {
            document.getElementById('address').innerHTML = str;
        }

        function initialize() {
            var latLng = new google.maps.LatLng(48.780035, 19.49248460937497);
            if (document.getElementById('lat').value != '' && document.getElementById('lng').value != '') {
                latLng = new google.maps.LatLng(document.getElementById('lat').value, document.getElementById('lng').value);
            }
            var map = new google.maps.Map(document.getElementById('mapCanvas'), {
                zoom: 7,
                center: latLng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });
            var marker = new google.maps.Marker({
                position: latLng,
                title: 'Poťiahnite na vašu polohu',
                map: map,
                draggable: true
            });

            // Update current position info.
            updateMarkerPosition(latLng);
            geocodePosition(latLng);

            // Add dragging event listeners.
            google.maps.event.addListener(marker, 'dragstart', function() {
                updateMarkerAddress('Posúvam ...');
            });

            google.maps.event.addListener(marker, 'drag', function() {
                updateMarkerStatus('Posúvam ...');
                updateMarkerPosition(marker.getPosition());
            });

            google.maps.event.addListener(marker, 'dragend', function() {
                updateMarkerStatus('Stop');
                geocodePosition(marker.getPosition());
            });
        }

        // Onload handler to fire off the app.
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
@endsection


@section('video-fool')

    {!! Form::model($user, ['route' => [ 'user.update', $user->id, $user->slug ], 'method' => 'patch', 'files'=> 'true', 'class' => 'post', 'id' => 'edit-form']) !!}

<div class="row">
    <div class="col-md-3">
            {{--Foto section--}}
        <div class="card">
            <div class="card-header bg-primary"><h5 class="text-center text-white">{{ $user->fullname }}</h5></div>

            @if ($user->avatar)
                 <img class="img-rounded card-img-top" src="{{ Storage::url( $user->userPictureUrl() ) }} " alt="{{$user->fullname}}">
            @else
                <img class="img-rounded card-img-top" src="{{ url('images/avatar.png') }}">
            @endif
            <div class="card-body">
                <div class="form-group">
                    <label>{{ trans('web.user_profile_picture') }}</label>
                    {!! Form::file('avatar', ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div id="accordion" role="tablist">
            <div class="card">
                <div class="card-header bg-warning" role="tab" id="headingOne">
                    <h5 class="mb-0">
                        <a data-toggle="collapse" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            {{ trans('web.user_profile_change') }}
                        </a>
                    </h5>
                </div>

                <div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                        {!! Form::textarea('about_user', null, ['class' => 'form-control',  'id'=>'ckeditor', 'placeholder' => 'Popis o autorovi']) !!}
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header" role="tab" id="headingTwo">
                    <h5 class="mb-0">
                        <a class="collapsed" data-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            {{ trans('web.user_personal') }}
                        </a>
                    </h5>
                </div>
                <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion">
                    <div class="card-body">
                        <label class="sr-only" for="inlineFormInputGroup">{{ trans('web.user_firstname') }}</label>
                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                            <div class="input-group-addon">{{ trans('web.user_firstname') }}</div>
                            <input type="text" name="firstName" value="{{ $user->firstName }}" class="form-control" id="inlineFormInputGroup" placeholder="Meno">

                        </div>

                        <label class="sr-only" for="inlineFormInputGroup">{{ trans('web.user_lastname') }}</label>
                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                            <div class="input-group-addon">{{ trans('web.user_lastname') }}</div>
                            <input type="text" name="lastName" value="{{ $user->lastName }}" class="form-control" id="inlineFormInputGroup" placeholder="Priezvisko">
                        </div>

                        <label class="sr-only" for="inlineFormInputGroup">{{ trans('web.user_email') }}</label>
                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                            <div class="input-group-addon">{{ trans('web.user_email') }}</div>
                            <input type="text" name="email" value="{{ $user->email }}" class="form-control" id="inlineFormInputGroup" placeholder="{{ trans('web.user_email') }}">
                        </div>


                        <label class="sr-only" for="inlineFormInputGroup">{{ trans('web.user_phone') }}</label>
                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                            <div class="input-group-addon">{{ trans('web.user_phone') }}</div>
                            <input type="text" name="phone" value="{{ $user->phone }}" class="form-control" id="inlineFormInputGroup" placeholder="{{ trans('web.user_phone_noshow') }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button class="btn btn-info" type="submit" form="edit-form">Uložiť profil</button>
    </div>


    <div class=" col-md-12 text-center">
        <h2 class="text-center">Údaje do mapy kresťanov Slovenska <img style="height: 50px;" src="{{ asset('images/slovakia.gif') }}" title="Sme hrdý na Slovensko" alt="Slovenská vlajka"> </h2>

    </div>



    <div class="col-md-6">
        <p style="color: red">Kliknite na  červený marker a poťahujte na miesto svojho pôsobenia.</p>
        <div id="mapCanvas"></div>
        <div id="infoPanel">
            <div id="markerStatus"><i>Kliknite na marker, držiac ťahajte.</i></div>
            <b>Táto pozícia bude uložená:</b>
            {!! Form::hidden('lat', null, ['id' => 'lat']) !!}
            {!! Form::hidden('lng', null, ['id' => 'lng']) !!}
            <div id="info"></div>
            {{--<b>Closest matching address:</b>--}}
            {{--<div id="address"></div>--}}
        </div>
    </div>

    <div class="col-md-6">
        <div class="card bg-info">
            <div class="card-body">
                <div style="display: block" class="checkbox checkbox-primary">
                    {!! Form::checkbox('verim', "1", null, ['id' => 'verim']) !!}
                    {!! Form::label('verim', 'Som pratizujúci kresťan verím v Ježiša Krista.', []) !!}
                </div>


                <label>{{ trans('web.user_gender') }}</label>

                <select name="gender">
                    <option label="{{ trans('web.select') }}"></option>
                    <option {{ ($user->gender == 'M') ? "selected" : "" }} value="M">{{ trans('web.user_man') }}</option>
                    <option {{ ($user->gender == 'F') ? "selected" : "" }} value="F">{{ trans('web.user_woman') }}</option>
                </select>

                <label for="denomination_id">
                    Voliteľné  <?php $den= $denomination->toArray();
                    array_unshift($den,trans('web.select'));
                    ?>
                    {!!Form::select('denomination_id', $den , isset($user->denomination->id) ? $user->denomination->id : ''  ) !!}
                </label>

                <div style="display: block" class="checkbox checkbox-primary">
                    {!! Form::checkbox('homegroupe', "1", null, ['id' => 'homegroupe']) !!}
                    {!! Form::label('homegroupe', 'Som členom domáceho stretávania do ktorého vás pozývam', []) !!}
                </div>

                <div style="display: block" class="checkbox checkbox-primary">
                    {!! Form::checkbox('healing', "1", null, ['id' => 'healing']) !!}
                    {!! Form::label('healing', 'Modlím sa za telesné uzdravenie', []) !!}
                </div>

                <div style="display: block" class="checkbox checkbox-primary">
                    {!! Form::checkbox('exorsizmus', "1", null, ['id' => 'exorsizmus']) !!}
                    {!! Form::label('exorsizmus', 'Môžem sa modliť za duchovné oslobodenie od nečistých síl', []) !!}
                </div>

                <h4>Služobné dary</h4>

                <div style="display: block" class="checkbox checkbox-danger">
                    {!! Form::checkbox('church_employee', "1", null, ['id' => 'church_employee']) !!}
                    {!! Form::label('church_employee', 'Duchovný z povolania. Vyk. krsty, sobáše, pohreby a sviatosti.', []) !!}
                </div>

                <div style="display: block" class="checkbox checkbox-danger">
                    {!! Form::checkbox('rehola', "1", null, ['id' => 'rehola']) !!}
                    {!! Form::label('rehola', 'Duchovný v rehoľnom ráde.', []) !!}
                </div>

                <div style="display: block" class="checkbox checkbox-danger">
                    {!! Form::checkbox('ministrant', "1", null, ['id' => 'ministrant']) !!}
                    {!! Form::label('ministrant', 'Miništrant, pomocný duch. alebo ním bol.', []) !!}
                </div>

                <div style="display: block" class="checkbox checkbox-danger">
                    {!! Form::checkbox('missioner', "1", null, ['id' => 'missioner']) !!}
                    {!! Form::label('missioner', 'Misionár s pôsobnosťou mimo Slovenska.', []) !!}
                </div>

                <div style="display: block" class="checkbox checkbox-danger">
                    {!! Form::checkbox('diakon', "1", null, ['id' => 'diakon']) !!}
                    {!! Form::label('diakon', 'Vykonávam diakonskú službu milosrdenstva a pomoci', []) !!}
                </div>

                <div style="display: block" class="checkbox checkbox-success">
                    {!! Form::checkbox('maria', "1", null, ['id' => 'maria']) !!}
                    {!! Form::label('maria', 'Som hlboký Marianský ctiteľ.', []) !!}
                </div>

                <div style="display: block" class="checkbox checkbox-success">
                    {!! Form::checkbox('mariageservice', "1", null, ['id' => 'mariageservice']) !!}
                    {!! Form::label('mariageservice', 'Služím manželom a rodine, poradenstvo.', []) !!}
                </div>


                <div style="display: block" class="checkbox checkbox-success">
                    {!! Form::checkbox('christian_abroad', "1", null, ['id' => 'christian_abroad']) !!}
                    {!! Form::label('christian_abroad', 'Som kresťan žijúci v zahraničí', []) !!}
                </div>

                <div class="form-group {{ $errors->has('profile_desc') ? ' has-error' : '' }}">
                    {!! Form::text ('profile_desc', null, ['class' => 'form-control input-sm', 'placeholder' => 'Krátke informácie o vás max 100 znakov.' ]) !!}
                    @if ($errors->has('profile_desc'))
                        <span class="help-block"><strong>{{ $errors->first('profile_desc') }}</strong></span>
                    @endif
                </div>
            </div>
        </div>
    </div>

<div class="mt-3 col-md-6 mx-auto mb-3">
    {!! Form::button( trans('web.user_profile_save'), ['type' => 'submit', 'class' => 'btn btn-primary btn-block']) !!}
    {!! Form:: close() !!}
</div>

</div>


    <div class="row">
        <div class="card">
            <div class="card-header">Emaily:
                @forelse($user->verifications as $user)
                    <span class="badge badge-secondary"> {{ $user->email }} {{ $user->verified }}</span>

                @empty
                    <p>Žiadny email čo je nemožné!</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBL4GrUZj-5mnPkYnDr6Or-7tMFF7AQrrI&callback=initMap"
            type="text/javascript">
    </script>





{{--CK editor--}}
    <script src="{{ asset('\vendor\unisharp\laravel-ckeditor\ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace( 'ckeditor' );
    </script>

    @endsection