@if($post->picture)
    <a href="{{ url($post->postShow()) }}"><img class="img-rounded media-object" src="{{ Storage::url($post->pictureUrl() ) }}"  style="width: 100%" alt="{{ $post->user->fullname }}" ></a>

@elseif($post->video_link)
    <a href="{{ url($post->postShow()) }}"><img class="media-object img-rounded" src=" {{ Storage::url($post->videoImageUrl() ) }}"  style="width: 100%;" alt="Video {{ $post->user->fullname }}" ></a>

@elseif($post->user->avatar)
{{--    <a href="{{ route('post.edit', [$user->id, $avatar->title]) }}"><img class="img-rounded" src="{{ Storage::url('users/' . $post->user->id . '/' . $post->user->avatar ) }}"  style="width: 100%;margin-top: -42px" alt="{{ $post->user->fullname }}" ></a>--}}
<a href="{{ url($post->postShow()) }}"><img class="img-rounded" src="{{ Storage::url('users/' . $post->user->id . '/' . $post->user->avatar ) }}"  style="width: 100%;margin-top: -42px" alt="{{ $post->user->fullname }}" ></a>

@else
    <a href="{{ url($post->postShow()) }}"><img class="media-object" src="{{ asset('images/foto.jpg') }}" alt="{{ $post->user->fullname }}"  style="width: 100%"></a>

@endif