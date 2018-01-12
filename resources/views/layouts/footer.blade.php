<footer id="subfooter" class="clearfix" style="background: #142127; color: white; padding-top: 60px; padding-bottom: 40px;">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h4>O projekte</h4>
                <p><a href="#">Dokumentácia</a>
                <p><a href="#">Podpora</a>
                <p><a href="#">Blog</a>

                    {{-- Start Language switch--}}
                    @can('admin')
                <div id="navbar" class="navbar-collapse collapse navbar-right">
                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span id="lanNavSel">{{ Session::get('applocal') }}</span> <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a id="navIta" href="{{ url('lang/sk') }}#" class="language"><span id="sk">Sk</span></a></li>
                                <li><a id="navIta" href="{{ url('lang/cz') }}#" class="language"><span id="sk">Cz</span></a></li>
                                <li><a id="navIta" href="{{ url('lang/en') }}#" class="language"><span id="sk">En</span></a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                @endcan
                {{-- End Language switch--}}
            </div>
            <div class="col-md-4" id="contact-info">
                <h4>Kontakt</h4>
                <p><span class="fa fa-globe"></span>Trenčín, Slovensko</p>
                <p><span class="fa fa-phone"></span>0905 320 616</p>
                <p><span class="fa fa-envelope"></span><a href="#" data-toggle="modal" data-target="#contact" data-whatever="@mdo" >Napíšte nám</a></p>
            </div>
            <div class="col-md-4">
                <h4>Našli ste chybu?</h4>
                    <form method="post" action="{{ url('/podnety') }}">
                        {{ csrf_field() }}
                        <textarea name="body" rows="5" style="width: 100%; color: black" required placeholder="Napíšte nám svoje podnety ... Ďakujeme" value="{{ old('body') }}"></textarea>
                        <div class="form-group">
                            {!! Form::label('Som človek  3 + 2 = ' ) !!}
                            <input type="number" name="iamHuman" placeholder="Zadajte číslo" style="color: black; width: 30%" required>

                        <button type="submit" class="btn btn-danger btn-xs pull-right">Odoslať <span class="glyphicon glyphicon-envelope"></span></button>
                        </div>

                    </form>

                {{--<div class="input-group">--}}
                    {{--<input type="text" class="form-control" placeholder="Enter your email..." />--}}
                        {{--<span class="input-group-btn">--}}

                              {{--<button type="button" class="btn btn-danger">Prihlásených <span class="badge">273</span></button>--}}
                        {{--</span>--}}
                {{--</div>--}}


                {{--<p>--}}
                    {{--<a class="fa fa-twitter footer-socialicon" target="_blank" href="https://twitter.com/"></a>--}}
                    {{--<a class="fa fa-facebook footer-socialicon" target="_blank" href="https://www.facebook.com/"></a>--}}
                    {{--<a class="fa fa-google-plus footer-socialicon" target="_blank" href="https://plus.google.com/"></a>--}}
                    {{--<a class="fa fa-linkedin footer-socialicon" target="_blank" href="https://plus.google.com/"></a>--}}
                {{--</p>--}}

            </div>
        </div>
    </div>
</footer>

<footer id="footer" class="clearfix" style="background: #000000">
    <div class="container">
        <div id="copyright" class="row justify-content-center">
            <p >Autor šablóny <span class="author">Gajdoš Gabriel</span> 2017 <a href="{{ url('/') }}" title="Cirkev online.sk">Cirkevonline.sk</a></p>
        </div>
    </div>
</footer>
