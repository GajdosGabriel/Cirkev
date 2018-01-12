<?php
//
namespace App\Http\Controllers;

use App\Notifications\UserUpdate;
use App\Events\User\NewRegistrationEmail;
use App\Repositories\UserRepository;
use App\Services\UploadFile;
use App\User;
use Config;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Notifications\Notifiable;
use App\Http\Requests;
use Session;

class UserController extends Controller
{
    use Notifiable;

    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->middleware('auth')->except(['index', 'show', 'knowUser', 'setLanguage','verifyUserAccount']);
    }

    public function index ()
    {
        return view('user.index')
            ->with('title', trans('web.user_all'))
            ->with('users' , $this->userRepository->getAll());
    }

    public function show ($id, $slug)
    {
        $user = $this->userRepository->getUser($id,$slug);
        return view('user.show')->with('user', $user);
    }

    public function edit ($id, $slug) {
        return view('user.edit')
            ->with('title', trans('web.user_profile_title'))
            ->with('user', $this->userRepository->getUser($id, $slug));
    }




    public function update (User $user, $slug, Request $request, UploadFile $uploadFile, \App\Services\UserToken $userToken)
    {
        $this->validate($request, [
            'profile_desc' => 'max:100',
            'email' => 'required|email|max:255',
            'firstName' => 'required|min:2',
            'lastName' => 'required|min:2'
        ]);

        // Update Users tbl
        $user->update($request->all());

        $userToken->checkIfEmailExist($user->email);

        $uploadFile->saveFile(request('avatar'),$user);

        $user->notify(new UserUpdate ($user));
        flash()->success(trans('web.user_profile_updated'));
        return redirect( route('user.edit',[$user->id, $user->slug]) );
    }

    public function knowUser(User $user) {
        $user->increment('knowHim');

        Session::put($user->slug, $user->slug );
        return back();
    }


//    public function indexNotifications() {
//
//        return auth()->user()->unreadNotifications;
//    }


    public function destroyNotifications($user, $notificationId) {

        auth()->user()->notifications()->findOrFail($notificationId)->markAsRead();

        return back();

    }

    public function verifyUserAccount($id, $slug)
    {
        $user = $this->userRepository->getUser($id,$slug);
        $user->update(['verified' => 1]);

        // Darček, knihy na stiahnutie
        \Event::fire(new NewRegistrationEmail($user));

        flash()->success(trans('web.user_profile_updated'));
        return redirect('/');
    }


    public function setLanguage($lang)
    {
      if( array_key_exists( $lang, Config::get('language')) )
      {
          Session::put('applocal', $lang);
      }
        return back();
    }










}
