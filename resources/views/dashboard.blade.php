@extends('app')

@section('content')
<style type="text/css">

    .tree {
        min-height:20px;
        padding:19px;
        margin-bottom:20px;
        background-color:#fbfbfb;
        border:1px solid #999;
        -webkit-border-radius:4px;
        -moz-border-radius:4px;
        border-radius:4px;
        -webkit-box-shadow:inset 0 1px 1px rgba(0, 0, 0, 0.05);
        -moz-box-shadow:inset 0 1px 1px rgba(0, 0, 0, 0.05);
        box-shadow:inset 0 1px 1px rgba(0, 0, 0, 0.05)
    }
    .tree li {
        list-style-type:none;
        margin:0;
        padding:10px 5px 0 5px;
        position:relative
    }
    .tree li::before, .tree li::after {
        content:'';
        left:-20px;
        position:absolute;
        right:auto
    }
    .tree li::before {
        border-left:1px solid #999;
        bottom:50px;
        height:100%;
        top:0;
        width:1px
    }
    .tree li::after {
        border-top:1px solid #999;
        height:20px;
        top:25px;
        width:25px
    }
    .tree li span {
        -moz-border-radius:5px;
        -webkit-border-radius:5px;
        border:1px solid #999;
        border-radius:5px;
        display:inline-block;
        padding:3px 8px;
        text-decoration:none
    }
    .tree li.parent_li>span {
        cursor:pointer
    }
    .tree>ul>li::before, .tree>ul>li::after {
        border:0
    }
    .tree li:last-child::before {
        height:30px
    }
    .tree li.parent_li>span:hover, .tree li.parent_li>span:hover+ul li span {
        background:#eee;
        border:1px solid #94a0b4;
        color:#000
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">หน้าหลัก</div>

                <div class="panel-body">

                    <ul>


                    </ul>

                    @foreach($project as $project)    
                    <div class="tree">
                        <ul> 
                            <li>
                                <span><i class="glyphicon glyphicon-briefcase"></i>{!! $project->name !!}</span> &ndash; <a traget="_blank" href="{{ route('project.edit',['id'=>$project->id])}}">แก้ไข</a>
                                @foreach($project->activity as $activity)
                                <ul>
                                    <li>
                                        <span class="badge badge-success"><i class="glyphicon glyphicon-tasks"></i> {!! $activity->name !!}</span>
                                        @foreach($activity->task as $task)
                                        <ul>
                                            <li>
                                                <a href=""><span><i class="glyphicon glyphicon-file"></i> {!! $task->name !!}</span> &ndash;
                                                    <a class="btn btn-danger taskstatus" id="{!! $task->id !!}" data-name="{!! $task->name !!}" 
                                                       data-toggle="modal" data-target="#myModal" >เพิ่มสถานะ</a> </a>

                                            </li>
                                        </ul>
                                        @endforeach
                                    </li>
                                </ul>
                                @endforeach
                            </li>

                        </ul>

                    </div>
                    @endforeach            
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">สถานะของ task </h4>
            </div>
              <form action="{!! route('task.addstatus') !!}" class="form-horizontal">
            <div class="modal-body">
              
                    <fieldset>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput">สถานะ</label>  
                            <div class="col-md-4">
                                <input id="textinput" name="status" type="text" placeholder="สถานะ" class="form-control input-md">
                                <input type="hidden" id="id" name="id" value="" />
                            </div>
                        </div>

                    </fieldset>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('specific_script')
<script type="text/javascript">
    $('.taskstatus').click(function () {
        var id = $(this).attr('id');
        $('#id').attr('value',id);
        $('.modal-title').text($(this).data('name'));
    });
    $(function () {
        $('.tree li:has(ul)').addClass('parent_li').find(' > span').attr('title', 'Collapse this branch');
        $('.tree li.parent_li > span').on('click', function (e) {
            var children = $(this).parent('li.parent_li').find(' > ul > li');
            if (children.is(":visible")) {
                children.hide('fast');
                $(this).attr('title', 'Expand this branch').find(' > i').addClass('glyphicon glyphicon-plus-sign').removeClass('glyphicon glyphicon-minus-sign');
            } else {
                children.show('fast');
                $(this).attr('title', 'Collapse this branch').find(' > i').addClass('glyphicon glyphicon-minus-sign').removeClass('glyphicon glyphicon-plus-sign');
            }
            e.stopPropagation();
        });
    });
</script>

@stop