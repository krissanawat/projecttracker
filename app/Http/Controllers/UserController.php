<?php

namespace App\Http\Controllers;

use Request,
    Input,
    Storage,
    File,
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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function profile() {

        return view('user.profile');
    }

    public function update_profile() {
        $user = User::find(Auth::user()->id);
        // ddd(Input::all());
        if (Input::hasFile('profile')):
            $file = Input::file('profile');
            $extension = $file->getClientOriginalExtension();
            $filename = str_random('10') . '.' . $extension;
            Storage::disk('local')->put($filename, File::get($file));
            $user->profile_image = $filename;
        endif;

        $user->working_time = Input::get('working_time');
        $user->non_working_time = Input::get('non_working_time');
        $user->save();
        return Redirect::back()->with('success', 'แก้ไขข้อมูลเรียบร้อย');
    }

    /**
     * Show the application welcome screen to the user.
     *
     * @return Response
     */
    public function dashboard() {
        if (Auth::user()) {
            return view('dashboard');
        } else {
            return redirect()->route('getlogin');
        }
    }

    public function register() {
        if (Request::isMethod('post')) {
            $user = User::create(Input::all());
            $user->activated = 0;
            $comfirmcode = \Hash::make($user->password);
            $user->comfirmcode = $comfirmcode;
            $user->update();
            $data = ['id' => $user->id, 'first_name' => $user->first_name, 'comfirmcode' => $comfirmcode];
            \Mail::send('emails.confirm', $data, function($message) use ($user) {
                $message->to($user->email, $user->first_name)->subject('ยืนยันการสมัครสมาชิก!');
            });
            return Redirect::route('getlogin')->with('success', 'กรุณายืนยันตัวเอง ผ่านทางอีเมล์ที่ส่งไปก่อนครับ');
        } else {
            return view('auth.register');
        }
    }

    function activate() {
        $user = User::find(Input::get('id'));
        if (strcmp($user->comfirmcode, Input::get('hash')) == 0) {
            $user->activated = 1;
            $user->comfirmcode = '';
            $user->update();
            return redirect()->route('getlogin')->with('success', 'คุณสามารถเ้ขาสู่ระบบได้เเล้ว');
        } else {
            return redirect()->route('getlogin')->with('danger', 'ไม่สามรถตรวจสอบรหัสได้ โปรดติดต่อ แอดมิน');
        }
    }

    public function getlogin() {

        return view('auth.login');
    }

    public function postlogin(){
            $user = User::where('email',Input::get('email'))->get();
            
        if ($user[0]->activated == 1) {
            if (Auth::attempt(['email' => Input::get('email'), 'password' => Input::get('password')])) {


                return Redirect::route('dashboard');
            } else {
                return Redirect::back();
            }

            
        }else{
            return Redirect::back()->with('danger', 'คุณยังไม่ได้ยืนยันตัวเองผ่านอีเมล์')->with('sendemailagain',$user[0]->id);
        }
    }
    function sendemailagain($id){
        $user = User::find($id);
          $data = ['id' => $user->id, 'first_name' => $user->first_name, 'comfirmcode' => $comfirmcode];
            \Mail::send('emails.confirm', $data, function($message) use ($user) {
                $message->to($user->email, $user->first_name)->subject('ยืนยันการสมัครสมาชิก อีกครั้ง!');
            });
            return Redirect::route('getlogin')->with('success', 'กรุณายืนยันตัวเอง ผ่านทางอีเมล์ที่ส่งไปก่อนครับ');
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('getlogin')->with('success', 'ออกจากระบบเรียบร้อย');
    }

}
