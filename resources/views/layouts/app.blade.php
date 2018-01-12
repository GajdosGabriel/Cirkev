<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('description')">
    <meta name="author" content="@yield('autor')">
    @yield('othermeta')
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Scripts -->

	<title>@yield('title')</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
            'signedIn' => Auth::check()
        ]) !!};
    </script>
    @yield('headerScript')
    @yield('style')
    <style>
        [v-cloak] { display: none}
    </style>
</head>

<body>
    @yield('faceBookScript')

    @include('partials.analyticstracking')
    @include('user.infopanel')
    @include('partials.carousel')
    @include('partials.navigation')

	<main id="app">
        @include('flash::message')
        <div class="container pt-3 pb-5">

            <div class="row">
                <div class="col-md-12">

                    @include('partials.errors')
                    @yield('video-fool')

                </div>
            </div>

            <div class="row">
                <div class="col-lg-9">
                    @yield('content')
                </div>

                <div class="col-lg-3">
                    @yield('side')
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    @yield('content-8')
                </div>

                <div class="col-md-4">
                    @yield('side-4')
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    @yield('content-12')
                </div>
            </div>

        </div> {{-- End of .container --}}
    </main>

    @include('layouts.footer')

    <script src="{{ asset('js/app.js') }}"></script>
    @yield('script')

    <script>
        $('div.alert').not('.alert-important').hide().fadeIn(800).delay(5000).fadeOut(350);
    </script>

</body>
</html>