<?php

namespace App\Http\Controllers;


use App\Http\Requests\SaveMessengersRequest;
use App\Messenger;
use App\Repositories\UserRepository;
use App\User;
use Illuminate\Http\Request;

class MessengerController extends Controller
{

    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function newmessage(Request $request) {

        $this->validate($request, [
            'body' => 'bail|required|min:3',
            'iamHuman' => 'required|integer|between:5,5',
        ]);

        $message = $request->input('body');

        \Mail::send('emails.contact',
            array(
                'user_message' => $message,
                'email' => 'neuvádza sa',
                'name' => 'neuvádza sa'

            ), function($message)
            {
                $message->from('admin@cirkevonline.sk');
                $message->to('gajdosgabo@gmail.com', 'Admin')
                    ->subject('Podnet z Cirkev-Online.sk');
            });

        flash()->success('Správa bola odoslaná. Ďakujeme.');
        return back();
    }


    public function contactStoreUser (SaveMessengersRequest $request, $id)
    {
        if($user = User::whereEmail(auth()->user()->email ?? request('email'))->first()) {
            \Auth::login($user);

        } else {
            $user = new User([
                'firstName' => request('name'),
                'email' => request('email'),
                'password' => bcrypt(rand(10,12)),
            ]);
            $user->save();
            \Auth::login($user);
        }

        $user->messenger()->create([
            'requested_user' => $id,
            'body' => request('body')
            ]);


//        \Mail::send('emails.contact-user',
//            array(
//                'name' => $request->get('name'),
//                'email' => $request->get('email'),
//                'user_message' => $request->get('body'),
//                'user_email' => $request->get('user-id'),
//
//            ), function($message) use ($user)
//            {
//                $message->from('admin@cirkevonline.sk', 'Cirkev-online');
//                $message->to
////                    Dočastne je to vypnuté aby som zistil či roboti to prekonajú
////                ($user->email, $user->name)->cc
//                ('gajdosgabo@gmail.com')->subject('Správa pre Cirkev-Online.sk');
//            });
        flash()->success('Správa bola odoslaná!');
        return redirect('/')->with('message', 'Správa bola odoslaná!');

    }
}
