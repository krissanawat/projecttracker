<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>PAPM @yield('title')</title>
        <link href="{{ asset('/css/app.css')}}" rel="stylesheet"> 
        <link rel="stylesheet" type="text/css" href="/css/chosen.css"> 
        <link rel="stylesheet" type="text/css" href="/css/fileinput.min.css">
        <link rel="stylesheet" type="text/css" href="/css/bootstrap-clockpicker.min.css"> 
        <!--<link rel="stylesheet" type="text/css" href="/css/daterangepicker-bs3.css">-->
        <link href="/css/font-awesome.css" rel="stylesheet">
        <link href="/css/bootstrap.min.css" rel="stylesheet" >
        <link rel="stylesheet" type="text/css" href="/css/awesome-bootstrap-checkbox.css">
        <link rel="stylesheet" type="text/css" href="/css/bootstrap-chosen.css"> 
        <link rel="stylesheet" type="text/css" href="/css/jquery.dataTables.css" />
        <link rel="stylesheet" type="text/css" href="/css/dataTables.bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="/js-lib/jquery.ganttView/jquery.ganttView.css">
        <link rel="stylesheet" type="text/css" href="/js-lib/jQuery-Validation-Engine/css/validationEngine.jquery.css">
        <link rel="stylesheet" type="text/css" href="/js-lib/jQuery-Validation-Engine/css/template.css">
        <link rel="stylesheet" type="text/css" href="/js-lib/jQuery-Validation-Engine/css/style.css">
        <link rel="stylesheet"  type="text/css" href="/js-lib/eternicode-bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" />
        @section('js')
        <!--  Jquery Base -->

        <!--Jquery GanttView-->
        <script src="/js-lib/jquery.ganttView/lib/date.js"></script>
        @if(Request::is('*/gantt'))
        <script src="/js-lib/jquery.ganttView/lib/jquery-1.4.2.js"></script>

        @else
        <script src="/js/jquery.min.js"></script>

        @endif
        <script src="/js-lib/jquery.ganttView/lib/jquery-ui-1.8.4.js"></script>
        <script src="/js-lib/jquery.ganttView/jquery.ganttView.js"></script>
        <!--Jquery GanttView-->

        <script src="http://osvaldas.info/examples/placeholder-polyfill-with-password-support/jquery.input-placeholder-polyfill.min.js" ></script>

        <script type="text/javascript" src="/js/fileinput.min.js"></script>
        <script type="text/javascript" src="/js/bootstrap-clockpicker.min.js"></script>

        <script type="text/javascript" src="/js-lib/jQuery-Validation-Engine/js/languages/jquery.validationEngine-th.js" ></script>
        <script type="text/javascript" src="/js-lib/jQuery-Validation-Engine/js/jquery.validationEngine.js" ></script>
        <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
        <script src="/js-lib/tinymce/js/tinymce/tinymce.min.js"></script>
        <script type="text/javascript" src="/js/readmore.js"></script>
        <script type="text/javascript" src="/js/chosen.jquery.min.js"></script>
        <script type="text/javascript" src='/js/fileinput.min.js'></script>
        <script type="text/javascript" src="/js/moment-with-locales.js" ></script>
        <!--<script src="/js/daterangepicker.js"></script>-->
        <script type="text/javascript" src="/js/chosen.jquery.min.js" ></script>
        <script src="/js/bootstrap.min.js"></script>
        <script src="/js/jquery.dataTables.js" ></script>
        <script src="/js/dataTables.bootstrap.js" ></script>
        <script src="/js-lib/blockui/jquery.blockUI.js" ></script>
        <script src="/js-lib/eternicode-bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
                <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        @stop
        <style>
            #myModal {
                z-index: 1500;
            }  table .collapse.in {
                display:table-row;
            }

            .navbar-login
            {
                width: 305px;
                padding: 10px;
                padding-bottom: 0px;
            }

            .navbar-login-session
            {
                padding: 10px;
                padding-bottom: 0px;
                padding-top: 0px;
            }

            .icon-size
            {
                font-size: 87px;
            }
            .loading,.loading>td,.loading>th,.nav li.loading.active>a,.pagination li.loading,.pagination>li.active.loading>a,.pager>li.loading>a{
    background-image: linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, rgba(0, 0, 0, 0) 25%, rgba(0, 0, 0, 0) 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, rgba(0, 0, 0, 0) 75%, rgba(0, 0, 0, 0));
    background-size: 40px 40px;
animation: 2s linear 0s normal none infinite progress-bar-stripes;
-webkit-animation: progress-bar-stripes 2s linear infinite;
}
.btn.btn-default.loading,input[type="text"].loading,select.loading,textarea.loading,.well.loading,.list-group-item.loading,.pagination>li.active.loading>a,.pager>li.loading>a{
background-image: linear-gradient(45deg, rgba(235, 235, 235, 0.15) 25%, rgba(0, 0, 0, 0) 25%, rgba(0, 0, 0, 0) 50%, rgba(235, 235, 235, 0.15) 50%, rgba(235, 235, 235, 0.15) 75%, rgba(0, 0, 0, 0) 75%, rgba(0, 0, 0, 0));
}
        </style>
    </head>
    <body>


        <div class="container">    
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="{{ url('/dashboard')}}">The Project Acceleration and Progression Monitoring System
                        </a>
                    </div>

                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">


                        <ul class="nav navbar-nav navbar-right list-inline">
                            @if (Auth::guest())
                            <li><a href="{{ route('getlogin')}}">Login</a></li>
                            <li><a href="{{ route('register')}}">Register</a></li>
                            @else
                            <?php
                            if (Auth::user()->role == 'adviser') {
                                $role = 'อาจารย์';
                            } elseif (Auth::user()->role == 'student') {
                                $role = 'นิสิต';
                            } else {
                                $role = 'แอดมิน';
                            }
                            ?>  

                            <li href="#" style=" cursor:pointer;" class="dropdown-toggle" data-toggle="dropdown">


                                <strong>  {!! $role.Auth::user()->first_name !!}  </strong>
                                <span class="glyphicon glyphicon-chevron-down"></span>

                            </li> 
                            <ul class="dropdown-menu">

                                <li>
                                    <div class="navbar-login">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <p class="text-center">
                                                    @if(Auth::user()->profile_image)
                                                    <span><img class="img-responsive img-thumbnail" width="100px" src="/storage/upload/{{Auth::user()->profile_image}}" /></span>

                                                    @else 
                                                    <span class="glyphicon glyphicon-user icon-size"></span>
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="col-lg-8">
                                                <p class="text-left"><strong>  {!! $role.Auth::user()->first_name !!}  {!! Auth::user()->last_name !!}  </strong></p>
                                                <p class="text-left small">  {!! Auth::user()->email !!}  </p>
                                                <p class="text-left">
                                                    <a href="{{ route('profile')}}" class="btn btn-primary btn-block btn-sm">แก้ไขประวติ</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <div class="navbar-login navbar-login-session">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <a href="{{ route('logout')}}" class="btn btn-danger btn-block">Logout</a>

                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            @endif
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="row">
                @if (Auth::user())
                <div class="col-md-2">

                    <div class="panel panel-default">
                        <div class="panel-heading">Home  
                            <a class="btn btn-danger" 
                               href="{{ route('notification.index',['status'=>'0'])}}">
                                <span class="badge">{{ $unread = App\Notification::where('is_read',0)->where('reciver_id',Auth::user()->id)->count() }}
                                </span></a>
                        </div>

                        <div class="panel-body">
                            <nav class="navbar navbar-default" role="navigation">
                                <!-- Brand and toggle get grouped for better mobile display -->
                                <div class="navbar-header">

                                </div>

                                <!-- Main Menu -->
                                <div class="side-menu-container">
                                    <ul class="nav navbar-nav">
                                        <li @if(Request::is('notification/*')) class="active" @endif><a href="{{ route('notification.index')}}"><span class="glyphicon glyphicon-exclamation-sign"></span> การแจ้งเตือน </a> </li>
                                        <li @if(Request::is('project/*')) class="active" @endif><a href="{{ route('project.index')}}"><span class="glyphicon glyphicon-briefcase"></span> โปรเจค</a></li>
                                        <li @if(Request::is('appointment/*')) class="active" @endif><a href="{{ route('appointment.index')}}"><span class="glyphicon glyphicon-adjust"></span> การนัดหมาย</a></li>
                                        <li @if(Request::is('activity/*')) class="active" @endif><a href="{{ route('activity.index')}}"><span class="glyphicon glyphicon-tasks"></span> ตารางงาน</a></li>
                                    </ul>
                                </div><!-- /.navbar-collapse -->
                            </nav>
                        </div>
                    </div>

                </div>
                @endif
                <div class="col-md-10">
                    @include('notifications')
                    @yield('content') 

                </div>

            </div>
        </div>



        <div id="myModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">ยืนยันการลบ</h4>
                    </div>
                    <div class="modal-body">
                        <p>คุณต้องการลบจริงๆ หรอ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                        <a href="#" id="delete" class=" btn btn-danger">ลบ</a>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </body> 
    <!-- Scripts -->

    @yield('js')
    @yield('specific_script')


    <script type="text/javascript">
$('.table').dataTable();
tinymce.init({selector: 'textarea', menubar: false, });
$(".form-horizontal").validationEngine();
$('.remove').click(function (e) {
    var href = $(this).attr("data-url");
    console.log(href);
    $('#delete').attr("href", href)
});
$('input').inputPlaceholderPolyfill();
$(document).ready(function () {
    moment.locale('th');

})
$('.chosen').chosen();

$('.clockpicker').clockpicker({donetext: 'เลือก', afterDone: function () {
        alert("after done");
    }});


$('.form-horizontal').submit(function(){
   alert('ddd');
})
    </script>


</html>

