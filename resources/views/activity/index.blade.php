@extends('app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">ตารางงาน
                    <div class="pull-right">
                        <a  href="{{ route('activity.getcreate')}}" target="_blank" class=" btn btn-success">
                            <span class="glyphicon glyphicon-plus"></span> เพิ่ม</a>
                    </div>
                </div>

                <div class="panel-body">

                    <div class="span7">   
                        <div class="widget stacked widget-table action-table">


                            <div class="widget-content">

                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ชื่อ</th>
                                            <th></th>
                                            <th>เริ่ม</th>
                                            <th>กำหนดเสร็จ</th>
                                            <th>วันที่เสร็จ</th>
                                            <th>สถานะ</th>
                                            <th>อนุญาตให้ทำ</th>
                                            <th>จัดการ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($activitys)
                                        @foreach($activitys as $key => $activity)
                                        <tr  class="clickable" id="row1" data-target=".row{!!$key!!}" data-toggle="collapse">
                                            <td>{!! $activity->name !!}</td>
                                            <td>
                                                <a  target="_blank"  href="{{ route('task.view',$activity->id)}}" class=" btn btn-success">
                                                    <span class="glyphicon glyphicon-tasks"></span>ดูงานย่อย</a>
                                            </td>

                                            <td>{!! $activity->start_time !!}</td>
                                            <td>{!! $activity->stop_time !!}</td>
                                             <td>{!! $activity->completed_at !!}</td>
                                            <td>{!! $activity->status !!}</td>
                                              <td>{!! $activity->approve !!}</td>
                                            <td>
                                                <a  target="_blank" href="{{ route('activity.edit',$activity->id)}}" class="btn btn-warning"><span class="glyphicon glyphicon-pencil"></span> แก้ไข</a>
                                                <a  href="#myModal" data-url="{{ route('activity.delete',$activity->id)}}" data-toggle="modal" data-target="#myModal" class="remove btn btn-danger"><span class="glyphicon glyphicon-trash"></span> ลบ</a>
                                            </td>
                                        </tr>
                                    <div id="modal_task" class="modal fade">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header"> 
                                                    <a type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                                                        <a href="#modal"  data-toggle="modal"  class=" btn btn-primary">
                                                            <span class="glyphicon glyphicon-plus"></span> เพิ่มงาน
                                                        </a>

                                                </div>
                                                <div id="modal-body{{$activity->id}}">
                                                </div>

                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
                                    @endforeach
                                    @endif

                                    </tbody>
                                </table>

                            </div> <!-- /widget-content -->
                            <div id="create_task" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            เพิ่ม Activity
                                        </div>
                                        {!! Form::open(['route'=>'activity.postcreate','class'=>'form-horizontal']) !!}

                                        <fieldset>
                                            <!-- Text input-->
                                            <div class="form-group">
                                                <label class="col-md-4 control-label" for="name">Activity</label>  
                                                <div class="col-md-6">
                                                    <input id="name" name="name" type="text"  class="form-control input-md">

                                                </div>

                                            </div>
                                            <div class="form-group">

                                                <label class="col-md-4 control-label" for="name">คาดการช่วงเวลาที่ทำ</label>  
                                                <div class="col-md-6">
                                                    <input id="activity_range" name="activity_range" type="text"  class="form-control daterange input-md">

                                                </div>
                                            </div>
                                        </fieldset>
                                        </form>
                                    </div>

                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                    </div> <!-- /widget -->
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection
@section('specific_script')

<script type="text/javascript">
    $('.chosen').chosen();
</script>

@stop
