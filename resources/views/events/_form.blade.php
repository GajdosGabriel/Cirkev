<div class="col-md-8">

    <div class="form-group">
        <label for="">{{ trans('web.events_title') }}</label>
        <input type="text" name="title" placeholder="Názov" value="{{ old('title') ?? $event->title }}" class="form-control" required>
    </div>

    <label for="">{{ trans('web.events_body') }}</label>
    <textarea name="body" id="article-ckeditor" required>{{ old('body') ?? $event->body }}</textarea>

    <div class="row">
        <div class="col-md-12 mt-4">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label id="picture"><strong>{{ trans('web.events_picture') }}</strong></label>
                        <input id="picture" type="file" name="picture" placeholder="Obrázok" accept="image/*" class="form-control input-sm">
                    </div>
                </div>

                <div class=" col-md-6">
                    <div class="form-group">
                        <label id="append"><strong>{{ trans('web.events_appendFile') }}</strong></label>
                        <input id="append" type="file" name="appendFile" accept=".pdf,.doc,.docx,.txt" class="form-control input-sm">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-4" style="background: #0c3441; padding: 10px; color: #2695cb">

    <div class="form-group">
        <label for="">{{ trans('web.events_dateStart') }}</label>
        <input type="date" name="dateStart" placeholder="Krátky popis" value="{{ old('dateStart') ?? $event->dateStart->format('Y-m-d') }}" class="form-control input-sm" required>
    </div>

    <div class="form-group">
        <label for="">{{ trans('web.events_timeStart') }}</label>
        <input type="time" name="timeStart" class="form-control input-sm" value="{{ old('timeStart') ?? $event->timeStart->format('H:i') }}" required>
    </div>

    {{--<div class="form-group">--}}
    {{--<label for="">Koniec akcie - nepovinné</label>--}}
    {{--<input type="date" name="dateEnd" placeholder="Krátky popis" class="form-control input-sm">--}}
    {{--</div>--}}

    <div class="form-group">
        <label for="">{{ trans('web.events_street') }}</label>
        <input type="text" name="street" value="{{ old('street') ?? $event->street }}"  placeholder="Adresa konania" class="form-control input-sm" required>
    </div>

    <div class="form-group">
        <label for="">{{ trans('web.events_city') }}</label>
        <input type="text" name="city" value="{{ old('city') ?? $event->city }}" placeholder="Mesto/obec konania" class="form-control input-sm" required>
    </div>

    <div class="form-group">
        <label for="">{{ trans('web.events_region_of_event') }}</label>
        <select name="region" class="form-control input-sm" required>
            <option label="{{ trans('web.select') }}"></option>
            <option @if($event->region == 'bratislavsky')  selected @endif value="bratislavsky">Bratislavský</option>
            <option @if($event->region == 'trenciansky')  selected @endif value="trenciansky">Trenčianský</option>
            <option @if($event->region == 'zilinsky')  selected @endif value="zilinsky">Žilinský</option>
            <option @if($event->region == 'presovsky')  selected @endif value="presovsky">Prešovský</option>
            <option @if($event->region == 'kosicky')  selected @endif value="kosicky">Košický</option>
            <option @if($event->region == 'banskobystricky')  selected @endif value="banskobystricky">Banskobystrický</option>
            <option @if($event->region == 'trnavsky')  selected @endif value="trnavsky">Trnavský</option>
            <option @if($event->region == 'nitriansky')  selected @endif value="nitriansky">Nitrianský</option>
            <option @if($event->region == 'all')  selected @endif value="all">Celé Slovensko</option>
        </select>
    </div>


    <div class="form-group">
        <label for="">{{ trans('web.events_clientwww') }}</label>
        <input type="text" name="clientwww" value="{{ old('clientwww') ?? $event->clientwww }}" placeholder="Odkaz na váš webovú stánku" class="form-control input-sm">
    </div>

    <div class="form-group">
        <label for="">{{ trans('web.events_organizator') }}</label>
        <input type="text" name="organizator" value="{{ old('corganizator') ?? $event->organizator }}" placeholder="Názov organizácie" class="form-control input-sm" required>
    </div>

    <div class="form-group">
        <label for="">{{ trans('web.events_registration') }}</label>
        <select name="registration" class="form-control input-sm" required>
            <option label="{{ trans('web.select') }}"></option>
            <option @if($event->registration == 'no')  selected @endif  value="no">Bez rezervácie</option>
            <option @if($event->registration == 'recomended')  selected @endif value="recomended">Doporučuje sa</option>
            <option @if($event->registration == 'yes')  selected @endif  value="yes">Požaduje sa registrácia</option>
        </select>
    </div>

    <div class="form-group">
        <label for="">{{ trans('web.events_entryFee') }}</label>
        <select name="entryFee" class="form-control input-sm" required>
            <option label="{{ trans('web.select') }}"></option>
            <option @if($event->entryFee == 'no')  selected @endif value="no">Bez vstupného</option>
            <option @if($event->entryFee == 'voluntarily')  selected @endif value="voluntarily">Dobrovoľné</option>
            <option @if($event->entryFee == 'yes')  selected @endif value="yes">Vyžaduje</option>
        </select>
    </div>

    <div>
        <label><input type="radio" value="1"
                      @if( isset($event->published) AND $event->published == 1)
                      checked @else checked @endif
                      name="published">{{ trans('web.events_published_now') }} </label>

        <label><input type="radio" value="0"
                      @if( isset($event->published) AND $event->published == 0)
                      checked
                      @endif
                      name="published"> {{ trans('web.events_published_later') }}</label>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-info btn-block"> {{ $buttonText ?? trans('web.btn_save') }}</button>
    </div>

</div>