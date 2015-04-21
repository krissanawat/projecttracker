@extends('app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">เพิ่มข้อมูล การนัดหมาย


                </div>

                <div class="panel-body">
                {!! Form::open(['route'=>'appointment.create','class'=>'form-horizontal']) !!}
                        <fieldset>


                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="name">หัวข้อ</label>  
                                <div class="col-md-5">
                                    <input id="name" name="title" type="text" placeholder="" class="form-control input-md">

                                </div>
                            </div>

                            <!-- Textarea -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="detail">รายละเอียด</label>
                                <div class="col-md-8">                     
                                    <textarea class="form-control" id="detail" name="detail"></textarea>
                                </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="start">วันเวลา</label>  
                                <div class="col-md-4">
                                    <input id="start" name="due_date" type="text" 
                                     class="singledatetime-picker form-control input-md">

                                </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="stop">สถานที่</label>  
                                <div class="col-md-4">
                                    <input id="stop" name="location" type="text" placeholder="" class="form-control input-md">

                                </div>
                            </div>

                            <!-- Search input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="co-adviser">นัดกับกลุ่ม</label>
                                <div class="col-md-5">

                                    <div class="input-group">

        {!! Form::select('project_id',$project,'',['class'=>'form-control input-md','id'=>'appoint_group']) !!}
                                        <span class="input-group-addon">
                                           <i class="icon-move"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Button -->
                            <div class="form-group">
                             
                                <div class="col-md-offset-4 col-md-4">
                                    <button id="singlebutton" name="singlebutton" class="btn btn-primary">บันทึก</button>
                                </div>
                            </div>

                        </fieldset>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('specific_script')
<script type="text/javascript">
    
$("#appoint_group").chosen();
</script>

@stop