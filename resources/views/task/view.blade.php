
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
                        <th> ชื่อ</th><th>วันที่เริ่ม</th><th> กำหนดเสร็จ</th><th>วันที่เสร็จจริง</th>
                        
                        </thead>
                        <tbody>
                            @foreach($tasks as $task)
                            <tr>
                            <td>{!! $task->name !!}</td>
                             <td>{!! $task->start_time !!}</td>
                              <td>{!! $task->stop_time !!}</td>
                               <td>{!! $task->stop_time !!}</td>
                              </tr>
                            @endforeach()
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>


@stop()