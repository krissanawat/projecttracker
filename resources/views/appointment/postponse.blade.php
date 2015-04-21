@extends('app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">เลือนการนัดหมาย


                </div>

                <div class="panel-body">
                {!! Form::open(['route'=>'appointment.postponse','class'=>'form-horizontal']) !!}
                        <fieldset>
                            {!! Form::hidden('appointment_id',Input::get('id')) !!}
                              {!! Form::hidden('user_id',Input::get('user_id')) !!}
   
                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="name">เหตุผล</label>  
                                <div class="col-md-5">
                                    <input id="name" name="reason" type="text" placeholder="" class="form-control input-md">

                                </div>
                            </div>

                           
                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="start">เลื่อนไปวันที่</label>  
                                <div class="col-md-4">
                                    <input id="start" name="timetogo" type="text" 
                                     class="singledatetime-picker form-control input-md">

                                </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="stop">สถานที่</label>  
                                <div class="col-md-4">
                                    <input id="location" name="location" type="text" placeholder="" class="form-control input-md">

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
    
</script>

@stop