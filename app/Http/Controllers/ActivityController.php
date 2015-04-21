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

    public function getCreate($id){
      
      return view('activity.create')->with('project_id',$id);
    }
    public function postCreate() {
      // ddd(Input::all());/
        if (Input::has('activity_range')):

            $range = explode('-', Input::get('activity_range'));

            $start = date_format(date_create($range[0]), 'Y-m-d H:i:s');
            $stop = date_format(date_create($range[1]), 'Y-m-d H:i:s');
        endif;
        $Activity = new Activity;
        $Activity->name = Input::get('name');
        $Activity->start_time = $start;
        $Activity->stop_time = $stop;
        $Activity->project_id = Input::get('project_id');
        $Activity->save();

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

        return Redirect::route('activity.index')->with('success', 'เพิ่มข้อมูลสำเร็จ');
    }
 public function edit($id){
        $activity = Activity::find($id);
        $students = User::where('role','student')->where('project_id',$activity->project_id)->get();
        
        $dropdown = '';
        foreach ($students as $key => $student) {
          if($activity->project_id == $student->project_id){
          $dropdown .= "<option  selected='selected' value='$student->id'>".$student->first_name."</option>";
          }else{
            $dropdown .= "<option value='$student->id'>".$student->first_name."</option>"; 
          }
         
        }
        // ddd($dropdown);
        return view('activity.edit')->with('activity',$activity)->with('dropdown',$dropdown);
    }
    public function update(){
       // ddd(Input::all());
        $activity = Activity::find(Input::get('id'));
        $activity->update(Input::all());
        return Redirect::back()->with('success','การแก้ไขเสร็จเรียบร้อย');
    }

  
    public function delete($id){
      $activity = Activity::with('task')->find($id);
      if($activity->task->count() == 0){
           $activity->delete();
            return redirect()->back()->with('success','ลบเรียบร้อย');
      }else{
             return redirect()->back()->with('danger','ยังลบไม่ได้เนื่องจากมี task ที่เกี่ยวข้องอยู่');
      }
     

     
    }

}
