
    <div class="card mt-3 border-success">
        <div class="card-header bg-success"><span>{{ trans('web.comments_latest') }}</span><i class="fa fa-comment-o float-right text-white" aria-hidden="true"></i></div>
        <div class="card-body">
            @forelse( $posledne_com as $comentar)
               <p><a class="text-success" href="{{ url( $comentar->post->postShow()) }}">{{ str_limit($comentar->body, 28) }}</a></p>
            @empty
               {{ trans('web.no_items') }}
            @endforelse
        </div>
    </div>

