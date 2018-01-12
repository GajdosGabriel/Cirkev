
    <div class="card mt-3 border-default">
        <div class="card-header">{{ trans('web.user_new_users') }}<i class="fa fa-user-circle-o" aria-hidden="true"></i></div>
        <div class="list-group">
            @forelse( $newUsers as $newUser)
                <a  title="{{ $newUser->fullName }}" class="list-group-item" href="{{ route( 'user.show', [$user->id, $user->slug] ) }}">{{ str_limit( $newUser->fullName , 19) }}<small class="float-right">{{$newUser->created_at }}</small></a>
            @empty
                {{ trans('web.no_items') }}
            @endforelse
        </div>
    </div>

