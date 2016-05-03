@extends('app')
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>My Tasks</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('home') }}">Home</a>
            </li>
            <li class="active">
                <strong>My Tasks List</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
            @if(Auth::check() && Auth::user()->access_level != 1)
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox-title">
                        <h5>My Daily Tasks</small></h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <table id="MyDailyTasks" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Description</th>
                                    <th>Start</th>
                                    <th>End</th>
                                    <th>Added By</th>
                                    <th>Assigned to</th>
                                    <th>Date Created</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif

            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">

                        <div class="ibox-title">
                            @if(Auth::check() && Auth::user()->access_level != 1)
                                <h5>My Additional Tasks</small></h5>
                            @else
                                <h5>Recent Tasks</small></h5>    
                            @endif
                            
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        
                        <!-- Modal -->
                        <div id="myModal" class="modal fade" role="dialog">
                          <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">My Task</h4>
                              </div>
                              <div class="modal-body">
                                <div class="form-horizontal"  role="form">
                                    <fieldset>

                                    <div class="form-group">
                                        <label  class="col-sm-2 control-label">ID</label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" id="task_id" name="task_id" readonly="readonly">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label  class="col-sm-2 control-label">Description</label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" id="task_description" name="task_description" readonly="readonly">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label  class="col-sm-2 control-label">Start</label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" id="task_start" name="task_start" readonly="readonly">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label  class="col-sm-2 control-label">End</label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" id="task_end" name="task_end" readonly="readonly">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label  class="col-sm-2 control-label">Custom Time</label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" id="task_custom" name="task_custom" readonly="readonly">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label  class="col-sm-2 control-label">Added By</label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" id="task_added" name="task_added" readonly="readonly">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label  class="col-sm-2 control-label">Status</label>
                                        <div class="col-lg-10">
                                            <select class="form-control" name="task_status" id="task_status">
                                                <option value=""></option>
                                                <option value="Pending">Pending</option>
                                                <option value="Done">Done</option>
                                            </select>
                                        </div>
                                    </div>

                                    </fieldset>
                                </div>
                             
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-success" data-dismiss="modal" id="updateData">Save</button>
                              </div>
                            </div>

                          </div>
                        </div>

                        <div class="ibox-content">
                            <table id="MyTasks" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Description</th>
                                        <th>Start</th>
                                        <th>End</th>
                                        <th>Added By</th>
                                        <th>Assigned to</th>
                                        <th>Date Created</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
             @if(Auth::check() && Auth::user()->access_level != 1)
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox-title">
                        <h5>Generate Report</small></h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <table id="SendTask" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Description</th>
                                    <th>Start</th>
                                    <th>End</th>
                                    <th>Hours</th>
                                    <th>Added By</th>
                                    <th>Assigned to</th>
                                    <th>Date Created</th>
                                    <th>Status</th>
                                </tr>
                            </thead>

                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th colspan="2">Total Hours</th>
                                    <th id="totalhours"></th>
                                </tr>
                            </tfoot>
                        </table>
                        <button type="button" class="btn btn-success" id="generateReport">Generate</button>
                        <button type="button" class="btn btn-primary" id="sendReport">Send Report</button>
                        <input type="text" class="form-control" name="supp_email" id="supp_email" placeholder="Supervisor Email">
                    </div>
                </div>
            </div>
            @endif

</div>
@endsection
@section('tasks-index')
<script>
$(document).ready(function(){
    $('#MyTasks').DataTable({
        processing: true,
        serverSide: true,
        ajax: 'job-index',
        "order": [[ 0, "desc" ]],
        "dom": 'T<"clear">lfrtip',
        "tableTools": {
            "sSwfPath": "js/plugins/dataTables/swf/copy_csv_xls_pdf.swf"
        },
        ajax: 'tasks-list',
         "createdRow": function ( row, data, index ) {
            if (data.status == "Pending") {
                $('td', row).eq(7).addClass('text-warning');
            }
            else
            {
                $('td', row).eq(7).addClass('text-success');
            }
        },
        columns: [
            {data: 'id', name: 'tasks.id'},
            {data: 'task_description', name: 'tasks.task_description'},
            {data: 'start_timestamp', name: 'tasks.start_timestamp'},
            {data: 'end_timestamp', name: 'tasks.end_timestamp'},
            {data: 'name', name: 'users.name'},
            {data: 'assign', name: 'x.name'},
            {data: 'created_at', name: 'tasks.created_at'},
            {data: 'status', name: 'tasks.status'},
            {data: 'action', name: 'action'}
        ]
    });

    $('#MyDailyTasks').DataTable({
        processing: true,
        serverSide: true,
        ajax: 'job-index',
        "order": [[ 0, "desc" ]],
        "dom": 'T<"clear">lfrtip',
        "tableTools": {
            "sSwfPath": "js/plugins/dataTables/swf/copy_csv_xls_pdf.swf"
        },
        ajax: 'daily-tasks-list',
         "createdRow": function ( row, data, index ) {
            if (data.status == "Pending") {
                $('td', row).eq(7).addClass('text-warning');
            }
            else
            {
                $('td', row).eq(7).addClass('text-success');
            }
        },
        columns: [
            {data: 'id', name: 'tasks.id'},
            {data: 'task_description', name: 'tasks.task_description'},
            {data: 'start_timestamp', name: 'tasks.start_timestamp'},
            {data: 'end_timestamp', name: 'tasks.end_timestamp'},
            {data: 'name', name: 'users.name'},
            {data: 'assign', name: 'x.name'},
            {data: 'created_at', name: 'tasks.created_at'},
            {data: 'status', name: 'tasks.status'},
            {data: 'action', name: 'action'}
        ]
    });



    $('#myModal').on('show.bs.modal', function (e) {
        var uniqueId = $(e.relatedTarget).data('id');
        //Ajax Method
        $.ajax({
            type : 'get',
            url : 'tasks/'+uniqueId, //Here you will fetch records 
            success : function(response){
                $('.modal-title').html('Task ID: ' + uniqueId);
                $('#task_id').val(uniqueId);
                $('#task_description').val(response.task_description);
                $('#task_start').val(response.start_timestamp);
                $('#task_end').val(response.end_timestamp);
                $('#task_custom').val(response.fixed_timestamp);
                $('#task_added').val(response.name);
                $('#task_status').val(response.status);
            }
        });
    });

    $('#updateData').on('click', function() {
        var id = $("#task_id").val();
        var status = $('#task_status').val();
        $.ajax({
            type : 'put',
            url : 'tasks/'+id, //Here you will fetch records 
            data: {'id': id, 'status': status},
            success : function(response){
                alert(response);
                location.reload(true);
            }
        });
    });

    $("#generateReport").click(function() {
      $.ajax({
            type : 'get',
            url : 'generate-report', //Here you will fetch records 
            success : function(result){
                var myObj = $.parseJSON(result);
                var t = $('#SendTask').DataTable({
                    "order": [[ 0, "desc" ]],
                    "dom": 'T<"clear">lfrtip',
                    "tableTools": {
                        "sSwfPath": "js/plugins/dataTables/swf/copy_csv_xls_pdf.swf"
                    }
                });


                var totalhours = 0;
                $.each(myObj[0], function(key,value) {
                    var date_start = new Date(value.start_timestamp);
                    var date_end = new Date(value.end_timestamp);
                    var milisec = Math.abs(date_end - date_start);
                    var seconds = milisec / 1000;
                    var hours = parseInt( seconds / 3600 );
                    totalhours += hours;
                    t.row.add( [
                        value.id,
                        value.task_description,
                        value.start_timestamp,
                        value.end_timestamp,
                        hours,
                        value.name,
                        value.assign,
                        value.created_at,
                        value.status
                    ] ).draw();
                });

                $.each(myObj[1], function(key,value) {
                    var date_start = new Date(value.start_timestamp);
                    var date_end = new Date(value.end_timestamp);
                    var milisec = Math.abs(date_end - date_start);
                    var seconds = milisec / 1000;
                    var hours = parseInt( seconds / 3600 );
                    totalhours += hours;
                    t.row.add( [
                        value.id,
                        value.task_description,
                        value.start_timestamp,
                        value.end_timestamp,
                        hours,
                        value.name,
                        value.assign,
                        value.created_at,
                        value.status
                    ] ).draw();
                });

                $('#totalhours').text(totalhours);

                alert("Tasks from the last 8 hours generated.");
            }
        });
    });

    $("#sendReport").click(function() {
        var table      = $('#SendTask').prop('outerHTML');
        var supp_email = $('#supp_email').val();
        if(supp_email != "")
        {
            $.ajax({
                type : 'get',
                url : 'generate-email', //Here you will fetch records 
                data: {'body': table, 'supp_email' : supp_email},
                success : function(result){
                    alert("Email Sent.");
                }
            });
        }
        else
        {
            alert("Please enter supervisor's email before sending report.");
        }
        
    });

    // function msToHMS( ms ) {
    //     // 1- Convert to seconds:
    //     var seconds = ms / 1000;
    //     // 2- Extract hours:
    //     var hours = parseInt( seconds / 3600 ); // 3,600 seconds in 1 hour
    //     seconds = seconds % 3600; // seconds remaining after extracting hours
    //     // 3- Extract minutes:
    //     var minutes = parseInt( seconds / 60 ); // 60 seconds in 1 minute
    //     // 4- Keep only seconds not extracted to minutes:
    //     seconds = seconds % 60;
        
    //     var result = hours+":"+minutes+":"+seconds;
    // }

   
}); 
</script>           
@endsection
