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
        <link rel="stylesheet" type="text/css" href="/css/daterangepicker-bs3.css">
        <link href="/css/font-awesome.css" rel="stylesheet">
        <link href="/css/bootstrap.min.css" rel="stylesheet" >
        <link rel="stylesheet" type="text/css" href="/css/awesome-bootstrap-checkbox.css">
        <link rel="stylesheet" type="text/css" href="/css/bootstrap-chosen.css"> 
        <link rel="stylesheet" type="text/css" href="/css/jquery.dataTables.css" />
        <link rel="stylesheet" type="text/css" href="/css/dataTables.bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="/js-lib/jquery.ganttView/jquery.ganttView.css"> 
        @section('js')
     <!--  Jquery Base -->
       
        <!--Jquery GanttView-->
        <script src="/js-lib/jquery.ganttView/lib/date.js"></script>
        @if(Request::is('*/dashboard'))
        <script src="/js-lib/jquery.ganttView/lib/jquery-1.4.2.js"></script>

        @else
 <script src="/js/jquery.min.js"></script>
 
        @endif
        <script src="/js-lib/jquery.ganttView/lib/jquery-ui-1.8.4.js"></script>
        <script src="/js-lib/jquery.ganttView/jquery.ganttView.js"></script>
         <!--Jquery GanttView-->


  
        <script type="text/javascript" src="/js/fileinput.min.js"></script>
        <script type="text/javascript" src="/js/bootstrap-clockpicker.min.js"></script>
       
        <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
        <script src="/js-lib/tinymce/js/tinymce/tinymce.min.js"></script>
        <script type="text/javascript" src="/js/readmore.js"></script>
        <script type="text/javascript" src="/js/chosen.jquery.min.js"></script>
        <script type="text/javascript" src='/js/fileinput.min.js'></script>
        <script type="text/javascript" src="/js/moment-with-locales.js" ></script>
      <script src="/js/daterangepicker.js"></script>
        <script type="text/javascript" src="/js/chosen.jquery.min.js" ></script>
        <script src="/js/bootstrap.min.js"></script>
        <script src="/js/jquery.dataTables.js" ></script>
        <script src="/js/dataTables.bootstrap.js" ></script>
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
        </style>
    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="{{ url('/dashboard')}}">The Project Acceleration and Progression Monitoring System
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">


                    <ul class="nav navbar-nav navbar-right">
                        @if (Auth::guest())
                        <li><a href="{{ route('getlogin')}}">Login</a></li>
                        <li><a href="{{ route('register')}}">Register</a></li>
                        @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{!! Auth::user()->role !!}  {!! Auth::user()->first_name !!}  <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ route('logout')}}">Logout</a></li>
                            </ul>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            <div class="row">
                @if (Auth::user())
                <div class="col-md-2">

                    <div class="panel panel-default">
                        <div class="panel-heading">Home  
                         <a class="btn btn-primary" 
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
                                        <li @if(Request::is('profile/*')) class="active" @endif><a href="{{ route('profile')}}"><span class="glyphicon glyphicon-user"></span> ตั้งค่าประวัติ</a></li>
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

$('.remove').click(function (e) {
    var href = $(this).attr("data-url");
    console.log(href);
    $('#delete').attr("href", href)
});

$(document).ready(function () {
    moment.locale('th');

})
$('.chosen').chosen();
$('.singledatepicker').daterangepicker({// เลือกแบบอันเดียว
    singleDatePicker: true,
    format: 'YYYY-DD-MM',
    separator: ' - ',
    locale: {
        applyLabel: 'เลือก',
        cancelLabel: 'ยกเลิก',
        fromLabel: 'จาก',
        toLabel: 'ถึง',
        customRangeLabel: 'เลือกช่วง',
        daysOfWeek: ['อา', 'จ', 'อ', 'พ', 'พฤ', 'ศ', 'ส'],
        monthNames: ['ม.ค', 'ก.พ', 'มี.ค', 'เม.ย', 'พ.ค', 'มิ.ย', 'ก.ค', 'ส.ค', 'ก.ย', 'ต.ค', 'พ.ย', 'ธ.ค'],
        firstDay: 1
    }
})
$('.clockpicker').clockpicker({donetext: 'เลือก', afterDone: function () {
        alert("after done");
    }});
$('.singledatetime-picker').daterangepicker({// เลือกแบบอันเดียวและมีเวลาด้วย
    singleDatePicker: true,
    timePicker: true,
    format: 'YYYY-DD-MM hh:mm:ss ',
    showDropdowns: true,
    timePickerIncrement: 5,
    separator: ' - ',
    locale: {
        applyLabel: 'เลือก',
        cancelLabel: 'ยกเลิก',
        fromLabel: 'จาก',
        toLabel: 'ถึง',
        customRangeLabel: 'เลือกช่วง',
        daysOfWeek: ['อา', 'จ', 'อ', 'พ', 'พฤ', 'ศ', 'ส'],
        monthNames: ['ม.ค', 'ก.พ', 'มี.ค', 'เม.ย', 'พ.ค', 'มิ.ย', 'ก.ค', 'ส.ค', 'ก.ย', 'ต.ค', 'พ.ย', 'ธ.ค'],
        firstDay: 1
    }
})

$('.daterange').daterangepicker({
    startDate: moment().subtract(29, 'days'),
    endDate: moment(),
    dateLimit: {days: 1000},
    showDropdowns: true,
    showWeekNumbers: true,
    timePicker: true,
    timePickerIncrement: 5,
    timePicker12Hour: true,
    ranges: {
        'วันนี้': [moment().startOf('days'), moment()],
        'เมื่อวาน': [moment().subtract(1, 'days').startOf('days'), moment().subtract(1, 'days').endOf('days')],
        '7 วันก่อน': [moment().subtract(6, 'days').startOf('days'), moment().endOf('days')],
        '30 วันก่อน': [moment().subtract(29, 'days').startOf('days'), moment().endOf('days')],
        'เดือนนี้': [moment().startOf('month').startOf('days'), moment().endOf('days')],
        'เดือนก่อน': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
        'ปีก่อน': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')]
    },
    // opens: 'left',
    buttonClasses: ['btn btn-default'],
    applyClass: 'btn-small btn-primary',
    cancelClass: 'btn-small',
    format: 'MM/DD/YYYY H:mm:ss',
    separator: ' - ',
    locale: {
        applyLabel: 'เลือก',
        cancelLabel: 'ยกเลิก',
        fromLabel: 'จาก',
        toLabel: 'ถึง',
        customRangeLabel: 'เลือกช่วง',
        daysOfWeek: ['อา', 'จ', 'อ', 'พ', 'พฤ', 'ศ', 'ส'],
        monthNames: ['ม.ค', 'ก.พ', 'มี.ค', 'เม.ย', 'พ.ค', 'มิ.ย', 'ก.ค', 'ส.ค', 'ก.ย', 'ต.ค', 'พ.ย', 'ธ.ค'],
        firstDay: 1
    }
});
    </script>


</html>

