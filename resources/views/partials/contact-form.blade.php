
            <div class="modal-body">
                {!! Form::open(array('route' => 'contact_store', 'class' => 'form')) !!}


                <div class="form-group">
                    {!! Form::label(trans('web.user_firstname')) !!}
                    {!! Form::text('firstName', null,
                    array('required',
                    'class'=>'form-control',
                    'placeholder'=>'Vaše meno')) !!}
                </div>


                <div class="form-group">
                    {!! Form::label(trans('web.messenger')) !!}
                    {!! Form::textarea('message', null,
                    array('required',
                    'class'=>'form-control',
                    'placeholder'=> trans('web.messenger_write'))) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('Vaša E-mail Adresa') !!}
                    {!! Form::text('email', null,
                    array('required',
                    'class'=>'form-control',
                    'placeholder'=> trans('web.messenger_write'))) !!}
                </div>

                <div class="g-recaptcha" data-sitekey="6LfEPh8TAAAAAOoTzCkcPibBsC6BH7_dFd6h7Q6q"></div>
                <div class="form-group">
                    {!! Form::submit(trans('web.btn_send'),
                    array('class'=>'btn btn-primary')) !!}
                </div>


                {!! Form::close() !!}
        </div>
