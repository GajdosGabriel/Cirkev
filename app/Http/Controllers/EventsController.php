<?php

namespace App\Http\Controllers;

use App\Event;
use App\Http\Requests\SaveEventRequest;
use App\Notifications\Events\EventWasCreated;
use App\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Services\UploadFile;


class EventsController extends Controller
{

    public function index()
    {
        $events = Event::activeEventsList()->get();
        return view('events.index')->with('events', $events);
    }

    public function show(Event $event, $slug)
    {
        $event->increment('count_view');
        return view('events.show')->with('event', $event);
    }


    public function create(User $user)
    {
        return view('events.create', ['event' => new Event])->with('title', trans('web.events_create') );
    }

    public function adminEvents(User $user, $slug)
    {
        $events = $user->events()->latest()->get();
        return view('events.adminEvents')->with('title', trans('web.events_create'))->with('events', $events);
    }

    public function edit(Event $event, $slug)
    {
        return view('events.edit', compact('event'))->with('title', trans('web.events_save_update'));
    }


    public function copy(Event $event, $slug)
    {
        return view('events.edit', compact('event'))->with('title', trans('web.events_save_update'));
    }


    public function store(SaveEventRequest $request, User $user, UploadFile $uploadFile)
    {
        $event = $user->events()->create($request->all());

        $uploadFile->saveFile(request('picture'),$event);

        $uploadFile->saveAppendFile($event);

        $event->update([
            'dateStart'  => $request->dateStart . ' ' . $request->timeStart .':00'
        ]);
        $user->notify(new EventWasCreated($event));
        flash()->success('<i class="fa fa-chevron-circle-down fa-1x" aria-hidden="true"></i> ' . trans('web.flash_saved'));
        return redirect($user->id.'/'. $user->slug . '/akcie/admin');
    }


    public function update(SaveEventRequest $request, Event $event, UploadFile $uploadFile)
    {
        $this->authorize('update', $event);
        $event->update($request->all());

        $event->update([
            'dateStart'  => $request->dateStart . ' ' . $request->timeStart .':00',
            'record'  => $request->has('record') ? 1 : 0
        ]);

        // marek class
//        $fileService = new \App\Services\FileService();
//        $fileService->storeFile(request('picture'), $event);
        //$fileService->storeFile(request('appendFile'), $event, false);






        if(request('picture')) {
            $uploadFile->saveFile(request('picture'),$event);
        }

        $uploadFile->saveAppendFile($event);

        flash()->success('<i class="fa fa-chevron-circle-down fa-1x" aria-hidden="true"></i> ' . trans('web.flash_saved') );
        // return redirect($user->id .'/' . $user->slug .  '/akcie/admin');
        return redirect(route('akcie.admin', [$event->user->id, $event->user->slug]));
    }



    public function destroy(Event $event)
    {
        $this->authorize('update', $event);
        $event->delete();

        //Vymazať adresar so súborom
        if(is_dir(storage_path('app/public/events/' . $event->id))) {
            rmDirectory(storage_path('app/public/events/' . $event->id));
        }

        flash()->success(trans('web.events_deleted'));
        return back();
    }




}
