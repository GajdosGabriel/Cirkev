@section('style')
<style> select {
        width: 100%;
        padding: 13px 17px;
        border: none;
        border-radius: 4px;
        background-color: #6d0c2d;
        font-size: 15px;
        color: white;
    }</style>
@endsection


<div class="row">
    <div class="form-group col-md-3 {{ $errors->has('group_id') ? ' has-error' : '' }}">

        <label>Kategória</label>
        <select name="group_id" class="form-control" required>
            <option value="" selected disabled >Vybrať kategóriu</option>
            @foreach($categories as $category)
                <option
                        @if( isset($post->group_id) AND $post->group_id == $category->id )
                        selected
                        @endif
                        value="{{ $category->id }}"
                >
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Video Link --}}
    <div class="form-group col-md-3">
        <label>Video YouTube</label>
        {!! Form::text('video_link', null, ['class' => 'form-control',  'placeholder' => 'Odkaz na video Youtube']) !!}
    </div>

    <div class="form-group col-md-3">
        <label>{{ trans('web.picture') }}</label>
        {!! Form::file('picture', ['class' => 'form-control', 'accept' => "image/*"]) !!}
    </div>


    @can('admin')
        <div class="form-group col-md-3">
            <label>{{ trans('web.author') }}</label>
            <select class="form-control" name="user_id" required>
                <option value="" selected disabled>{{ trans('web.select') }}</option>
                @foreach($users as $user)
                    <option
                            @if( isset($post->user_id) AND $post->user_id == $user->id )
                            selected
                            @endif
                            value="{{ $user->id }}">{{ $user->lastName . ' ' . $user->firstName }}</option>
                @endforeach
            </select>
        </div>
    @endcan

</div>


    {{-- Title Field --}}
    <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
        {!! Form::text ('title', null, ['class' => 'form-control', 'placeholder' => trans('web.post_title'), 'required' ]) !!}
    </div>


{{-- Text Field --}}
<div class="form-group {{ $errors->has('body') ? ' has-error' : '' }}">
    {!! Form::textarea('body', null, ['class' => 'form-control', 'id'=>'ckeditor', 'placeholder' => trans('web.post_body'), 'required']) !!}
    @if ($errors->has('body'))
        <span class="help-block">
        <strong>{{ $errors->first('body') }}</strong></span>
    @endif
</div>

     {{--Text Field--}}
    {{--<div class="form-group {{ $errors->has('body') ? ' has-error' : '' }}">--}}
    {{--<textarea id="ckeditor" name="body" class="form-control" placeholder="{{ trans('web.post_body') }}"  required>{{ old('body') ?? $post->body }}</textarea>--}}
        {{--@if ($errors->has('body'))--}}
        {{--<span class="help-block">--}}
        {{--<strong>{{ $errors->first('body') }}</strong></span>--}}
        {{--@endif--}}
    {{--</div>--}}


     {{--Tags Field--}}
    <div class="form-group">
        @foreach(\App\Tag::all() as $tag)
            <label class="checkbox-inline">
                {!! Form::checkbox('tags[]', $tag->id, null) !!}
                {{ $tag->tag }}
            </label>
        @endforeach
    </div>

    {{-- Add post Field --}}
    <div class="form-group">
        <button type="submit" class="btn btn-primary">{{ trans('web.post_save') }}</button>
        <span class="or">
            or {!! link_back( trans('web.btn_cancel')) !!}
        </span>
    </div>




@section('script')
{{--CK editor--}}
<script src="{{ asset('\vendor\unisharp\laravel-ckeditor\ckeditor.js') }}"></script>

<script>
    CKEDITOR.replace( 'ckeditor' );
</script>

@endsection
