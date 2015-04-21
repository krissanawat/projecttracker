@extends('app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">แก้ไขข้อมูลกิจกรรม


                </div>

                <div class="panel-body">
                    {!! Form::open(['route'=>'activity.update','class'=>'form-horizontal']) !!}
                    <fieldset>
                        {!! Form::hidden('id',$activity->id)!!}
                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="name">ชื่อ</label>  
                            <div class="col-md-5">
                                <input id="name" name="name" value="{{ $activity->name }}" type="text" placeholder="ระบบจัดการร้านอาหาร" class="form-control input-md">

                            </div>
                        </div>



                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="start">วันที่เริ่ม</label>  
                            <div class="col-md-4">
                                <input id="start" name="start_time" value="{{ $activity->start_time }}" type="text" placeholder="" class="  singledatetime-picker  form-control input-md">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="stop">วันที่สิ้นสุด</label>  
                            <div class="col-md-4">
                                <input id="stop" name="stop_time" value="{{ $activity->stop_time }}"type="text" placeholder="" class="  singledatetime-picker form-control input-md">

                            </div>
                        </div>
                    <div class="form-group">
                            <label class="col-md-4 control-label" for="stop">วันที่เสร็จริง</label>  
                            <div class="col-md-4">
                                <input id="stop" name="completed_at" value="{{ $activity->completed_at }}"type="text" placeholder="" class=" singledatetime-picker form-control input-md">

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="stop">สถานะ</label>  
                            <div class="col-md-4">
                                {!! Form::select('status',['รอ'=>'รอ','เสร็จแล้ว'=>'เสร็จแล้ว','ยังไม่เสร็จ'=>'ยังไม่เสร็จ'],$activity->status,['class'=>'form-control chosen'])!!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="stop">ให้ทำได้</label>  
                            <div class="col-md-4">
                                {!! Form::select('approve',['รอ'=>'รอ','อนุมัติ'=>'อนุมัติ','ไม่อนุมัติ'=>'ไม่อนุมัติ'],$activity->approve,['class'=>'form-control chosen'])!!}
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
    $(document).ready(function () {

    })
</script>

@stop

