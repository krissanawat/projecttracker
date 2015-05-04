@extends('app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">โปรเจค
                    <div class="pull-right">
                        @if(Auth::user()->role == 'adviser')
                        <a href="{{ route('project.create') }}" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-save"></span> เพิ่มข้อมูล</a>
                        @endif
                    </div>
                </div>

                <div class="panel-body">
                    <div class="span7">   
                        <div class="widget stacked widget-table action-table">

                            <div class="widget-header">
                                <i class="icon-th-list"></i>
                                <h3>โปรเจคทั้งหมด</h3>
                            </div> <!-- /widget-header -->

                            <div class="widget-content">

                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ชื่อ</th>
                                            <th>ที่ปรึกษาร่วม</th>
                                            <th>รายละเอียด</th>
                                           
                                            <th>วันที่เริ่ม</th>
                                            <th>วันที่สิ้นสุด</th>
                                            <th>จัดการ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($projects)
                                        @foreach($projects as $key => $project)
                                        <tr>
                                            <td>{!! $project->name !!}</td>
                                            <td> @if($project->coadviser->count() != 0) 
                                                {!! $project->coadviser[0]->first_name  !!}
                                                @endif
                                            </td>
                                            <td><a href="#" data-toggle="modal" data-target="#detail{!! $project->id !!}" class="btn btn-success" id="openBtn">ดูรายละเอียด</a></td>
                                            <td>{!! $project->start !!}</td>
                                            <td>{!! $project->finish !!}</td>
                                            <td>
                                               <a target="_blank" href="{{ route('project.gantt',$project->id)}}" class="btn btn-primary"><span class="glyphicon glyphicon-tasks"></span> ดู Gantt Chartt</a>
                                                  <a target="_blank" href="{{ route('activity.getcreate',['id'=>$project->id])}}" class="btn btn-primary"><span class="glyphicon glyphicon-tasks"></span>เพิ่ม activity</a>
                                               
                                                <a href="{{ route('project.edit',$project->id)}}" class="btn btn-warning"><span class="glyphicon glyphicon-pencil"></span> แก้ไข</a>
                                                <a  href="#myModal" data-url="{{ route('project.delete',['id'=>$project->id])}}" data-toggle="modal" data-target="#myModal" class="remove btn btn-danger"><span class="glyphicon glyphicon-trash"></span> ลบ</a>
                                            </td>
                                        </tr>
                                    <div id="detail{!! $project->id !!}" class="modal fade">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title">รายละเอียด</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p>{!! $project->detail !!}</p>
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
