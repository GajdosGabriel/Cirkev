<?php

namespace App\Http\Controllers;

use App\Event;
use App\EventSubscription;
use App\User;
use Illuminate\Http\Request;


class EventSubscriptionController extends Controller
{

    public function store(Request $request, Event $event) {

        if( $eventsub = $event->subscriptions()->whereUserId(auth()->id() )->whereEventId($event->id)->first()) {
            $eventsub->update(request()->all());
        } else {
            $event->subscriptions()->create( array_merge(request()->all(), ['user_id' => auth()->id()]) );
        }
        if($request->has('record') AND $request->input('record') == 1) {
            flash()->success( trans('web.events_record_wants_send'));
        }elseif($request->has('registration') AND $request->input('registration') == 1){
            flash()->success( trans('web.events_rezervation_already'));
        }elseif($request->has('record') AND $request->input('record') == 0){
            flash()->success( trans('web.events_record_wants_unsend'));
        }else{
            flash()->success( trans('web.events_rezervation_unset'));
        }
        return redirect( route('event.show', [$event->id, $event->slug]) );
    }
}
