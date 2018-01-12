@forelse( $user as $post )
    <div class="media">
        <div class="media-body">
            <strong class="media-heading"> <a href="{{ url($post->postShow()) }}">{{ $post->title }}</a></strong>
            <p>
                <time datetime="{{ $post->datetime }}" style="">
                     <span class=""> {{ $post->Datetime }} | <i class="fa fa-comment"> ({{ $post->comments->count() }}) </i> |
                        <i class="fa fa-eye"> ({{ $post->count_view }}x) </i></span>
                </time>
            </p>
        </div>
    </div>

@empty
    <p>Zatiaľ bez príspevkov</p>
@endforelse
