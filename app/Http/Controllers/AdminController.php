<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class AdminController extends Controller
{

    /**
     * @return $this
     */
    public function indexUsers() {
//        $users = User::orderBy('id','desc')->get();
//        return view('admin.index')->with('users', $users);

        $users = User::latest();

        if(request('firstName')) {
            $users->orderBy('firstName', 'asc');
        }

        $users = $users->get();



        return view('admin.index')->with('users', $users);
    }

    public function newsConfirmed ($id) {
        $user = User::findOrFail($id);

        if($user->send_email == 1) {
            $user->update(['send_email' => 0]);
        } else {
            $user->update(['send_email' => 1]);
        }

        return redirect('kategorie');

    }


    public function adminUpdateUser (Request $request, $id) {


        $user = User::findOrFail($id);
        $chks = array( 'send_email','frontAuthor','locked');
        foreach ($chks as $chk) {
            $user->setAttribute($chk, ($request->has($chk)) ? true : false);
        }
            $user->update([
                'send_email' => $request->input('send_email'),
                'frontAuthor' => $request->input('frontAuthor'),
                'email' => $request->input('email'),
                'locked' => $request->input('locked')
            ]);

        flash()->success('Uspešné aktualizované');


        return back();

    }






}
