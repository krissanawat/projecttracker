<?php

namespace App\Http\Controllers;

use App\Task,
    Input,Request,
    App\Responsible,
    Redirect;

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
    public function addstatus(){
       $task = new \App\Task_status;
       $task->status = Request::get('status');
       $task->task_id = Request::get('id');
       $task->save();
       return redirect()->back()->with('success','เพิ่มสถานะเรียบร้อย');
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

    public function getCreate() {
        return view('task.create');
    }

    public function change_task_status() {
        $activity = Task::find(Input::get('id'));
        $activity->update(['status' => Input::get('status')]);
    }

    public function change_approve_status() {
        $activity = Task::find(Input::get('id'));
        $activity->update(['approve' => Input::get('status')]);
    }

    public function postCreate() {
        $user = \App\User::find(Input::get('responsible'));
        $task = new Task;
//        ddd(Input::all());
        $task->start_time = \DateTime::createFromFormat('Y-m-d',Input::get('start_time'));
        $task->stop_time = \DateTime::createFromFormat('Y-m-d',Input::get('stop_time'));
        $datediff = $task->start_time->diff($task->stop_time);
        $task->timefortask = $datediff->days * $user->working_time;
                // อัพเดทวันล่าสุดของ activity
                $activity = \App\Activity::find(Input::get('activity_id'));
        $activity->update(['stop_time' => $task->stop_time]);
        $task->name = Input::get('name');
        $task->item_of_task = Input::get('item_of_task');
        $task->activity_id = Input::get('activity_id');
        $task->approve = Input::get('approve');
        $task->save();
        Responsible::create(['task_id' => $task->id, 'responsible' => Input::get('responsible')]);


        // d('1');
        return Redirect::route('task.view', Input::get('activity_id'))->with('success', 'การเพิ่มข้อมูลสำเร็จ');
// 
    }

}
