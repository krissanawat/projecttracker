@extends('app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">หน้าหลัก</div>
                <div id="ganttChart"></div>
                <div class="panel-body">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('specific_script')
<script>
   
    $.ajax({
        url: '{{ route("ganttdata") }}',
        type: "get",
        dataType: 'json',
        success: function (data) {
//             var result = {};
            for (i = 0; i < data.length; i++) {
                if(("series" in data) ){
console.log(i)

                var serie_length = data[i].series.length;
                var serie = data[i].series;
                for (j = 0; j < serie_length; j++) {

                      data[i].series[j].start = new Date( data[i].series[j].start);
                     data[i].series[j].end =   new Date(data[i].series[j].end);
                }
            }
        }
            $("#ganttChart").ganttView({
                data: data,
                slideWidth: 700,
                behavior: {
                    clickable: true,
                    draggable: true,
                    resizable: true
                }
            })
        }
    })


</script>

@stop