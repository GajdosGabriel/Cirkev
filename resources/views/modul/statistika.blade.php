
    <div class="card mt-3 border-primary">
        <div class="card-header bg-primary">{{ trans('web.post_most_reading') }}<i class="fa fa-file-o float-right text-white" aria-hidden="true"></i></div>
        <div class="list-group">
            @forelse( $posledne_prispevky as $post)
               <a title="{{ $post->title }}" class="list-group-item list-group-item-action" href="{{ url($post->postShow()) }}">{{ str_limit($post->title, 20) }}<small class="pull-right"> {{$post->count_view}}x</small></a>
            @empty
                {{ trans('web.no_items') }}
            @endforelse
        </div>
    </div>




