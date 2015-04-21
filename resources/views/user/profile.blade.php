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
                            <label class="col-md-4 control-label" for="textinput">ชื่อ</label>  
                            <div class="col-md-4"> 
                                <input type="text" name="first_name" class="form-control" id="profile" >

                            </div>

                        </div>
                          <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput">นามสกลุ</label>  
                            <div class="col-md-4"> 
                                <input type="text" name="last_name" class="form-control" id="profile" >

                            </div>

                        </div>
                           <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput">email</label>  
                            <div class="col-md-4"> 
                                <input type="email" name="email" class="form-control" id="profile" >

                            </div>

                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput">รูประจำตัว</label>  
                            <div class="col-md-4"> 
                                <input type="file" name="profile" class="form-control" id="profile" >

                            </div>

                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="woringtime">เวลาทำงาน</label>  
                            <div class="col-md-3">
                                <input name="working_time" value="{{ Auth::user()->working_time}}"
                                class="  form-control input-md" id="working_time" type="text" placeholder="">

                            </div>
                         
                        </div>
                <div class="form-group">
                            <label class="col-md-4 control-label" for="woringtime">เวลาพัก</label>  
                            <div class="col-md-3">
                                <input name="non_working_time" value="{{ Auth::user()->non_working_time}}"
                                class="  form-control input-md" id="non_working_time" type="text" placeholder="">

                            </div>
                         
                        </div>
                        <!-- Text input-->
                       
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