
@if ( $categories )

    <div class="card mt-3 bg-danger">
        <div class="card-header text-white">{{ trans('web.all_categories') }} <i class="fa fa-folder-open-o float-right" aria-hidden="true"></i></div>
            <div class="list-group">
                    @forelse ( $categories as $category )
                        <a class="{{ (current_page($category->slug)) ? 'active' : '' }} list-group-item" href="{{ url('kategorie', $category->slug) }}"><strong>{{ $category->name  }}</strong>
                            <small class="float-right">({{ $category->posts()->count() }})</small></a>
                        @empty
                        <p>{{ trans('web.post_empty') }}</p>
                    @endforelse
            </div>
    </div>


@endif




