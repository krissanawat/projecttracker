@extends('app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">การนัดหมาย
                    <div class="pull-right">
                        <a href="{{ route('appointment.create') }}" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-save"></span> เพิ่มข้อมูล</a>
                    </div>
                </div>

                <div class="panel-body">
                    <div class="span7">   
                        <div class="widget stacked widget-table action-table">


                            <div class="widget-content">

                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>หัวข้อ</th>
                                            <th>รายละเอียด</th>
                                            <th>นัดกับ</th>
                                            <th>สถายที่</th>
                                            <th>วันที่</th>
                                            <th>สถานะ</th>
                                            <th>จัดการ</th>
                                        </tr>
                                    </thead>
                                    <tbody> 
                                        @if($appointments)


                                        @foreach($appointments as $key => $appointment)
                                        <tr  class="clickable" id="row1" data-target=".row{!!$key!!}" data-toggle="collapse">
                                            <td>{!! $appointment->title !!}</td>
                                            <td>
                                                <a data-toggle="modal" 
                                                   data-target="#modal{!! $key !!}" class="remove btn btn-success">
                                                    <span class="glyphicon glyphicon-plus"></span> ดูรายละเอียด</a>
                                            </td>
                                            @if(Auth::user()->role == 'student')
                                            <td>อาจารย์ {!! $appointment->adviser->first_name !!}</td>
                                            @else

                                            <td>{!! $appointment->project->name !!}</td>
                                            @endif
                                            <td>{!! $appointment->location !!}</td>
                                            <td>{!! $appointment->due_date !!}</td>
                                            @if(Auth::user()->role == 'student')
                                            <td>{!! $appointment->approve !!}</td>
                                            @elseif(Auth::user()->role == 'adviser')
                                            <td>{!! $appointment->status !!}</td>
                                            @else
                                            <td>{!! $appointment->status !!}</td>
                                            <std>{!! $appointment->approve !!}</td>
                                            @endif
                                            <td>

                                                <a  target="_blank" href="{{ route('appointment.postponse',['id'=>$appointment->id])}}" 
                                                    class="btn btn-primary"><span class="glyphicon glyphicon-alert"></span> เลือนนัด</a>

                                                @if(Auth::user()->role == 'admin')
                                                <a href="{{ route('appointment.edit',$appointment->id)}}" class="btn btn-warning"><span class="glyphicon glyphicon-pencil"></span> แก้ไข</a>
                                                <a  href="#myModal" data-url="{{ route('appointment.delete',$appointment->id)}}" data-toggle="modal" data-target="#myModal" class="remove btn btn-danger"><span class="glyphicon glyphicon-trash"></span> ลบ</a>
                                                @endif
                                            </td>
                                        </tr>
                                    <div id="modal{!! $key !!}" class="modal fade">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title"></h4>

                                                </div>
                                                <div class="modal-body">
                                                    {!! $appointment->detail !!}
                                                </div>

                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
                                    @endforeach
                                    @endif

                                    </tbody>
                                </table>

                            </div> <!-- /widget-content -->

                        </div> <!-- /widget -->
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
