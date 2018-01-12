
<div class="modal-body">
    <form method="post" action="{{ route('contactStoreUser', $post->user->id ?? $user->id) }}">
        {{ csrf_field() }}
        @if(auth()->guest())
            <div class="form-group">
                {!! Form::label('Meno') !!}
                {!! Form::text('name', null,
                array('required',
                'class'=>'form-control',
                'placeholder'=>'Vaše meno')) !!}
            </div>

            <div class="form-group">
                {!! Form::label('Vaša E-mail Adresa') !!}
                {!! Form::email('email', null,
                array('required',
                'class'=>'form-control',
                'placeholder'=>'Vaša e-mailová adresa')) !!}
            </div>
        @endif
            <div class="form-group">
                {!! Form::label('Správa') !!}
                {!! Form::textarea('body', null,
                array('required',
                'minlength' => '3',
                'class'=>'form-control',
                'placeholder'=>'Napíšte svoju správu')) !!}
            </div>

        @if(auth()->guest())
            <div class="form-group">
                {!! Form::label('Som človek  3 + 2 =' ) !!}
                <input type="number" name="iamHuman" placeholder="Vpíšte číslo" required>
            </div>

        @endif

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Odoslať <span class="glyphicon glyphicon-envelope"></span></button>
            </div>
    </form>
</div>
