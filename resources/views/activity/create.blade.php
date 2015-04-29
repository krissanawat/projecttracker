@extends('app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">เพิ่มข้อมูล Activity


                </div>

                <div class="panel-body">
            {!! Form::open(['route'=>'activity.postcreate','class'=>'form-horizontal']) !!}
   
                        <fieldset>
                              <div class="form-group">
                                <label class="col-md-4 control-label" for="name">โปรเจค</label>  
                                <div class="col-md-3">
                               
@if(Auth::user()->role == 'student')
{!! Form::hidden('project_id',Auth::user()->project_id) !!}
<?php $project = App\Project::find(Auth::user()->project_id)->get(); ?>
<input id="name"  type="text" date-start='{!! $project[0]->start !!}' date-finish='{!! $project[0]->finish !!}' value="{!! $project[0]->name !!}"  id="project" class="form-control input-md" readonly >
@else 
 <?php $user = App\Project::where('id',Auth::user()->project_id)->lists('name','id') ?>
                                   {!! Form::select('project_id',$user,Request::segment('3'),['class'=>'form-control required chosen','id'=>'project']) !!}
 @endif                               
                                </div>
                               
                            </div>
                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="name">Activity</label>  
                                <div class="col-md-6">
                                    <input id="name" name="name" type="text"  class="form-control input-md">

                                </div>
                               
                            </div>

                          
                     <div class="form-group">
                                <label class="col-md-4 control-label" for="name">Task แรก</label>  
                                <div class="col-md-6">
                                    <input id="name" name="name" type="text"  class="form-control input-md">

                                </div>
                               
                            </div>
<div class="form-group">
                              
                                 <label class="col-md-4 control-label" for="name">คาดการช่วงเวลาที่ทำ</label>  
                                <div class="col-md-6">
                                    <input id="task_range" name="task_range" type="text"  class="form-control daterange input-md">

                                </div>
                            </div>
                    
                           <div class="form-group">
                                <label class="col-md-4 control-label" for="name">item of Task</label>  
                                <div class="col-md-3">
                                    <input id="item_of_task" name="item_of_task" type="text"  class="form-control input-md">

                                </div>
                               
                            </div>
           
                                  <div class="form-group">
                                <label class="col-md-4 control-label" for="name">ผู้รับผิดชอบ</label>  
                                <div class="col-md-3">
                                <?php $user =  App\User::where('project_id',Auth::user()->project_id)->where('role','student')->lists('first_name','id') ?>
                                   {!! Form::select('responsible',$user,'',['class'=>'form-control chosen']) !!}
                                
                                </div>
                               
                            </div>
                              <div class="form-group">
                                <label class="col-md-4 control-label" for="name">ต้องรองานอื่นไหม?</label>  
                                <div class="col-md-3">
                                <?php $user =  App\Task::where('project_id',Auth::user()->project_id)
                                ->lists('name','id') ?>
     {!! Form::select('dependent_on[]',$user,'',['class'=>'form-control chosen','multiple']) !!}
                                
                                </div>
                               
                            </div>
                            

                                
                           
                 <div class="form-group">
                              
                                 <label class="col-md-4 control-label" for="name"></label>  
                                <div class="col-md-6">
                                  {!! Form::submit('บันทึก',['class'=>'btn btn-primary']) !!}

                                </div>
                            </div>          

                        </fieldset>
                    </form>
 </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('specific_script')
<script type="text/javascript">
    // $('.daterangepicker1').daterangepicker();
$("#appoint_group").chosen();
//$('#project').select(function(){
//    var val = $(this).val();
//    $.get({})
// 
//})
@if(Auth::user()->role == 'student')
   var date_start = $('#project').attr('date-start');
    var date_finish = $('#project').attr('date-finish');
   $('.daterange').daterangepicker({ minDate: date_start, maxDate: date_finish });
   @endif
</script>

@stop