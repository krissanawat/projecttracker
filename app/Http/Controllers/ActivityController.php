<?php

namespace App\Http\Controllers;

use DB,
    Input,
    App\Activity,
    App\Task,
    App\User,
    App\Responsible,
    Auth,
    Redirect;

class ActivityController extends Controller {
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
    public function index() {
        if (Auth::user()->role == 'admin') {
            $activity = Activity::all();
        } else if (Auth::user()->role == 'advser') {
            $activity = Activity::where('project_id', \Auth::user()->project_id)->get();
        } else {
            $activity = DB::table('activity')->where('user_id', Auth::user()->id)
                            ->where('project_id', \Auth::user()->project_id)->get();
        }

        return view('activity.index')->with('activitys', $activity);
    }

  

    public function getCreate($id) {
        if (empty(Auth::user()->project_id)) {
            return redirect()->back()->with('danger', 'คุณยังไม่มีโปรเจค');
        } else {

            return view('activity.create')->with('project_id', $id);
        }
    }

    public function postCreate() {
//         ddd(Input::all());
//      ddd(Input::all());

        $Activity = new Activity;
        $Activity->name = Input::get('activity_name');
        $Activity->start_time = \DateTime::createFromFormat('Y-m-d',Input::get('task_start'));
        $Activity->stop_time = \DateTime::createFromFormat('Y-m-d', Input::get('task_finish'));
        $Activity->project_id = Input::get('project_id');
        $Activity->user_id = Auth::user()->id;
        $Activity->save();

        $task = new Task;
        $task->name = Input::get('task_name');
        $task->item_of_task = Input::get('item_of_task');
         $task->start_time = \DateTime::createFromFormat('Y-m-d',Input::get('task_start'));
        $task->stop_time =  \DateTime::createFromFormat('Y-m-d', Input::get('task_finish'));
        $task->activity_id = Input::get('activity_id');
        $task->approve = Input::get('approve');
        $task->save();
        if (!empty(Input::get('dependent_on'))) {
            foreach (Input::get('dependent_on') as $dependent_on) {
                Responsible::create(['task_id' => $task->id, 'dependent_on' => $dependent_on]);
            }
        }

        return Redirect::route('activity.index')->with('success', 'เพิ่มข้อมูลสำเร็จ');
    }

    public function edit($id) {
        $activity = Activity::find($id);
        $students = User::where('role', 'student')->where('project_id', $activity->project_id)->get();

        $dropdown = '';
        foreach ($students as $key => $student) {
            if ($activity->project_id == $student->project_id) {
                $dropdown .= "<option  selected='selected' value='$student->id'>" . $student->first_name . "</option>";
            } else {
                $dropdown .= "<option value='$student->id'>" . $student->first_name . "</option>";
            }
        }
        // ddd($dropdown);
        return view('activity.edit')->with('activity', $activity)->with('dropdown', $dropdown);
    }

    public function update() {
        // ddd(Input::all());
        $activity = Activity::find(Input::get('id'));
        $activity->update(Input::all());
        return Redirect::back()->with('success', 'การแก้ไขเสร็จเรียบร้อย');
    }

    public function delete($id) {
        $activity = Activity::with('task')->find($id);
        if ($activity->task->count() == 0) {
            $activity->delete();
            return redirect()->back()->with('success', 'ลบเรียบร้อย');
        } else {
            return redirect()->back()->with('danger', 'ยังลบไม่ได้เนื่องจากมี task ที่เกี่ยวข้องอยู่');
        }
    }

}
