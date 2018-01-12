

    <div class="panel panel-default">
        <div class="panel-heading">Témy príspevkov<span class="glyphicon glyphicon-picture pull-right"></span></div>
        <div class="list-group">
            @forelse( $tags as $tag)
                <a class="list-group-item" href="{{ url( 'tag' , $tag->slug) }}"><strong>{{ str_limit($tag->tag, 22) }}</strong> <small class="pull-right"> {{$tag->posts->count() }}x</small></a>
            @empty
                Žiadne príspevky
            @endforelse
        </div>
    </div>



