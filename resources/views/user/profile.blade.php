@extends('app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">หน้าหลัก</div>
                <form class="form-horizontal" method="post" enctype="multipart/form-data" action="{{ route('update_profile')}}">
                    <fieldset>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput"></label>  
                            <div class="col-md-4"> 
                              
                        <img class="img-thumbnail"src="{!! '/storage/upload/'.Auth::user()->profile_image !!}" >
                            </div>

                        </div>
                     
                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput">รูประจำตัว</label>  
                            <div class="col-md-4"> 
                                <input type="file" name="profile" class="form-control" id="profile" >

                            </div>

                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="woringtime">ช่วงเวลาทำงาน</label>  
                            <div class="col-md-3">
                                <input name="start_working_time" value="{{ Auth::user()->start_working_time}}"
                                class=" clockpicker form-control input-md" id="start_working_time" type="text" placeholder="เริ่ม">

                            </div>
                             <label class="col-md-1 control-label" for="woringtime">ถึง</label>  
                                <div class="col-md-3">
                                <input name="stop_working_time"  value="{{ Auth::user()->stop_working_time}}"
                                 class=" clockpicker form-control input-md" id="stop_working_time" type="text" placeholder="หยุด">

                            </div>
                        </div>

                        <!-- Text input-->
                         <div class="form-group">
                            <label class="col-md-4 control-label" for="start_rest_time">ช่วงเวลาพัก</label>  
                            <div class="col-md-3">
                                <input name="start_rest_time" value="{{ Auth::user()->start_rest_time}}"
                                class=" clockpicker form-control input-md" id="start_rest_time" type="text" placeholder="เริ่ม">

                            </div>
                             <label class="col-md-1 control-label" for="stop_rest_time">ถึง</label>  
                                <div class="col-md-3">
                                <input name="stop_rest_time" value="{{ Auth::user()->stop_rest_time}}"
                                class=" clockpicker form-control input-md" id="stop_rest_time" type="text" placeholder="หยุด">

                            </div>
                        </div>
                         <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput"></label>  
                            <div class="col-md-4"> 
                                <button type="submit"  class="btn btn-primary" >บันทึก</button>

                            </div>

                        </div>
                    </fieldset>
                </form>

                <div class="panel-body">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('specific_script')
<script>
    
    $("#profile").fileinput({showCaption: false,showUpload: false, maxFileCount: 1, mainClass: "input-group-lg"});
    </script>
@stop