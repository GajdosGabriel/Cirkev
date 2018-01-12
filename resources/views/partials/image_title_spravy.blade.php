


@if($post->picture)
    <a href="{{ url($post->postShow()) }}"><img class="d-flex mr-3 rounded" src="{{ Storage::url( $post->pictureUrl() ) }}"   alt="{{ $post->user->fullname }}" ></a>

@elseif($post->video_link)
    <a href="{{ url($post->postShow()) }}"><img class="d-flex mr-3 rounded" src="{{ Storage::url( $post->videoImageUrl() ) }}"   alt="{{ $post->user->fullname }}" ></a>
    {{--<a href="{{ url($post->postShow()) }}"><img class="d-flex mr-3 rounded" src=" https://img.youtube.com/vi/{{ $post->video_link }}/mqdefault.jpg"   alt="{{ $post->user->fullname }}" ></a>--}}

@elseif($post->user->avatar)
    <a href="{{ url($post->postShow()) }}"><img class="d-flex mr-3 rounded" src="{{ Storage::url('users/' . $post->user->id . '/' . $post->user->avatar) }}
                "style="width: 100%; margin: -5% 0px -30% 0px;" alt="{{ $post->user->fullname }}" ></a>

@else
    <a href="{{ url($post->postShow()) }}"><img class="d-flex mr-3 rounded" src="{{ asset('images/foto.jpg') }}" alt="{{ $post->user->fullname }}"  ></a>
@endif