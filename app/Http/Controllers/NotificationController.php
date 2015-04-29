<?php namespace App\Http\Controllers;
use Request,DB,Auth,
    Input,View,
    Redirect,App\Notification,
    App\User;
class NotificationController extends Controller {

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
	public function __construct()
	{
		// $this->middleware('guest');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
            
                
            if(Input::has('status')){
                if(Input::get('status') == 0){
                    $notification = Notification::Where('reciver_id',Auth::user()->id)->orWhere('is_read',0)->get();
                
                }else if(Input::get('status') == 1){
                    $notification = Notification::Where('reciver_id',Auth::user()->id)->orWhere('is_read',1)->get();
                }else if(Input::get('status') == 2){
                    $notification = Notification::where('sender_id',Auth::user()->id)->get();
            
                } 
            }$notification = Notification::where('reciver_id',Auth::user()->id)->get();
         return view('notification.index')->with('notification',$notification);
	}
        
        public  function markasread($id){
            $notification = Notification::find($id);
            $notification->is_read = 1;
            $notification->save();
            return redirect()->back()->with('success','คุณอ่านข้อความหมายเลข '.$notification->id.' เรียบร้อยเเล้ว');
        }
        
        
       

}
