@extends('app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">แก้ไขข้อมูลโปรเจค 


                </div>

                <div class="panel-body">
                    {!! Form::open(['route'=>'project.update','class'=>'form-horizontal']) !!}
                    {!! Form::hidden('primary_adviser_id',Auth::user()->id) !!}
                    <fieldset>
                        {!! Form::hidden('id',$projects->id)!!}
                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="name">ชื่อ</label>  
                            <div class="col-md-5">
                                <input id="name" name="name" value="{{ $projects->name }}" 
                                       type="text" placeholder="ระบบจัดการร้านอาหาร" class="validate[required] form-control input-md">

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="detail">สถานะ</label>
                            <div class="col-md-6">     
                                {!! Form::select('status',['1'=>'เริ่มดำเนินงาน',"2"=>'เสร็จสมบูรณ์','3'=>'ไม่ผ่าน',''], $projects->status ,['class'=>'form-control chosen'])!!}
                            </div>

                        </div>    
                        <!-- Textarea -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="detail">รายละเอียด</label>
                            <div class="col-md-8">                     
                                <textarea class="form-control validate[required]" col="70" rows="10" id="detail" name="detail">{{ $projects->detail }}</textarea>
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="start">ช่วงเวลา</label>
                            <div class="col-md-8">

                                <div class="input-daterange input-group" id="datepicker">
                                    <input type="text" value="{{ $projects->start }}"class="input-sm form-control validate[required]" name="task_start" />
                                    <span class="input-group-addon">ถึง</span>
                                    <input type="text" value="{{ $projects->finish }}" class="input-sm form-control validate[required]" name="task_finish" />
                                </div>
                            </div>
                        </div>

                        <!-- Search input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="co-adviser">ที่ปรึกษาร่วม</label>
                            <div class="col-md-5">

                                <div class="input-group">
                                    {!! Form::select('secondary_adviser_id',App\User::where('role','adviser')->whereNotIn('id',[Auth::user()->id])->lists('first_name','id')
                                    ,$projects->secondary_adviser_id ,['class'=>'form-control input-md','id'=>'coadviser-select']) !!}
                                    <span class="input-group-addon">
                                        <i class="glyphicon glyphicon-search"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Search input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="student">นักเรียน</label>
                            <div class="col-md-6">

                                <div class="input-group">
                                    <select id="student-select"  multiple name="student[]" type="text" placeholder="" class="form-control input-md">
                                        {!! $dropdown !!}
                                    </select>   
                                    <span class="input-group-addon">
                                        <i class="glyphicon glyphicon-search"></i>
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
    $("#student-select").chosen({'max_selected_options': 2});
    $("#coadviser-select").chosen({'placeholder_text_multiple': 'เลือกที่ปรึกษาร่วม'});
    $('#datepicker').datepicker({
        format: "yyyy-mm-dd",
        language: "th",
        todayHighlight: true
    });

</script>

@stop

