@extends('app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">ตารางงาน
                    <div class="pull-right">
                          <a  href="#myModal" data-url="{{ route('task.create')}}" data-toggle="modal" 
                          data-target="#myModal" class="remove btn btn-success">
                          <span class="glyphicon glyphicon-plus"></span> เพิ่ม</a>
                                                 </div>
                </div>

                <div class="panel-body">
               

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
