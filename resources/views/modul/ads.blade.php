{{--    @if($widgets = \App\Widget::where('position', $webposition)->where('published', 'Yes')->get())--}}


    @if($widgets = \App\Widget::where('position', $webposition)
    ->where('published', 'Yes')

    ->where(function($query){
    $query->whereNull('startPublished')
    ->orWhere('startPublished', '<=' , Carbon\Carbon::now());
    } )

    ->where(function($query){
    $query->whereNull('endPublished')
    ->orWhere('endPublished', '>=' , Carbon\Carbon::now());
    })
    ->get())


        @foreach( $widgets as $widget)

            @if(isset($widget->picture))
                <a href="{{$widget->link}}" target="_blank">
                <img class="img-fluid" src="{{ asset(Storage::url($widget->picture)) }}" alt="">
                </a>
            @else
            <div class="{{ ($widget->showMobile == 'No') ? 'hidden-xs' : '' }}" style="margin-bottom:20px; background: firebrick; width: 100%; height: 300px; color: white; font-size: 200%">
            {!! html_entity_decode($widget->text) !!}
            </div>
            @endif
            @endforeach
    @endif



