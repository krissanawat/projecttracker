<?php

namespace App\Http\Controllers;

use Request,
    Input,Storage,File,
    App\User,
    Redirect,
    Auth;

class UserController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Welcome Controller
      |--------------------------------------------------------------------------
      |
      | This controller renders the "marketing page" for the application and
      | is configured to only allow guests. Like most of the other sample
      | controllers, you are free to modify or remove it as you desire.
      |
     */
public function __construct()
	{
		 $this->middleware('auth');
	}
  

    /**
     * Create a new controller instance.
     *
     * @return void
     */
public function profile(){

    return view('user.profile');
}

public function update_profile(){
    $user = User::find(Auth::user()->id);
    // ddd(Input::all());
    if(Input::hasFile('profile')):
        $file = Input::file('profile');
        $extension = $file->getClientOriginalExtension();
        $filename = str_random('10').'.'.$extension;
        Storage::disk('local')->put($filename,  File::get($file));
        $user->profile_image = $filename;
   endif;
        
        $user->start_working_time = Input::get('start_working_time');
        $user->stop_working_time = Input::get('stop_working_time');
        $user->start_rest_time = Input::get('start_rest_time');
        $user->stop_rest_time = Input::get('stop_rest_time');
        $user->save();
    return Redirect::back()->with('success','แก้ไขข้อมูลเรียบร้อย');
}
    /**
     * Show the application welcome screen to the user.
     *
     * @return Response
     */
    public function dashboard() {
        return view('dashboard');
    }

    public function register() {
       if (Request::isMethod('post')) {
           User::create(Input::all());
           return Redirect::route('login');
       } else {
            return view('auth.register');
       }
    }

    public function getlogin() {

        return view('auth.login');
    }

    public function postlogin() {

        if (Auth::attempt(['email' => Input::get('email'), 'password' => Input::get('password')])) {
            return Redirect::route('dashboard');
        } else {
            return Redirect::back();
        }
    }
    public function logout(){
        Auth::logout();
        Redirect::route('getlogin')->with('success','ออกจากระบบเรียบร้อย');
    }

}
