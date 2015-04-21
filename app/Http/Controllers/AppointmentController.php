<?php

namespace App\Http\Controllers;

use Request,
    DB,
    Auth,
    Input,
    View,
    App\Appointment,
    Redirect,  App\Notification,
    App\User;

class AppointmentController extends Controller {
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

    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function index() {
        $appointments = Appointment::all();

        return view('appointment.index')
                        ->with('appointments', $appointments);
    }

    public function create() {
        if (Request::isMethod('post')) {
            $appointment = Appointment::create(Input::all());
            $students = User::where('role', 'student')->where('project_id', $appointment->project_id)->get();
         
            foreach ($students as $student):
                $this->notification('appointment', 'แจ้งเตือนนัดหมาย ' . $appointment->title, $student->id);
            endforeach;

            return Redirect::back()->with('success', 'เพิ่มนัหมายเรียบร้อย');
        } else {
            $project = DB::table('project')->lists('name', 'id');

            return view('appointment.create')->with('project', $project);
        }
    }

    public function edit($id) {
        $appointment = Appointment::find($id);
        $project = DB::table('project')->lists('name', 'id');

        // ddd($appointment);
        return view('appointment.edit')
                        ->with('appointment', $appointment)
                        ->with('project', $project);
    }

    public function update() {
        // ddd(Input::all());
        $appointments = Appointment::with('project.student')->find(Input::get('id'));
//        ddd($appointments->project->student[0]->id);
            if(Input::get('approve') == 0):
               
            endif;
        $appointments->update(Input::all()); 
//        ddd($appointments->approve);
        if($appointments->approve == 'เข้าพบได้'):
            
            foreach ($appointments->project->student as $student):
                $this->notification('appointment', 'สามารถเข้าพบอาจารย์'.Auth::user()->first_name.' ได้'
                        , $student->id,'สถานที่นัดพบ '.$appointments->location.
                        ' เวลา '.$appointments->due_date.' รายละเอียดเพิ่มเติม :'.$appointments->detail);
            
                endforeach;
        endif;
        
        return Redirect::back()->with('success', 'การแก้ไขเสร็จเรียบร้อย');
    }

    public function delete($id) {
        $appointments = Appointment::find($id);
        $appointments->delete();
        return View::make('appointment.edit')->with('warning', 'การลบเสร็จเรียบร้อย');
    }
    public function postponse(){
        if(Request::isMethod('post')):
            $postponse = \App\Postponse::create(Input::all());
            foreach ($postponse->appointment->project->student as $student):
        $this->notification('postponse','เลื่อนการนัดหมาย', $student->id,'เลื่อนไปเป็นวันที่ '.
        $this->DateThai($postponse->timetogo).' สถานที่ '.$postponse->location.' เพราะ '.$postponse->reason);
            endforeach;
            return redirect()->back()->with('success','แจ้งเตือนไปยังสมาชิกในกลุ่มแล้ว');
        endif;
        
        return view('appointment.postponse');
    }
}
