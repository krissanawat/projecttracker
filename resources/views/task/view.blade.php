
@extends('app')

@section('content')
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">งานย่อย
                  <div class="pull-right">

                        <a  href="{{ route('task.getcreate',['activity_id'=>Request::segment(3)])}}" target="_blank" class=" btn btn-success">
                            <span class="glyphicon glyphicon-plus"></span> เพิ่ม</a>
                    </div>
                </div>

                <div class="panel-body">
                    <table class="table table-bordered">
                        <thead>
                        <th> ชื่อ</th><th>วันที่เริ่ม</th><th> กำหนดเสร็จ</th>
                        <th>วันที่เสร็จจริง</th><th>สถานะ</th><th>ให้ทำได้</th>
                        <th>จำนวนชั่วโมง</th>
                        
                        </thead>
                        <tbody>
                            @foreach($tasks as $task)
                            <tr>
                            <td>{!! $task->name !!}</td>
                             <td>{!! $task->start_time !!}</td>
                              <td>{!! $task->stop_time !!}</td>
                                <td>{!! $task->completed_at !!}</td>
                                   @if(Auth::user()->role == 'student' && $task->status == 'approve')
                  <td>{!! Form::select('status',['ยังไม่เริ่มทำ'=>'ยังไม่เริ่มทำ','รองานอื่น'=>'รองานอื่น','กำลังทำ'=>'กำลังทำ','ไม่เสร็จ'=>'ไม่เสร็จ',],
                         $task->status,['data'=>$task->id,'class'=>'form-control status']) !!}</td>
                                     @else
                                         <td>{!! $task->status !!}</td>
                                     @endif
                                       @if(Auth::user()->role == 'adviser') 
                                             <td>{!! Form::select('approve',['อนุมัติ'=>'อนุมัติ','ไม่อนุมัติ'=>'ไม่อนุมัติ','รอ'=>'รอ'],$task->approve,['data'=>$task->id,'class'=>'form-control approve']) !!}</td>
                                         @else
                                          <td>{!! $task->approve !!}</td>
                                         @endif
                                          <td>{!! $task->timefortask !!}</td>
                              </tr>
                            @endforeach()
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>


@stop()
@section('specific_script')
<script>
    $('.status').change(function(){
         $.blockUI({ message: '<h2><img src="/img/status-loading.gif" /> รอสักครู่...</h2>' });
      var id = $(this).attr('data');
      var val = $(this).val();
      $.ajax({
         method :'get',
         url :"{!! route('change_task_status') !!}",
         data :{id:id,status:val},
         success:function(data){
             $.unblockUI();
         }
      });
    });
     $('.approve').change(function(){
         $.blockUI({ message: '<h2><img src="/img/status-loading.gif" /> รอสักครู่...</h2>' });
      var id = $(this).attr('data');
      var val = $(this).val();
      $.ajax({
         method :'get',
         url :"{!! route('change_approve_status') !!}",
         data :{id:id,status:val},
         success:function(data){
             $.unblockUI();
         }
      });
    });
</script>

@stop