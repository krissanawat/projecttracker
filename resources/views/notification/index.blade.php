@extends('app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">การแจ้งเตือน
                    <div class="pull-right">
                          </div>
                </div>

                <div class="panel-body">
                    <div class="span7">   
                        <div class="widget stacked widget-table action-table">

                            <div class="widget-header">
                                <a class="btn btn-primary" href="{{ route('notification.index',['status'=>1])}}">อ่านแล้ว</a>
                                <a class="btn btn-success" href="{{ route('notification.index',['status'=>0])}}">ยังไม่ได้อ่าน</a>
                          	<a class="btn btn-warning" href="{{ route('notification.index',['status'=>2])}}">ดูที่ส่งไป</a>
                          		
                            </div> <!-- /widget-header -->

                            <div class="widget-content">

                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ส่งจาก</th>
                                            <th>ข้อความ</th>
                                            <th>ส่งมาเมื่อ</th>
                                            <th>จัดการ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($notification)
                                        @foreach($notification as $key => $notification)
                                        <tr>
                                            <td>{!! $notification->reciver->first_name !!}</td>
                                            <td> {!! $notification->subject !!}</td>
                                            <td>{!! $notification->created_at !!}</td>
                                            <td>
                                            @if($notification->is_read == 0)
  <a href="{{ route('notification.markasread',$notification->id)}}" class="btn btn-warning"><span class="glyphicon glyphicon-pencil"></span>อ่านแล้ว</a>
                                             
                                            @endif
                                            @if(Auth::user()->role == 'admin')
                                               <a  href="#myModal" data-url="{{ route('notification.delete',$notification->id)}}" data-toggle="modal" data-target="#myModal" class="remove btn btn-danger"><span class="glyphicon glyphicon-trash"></span> ลบ</a>
                                           @endif
                                            </td>
                                        </tr>
                                    
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
