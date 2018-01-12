@if(Auth::check())
    @if(! auth()->user()->verified)
        <div style="background: red;color: #f5f0cd">
            <div  class="container text-center">
                Váš email nebol overený! Skontrolujte si Vašu emailovú schránku! <a style="color: white" href="{{ route('userverification.resend', auth()->user()->email ) }}">Znovu poslať aktivačný email.</a>
{{--                Aktivujte si účet! Emailom bol zaslaný aktivačný link! <a style="color: white" href="{{ route('userverification.resend') . '?email=' . auth()->user()->email }}">Poslať aktivačný link.</a>--}}
            </div>
        </div>
    @endif
@endif

