<?php

namespace App\Http\Controllers;

use Request,
    DB,
    Auth,
    Input,
    View,
    App\Project,
    Redirect,
    \App\Notification,
    App\User,
    App\Activity;

class ProjectController extends Controller {
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
	public function __construct()
	{
		 $this->middleware('auth');
	}
    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function index() {
//        ddd(Auth::user()->project_id);
        if(Auth::user()->role == 'student'){
              $projects = Project::with('coadviser')->where('id',Auth::user()->project_id)->get();
        }elseif(Auth::user()->role == 'adviser'){
            
            $projects = Project::with('student')
                    ->where('primary_adviser_id',Auth::user()->id)
                    ->whereOr('secondary_adviser_id',Auth::user()->id)->get();

        }else{
              $projects = Project::with('coadviser')->get();
        }
      
        return view('project.index')->with('projects', $projects);
    }

    function gantt($id) {
        return view('project.ganttdata')->with('id', $id);
    }

    function ganttdata($id) {
        $activity = Activity::with('task')->where('project_id', $id)->get();


        foreach ($activity as $key => $activity):
            $data[$key]['id'] = $activity->id;
            $data[$key]['name'] = $activity->name;
            foreach ($activity->task as $key2 => $task):

                $data[$key]['series'][$key2]['name'] = $task->name;
                $data[$key]['series'][$key2]['start'] = date('F d, Y H:i:s', strtotime($task->start_time));
                $data[$key]['series'][$key2]['end'] = date('F d, Y H:i:s', strtotime($task->stop_time));
            endforeach;
        endforeach;
        return \Response::json($data);
    }

    public function create() {
        if (Request::isMethod('post')) {
            // ddd(Input::all());
            $project = Project::create(Input::all());
           
            if (Input::has('student')):
                $student = User::whereIn('id', Input::get('student'));
                $student->update(['project_id' => $project->id]);
             
                foreach (Input::get('student') as $user): //วนลูปสร้างการแจ้งเตือน
                 $this->notification('project','คุณได้ถูกเพิ่มเข้าสู่โปรเจค' . $project->name,$user);
                endforeach;
            endif;
            if (Input::has('secondary_adviser_id')):
                $adviser = User::find(Input::get('secondary_adviser_id'));
                $adviser->update(['project_id' => $project->id]);
                $this->notification('project','คุณได้ถูกตั้งให้เป็นที่ปรึกษาร่วมู่โปรเจค' . $project->name,Input::has('secondary_adviser_id'));
            endif;
            return Redirect::route('project.index')->with('success', 'เพิ่มโปรเจคสำเร็จ');
        } else {
            $students = User::where('role', 'student')->whereNotNull('project_id')->get();

            $dropdown = '';
            foreach ($students as $key => $student) {

                $dropdown .= "<option value='$student->id'>" . $student->first_name . "</option>";
            }
            return view('project.create')->with('dropdown', $dropdown);
        }
    }

    public function edit($id) {
        $projects = Project::find($id);
        $students = User::where('role', 'student')->whereNotNull('project_id')->get();

        $dropdown = '';
        foreach ($students as $key => $student) {
            if ($projects->id == $student->project_id) {
                $dropdown .= "<option  selected='selected' value='$student->id'>" . $student->first_name . "</option>";
            } else {
                $dropdown .= "<option value='$student->id'>" . $student->first_name . "</option>";
            }
        }
        // ddd($dropdown);
        return view('project.edit')->with('projects', $projects)->with('dropdown', $dropdown);
    }

    public function update() {

        $projects = Project::find(Input::get('id'));

        DB::table('users')->where('project_id', Input::get('id'))
                ->update(['project_id' => 0]); // เปลี่ยนข้อมูลกลับก่อน
//        ddd(DB::getQueryLog());
        User::where('id', Input::get('secondary_adviser_id'))->update(['project_id' => $projects->id]);
        if(Input::has('student')):
             foreach (Input::get('student') as $key => $student) { // แล้วค่อยอัพเดทข้อมูลใหม่
            User::where('id', $student)->update(['project_id' => $projects->id]);
        }
        endif;
       
//        ddd(Input::all());
        $projects->update(Input::all());
        return Redirect::back()->with('success', 'การแก้ไขเสร็จเรียบร้อย');
    }

    public function delete($id) {
        $projects = Project::find($id)->delete();
        return redirect()->back()->with('warning', 'การลบเสร็จเรียบร้อย');
    }

}
