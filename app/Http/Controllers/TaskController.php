<?php

namespace App\Http\Controllers;
use App\Task,Input,App\Responsible,Redirect;
class TaskController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Home Controller
      |--------------------------------------------------------------------------
      |
      | This controller renders your application's "dashboard" for users that
      | are authenticated. Of course, you are free to change or remove the
      | controller as you wish. It is just here to get your app started!
      |
     */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function view($id) {
         $tasks = Task::where('activity_id', $id)->get();
        
        return view('task.view')->with('tasks', $tasks);
    }
    public function getCreate(){
      return view('task.create');
    }
 public function postCreate(){
   
     $task = new Task;
     $task_range = explode('-',Input::get('task_range'));
     $task->start_time = date( 'Y-m-d H:i:s',strtotime($task_range[0]));
     $task->stop_time = date( 'Y-m-d H:i:s',strtotime($task_range[1]));
     $task->name = Input::get('name');
      $task->item_of_task = Input::get('item_of_task');
       $task->activity_id = Input::get('activity_id');
         $task->approve = Input::get('approve');
       $task->save();
       if(!empty(Input::get('dependent_on'))){
        foreach(Input::get('dependent_on') as $dependent_on){
             Responsible::create(['task_id'=>$task->id,'dependent_on'=>$dependent_on]);
        }
       }
       // d('1');
      return Redirect::back()->with('success','การเพิ่มข้อมูลสำเร็จ');
// 

    }
}
