
@if(!Request::has('search') && Request::is('/') && !app('request')->input('by'))
    <h3 class="my-4">Správy</h3>
<div class="row">

        {{--Hlavná správa--}}
    <div class="col-md-6">



        <div class="head_news">
            @forelse ($posts as $post)
                <div class="card">
                    <div class="card-img-top">@include('partials.image_title_spravy')</div>
                    <div  class="card-header">
                        <h5>
                            <a href="{{ url($post->postShow()) }}">
                                @if($post->video_link) <img style="width: 25px" src="{{ url('images/play_icon.png') }}"> @endif <strong>{{ $post->title }}</strong>
                            </a>
                        </h5>

                        {{--Count how article/min is long--}}
                        @if(empty($post->video_link))
                            <span class="label label-danger float-right">{{ round(str_word_count($post->body) /110) }} min.</span>
                        @endif

                        <time datetime="{{ $post->datetime }}">
                            <a href="{{ asset('/?by='. $post->user->id . '/'. $post->user->slug) }}">
                                <span>{{ $post->user->fullname }}</span>
                            </a>
                            <span> {{ $post->format_date }}
                            {{--  <i class="fa fa-comment"> ({{ $post->comments->count() }}) </i> |--}}
                            <i class="fa fa-eye float-right text-muted"> ({{ $post->count_view }}x) </i>
                            </span>
                        </time>
                        {!! htmlspecialchars_decode (str_limit ($post->text, 85)) !!}
                    </div>
                </div>
            @empty
                <p>{{ trans('web.no_items') }}</p>
            @endforelse
        </div>
    </div>  {{--Koniec hlavnej správy--}}



        {{-- Next 5 News --}}
        <div class="col-md-6">
            <div class="news-list">
                 @forelse ($postsNext as $post)

                <div class="media">
                    @include('partials.image_title_spravy')
                    <div class="media-body mb-3">
                          <h6><a href="{{ url($post->postShow()) }}">{{ $post->title }}</a>
                              <i class="fa fa-eye float-right text-muted"> ({{ $post->count_view }}x) </i>
                          </h6>

                          <div style="margin-top: -8px"><a href="{{ asset('/?by='. $post->user->id . '/'. $post->user->slug) }}"><span>{{ $post->user->fullname }}</span></a>
                             <time class="text-muted" datetime="{{ $post->datetime }}">{{ $post->format_date }}</time>
                          </div>
                    </div>
                </div>
                 @empty
                    <p>{{ trans('web.no_items') }}</p>
                 @endforelse
            </div>
        </div>
</div>

@endif
