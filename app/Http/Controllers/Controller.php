<?php namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Notification,Auth,Mail;
abstract class Controller extends BaseController {

	use DispatchesCommands, ValidatesRequests;
    
public function notification($type,$subject,$reciver_id){
 					$notification = new Notification;
                    $notification->sender_id = Auth::user()->id;
                    $notification->type = $type;
                    $notification->subject = $subject;
                    $notification->reciver_id = $reciver_id;
                    $notification->save();

//                       Mail::queue('emails.confirm', $data, function($message)
// 					    {
// 					        $message->to('taqmaninw@gmail.com', 'John Smith')->subject('Welcome!');
// 					    });
}
       				
}
