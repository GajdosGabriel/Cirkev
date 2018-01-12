        <reply :attributes="{{ $comment }}" inline-template v-cloak>

            <div class="media" @mouseover="panel = true" @mouseout="panel = false" style="background: rgba(57, 61, 57, 0.15); padding: 15px; border-radius: 8px; margin-bottom: 28px;">
                <div>
                    @if(empty(!$comment->user->avatar))
                        <img class="img-rounded mr-3" src="{{ Storage::url('users/' . $comment->user->id . '/small-' . $comment->user->avatar ) }}">
                    @else
                        <i class="fa fa-user fa-4x"></i>
                    @endif
                </div>
                <div class="media-body">
                    <div  id="comment-{{ $comment->id }}">
                        <div  style="margin-bottom: 5px;">
                            <div><strong style="color: #000076">{{ $comment->user->fullname }}:</strong>

                            {{--Spravovať komentár --}}
                            @can('edit-comment', $comment)
                            <div v-if="editing">
                                <div class="form-group">
                                    <textarea class="form-control" rows="5" v-model="body"></textarea>
                                </div>
                                <button class="btn btn-primary btn-sm" @click="update">Uložiť</button>
                                <button class="btn btn-link" @click="editing = false">Zrušiť</button>
                                <button class="btn btn-xs btn-info btn-sm float-right" @click="destroy">Zmazať</button>
                            </div>
                            @endcan
                            {{--Koniec Spravovať komentár --}}

                            <div v-if="!editing" v-text="body" style="background: white; padding: 0 6px">
                            {{-- {{ $comment->text }}--}}
                            </div>
                            {{--@if( auth()->guest())--}}
                            {{--{{ $comment->text }}--}}
                            {{--@endif--}}
                        </div> <!-- /panel-body -->

                            {{--Upraviť --}}
                            @can('edit-comment', $comment)
                                <div style="display:flex; justify-content: flex-end; padding-left: 10px">
                                    <div @click="editing = true" v-show="panel" style="cursor: pointer">upraviť</div>
                                    <div style="padding:0 12px" title="{{ $comment->created_at}}">{{ $comment->created_at->diffForHumans() }}</div>
                                </div>
                            @endcan

                            <button @click="addLike" class="btn btn-default btn-sm" {{ $comment->isFavorited() ? 'disabled' : '' }}>
                                <span style="font-size: 130%; color: #cf0908" class="glyphicon glyphicon-heart" aria-hidden="true"></span>
                                 Dať hlas
                                {{ $comment->favorites()->count() }}
                            </button>
                    </div>
                    </div>
                </div>
            </div> {{--End of row--}}

        </reply>



