<?php

namespace App\Http\Controllers;

use App\Task,
    Input,
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
        $task_range = explode('-', Input::get('task_range'));
        $task->start_time = date('Y-m-d H:i:s', strtotime($task_range[0]));
        $task->stop_time = date('Y-m-d H:i:s', strtotime($task_range[1]));
        $task->timefortask = ($task->start_time - $task->stop_time) * $user->working_time;
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
