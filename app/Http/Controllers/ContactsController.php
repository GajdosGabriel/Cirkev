<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    public function import(User $user){
        return view('user.emails')->with('user', $user);
    }

    public function store(User $user, Request $request)
    {
        $string = trim($request->input('body'));

        // Match e-mail addresses.
        $regex = '/([A-Za-z0-9._-]+@[A-Za-z0-9._+-]+\.[A-Za-z]{2,4})/';
        preg_match_all($regex, $string, $emails);

        // Remove duplicates and formats array
        $emails = array_values(array_unique($emails[0]));

        // count insert emails
        $count = count($emails);

        // Extract names from e-mail addresses.
        foreach($emails as $email) {
            $regex = '/([A-Za-z0-9._-]+)(?=@)/';
            preg_match($regex, $email, $name);

            // If you need, then create new friend
            $user->contacts()->firstOrCreate([
                'email'   => $email,
                'user_id' => $user->id,
                'name'    => $name[0]
            ]);

        }
        flash()->success('Rozpoznaných ' . $count . ' emailov.');
        return back();

    }
}
