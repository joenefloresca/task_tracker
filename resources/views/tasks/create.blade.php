@extends('app')
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Tasks Form</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('home') }}">Home</a>
            </li>
            <li class="active">
                <strong>Tasks Form</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5><small>Tasks Form</small></h5>
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

                            <form class="form-horizontal" id="payment-form" role="form" method="POST" action="{{ url('tasks') }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="flash-message">
                                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                      @if(Session::has('alert-' . $msg))
                                      <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}</p>
                                      @endif
                                    @endforeach
                                </div>

                                <fieldset>
                                    <legend>Tasks</legend>

                                      <div class="form-group">
                                            <label  class="col-sm-2 control-label">Task Description</label>
                                            <div class="col-lg-10">
                                                <input type="text" class="form-control" name="task_description">
                                            </div>
                                      </div>
                                      <div class="form-group">
                                            <label  class="col-sm-2 control-label">Start Timestamp</label>
                                            <div class="col-lg-10">
                                                <input type="text" class="form-control datetimepicker" name="start_timestamp">
                                            </div>
                                      </div>
                                      <div class="form-group">
                                            <label  class="col-sm-2 control-label">End Timestamp</label>
                                            <div class="col-lg-10">
                                                <input type="text" class="form-control datetimepicker" name="end_timestamp">
                                            </div>
                                      </div>
                                      
                                      <!-- <div class="form-group" style="">
                                            <label  class="col-sm-2 control-label">Custom Timestamp</label>
                                            <div class="col-lg-10">
                                                <input type="text" class="form-control" name="fixed_timestamp" placeholder="e.g Daily">
                                            </div>
                                      </div> -->

                                      <div class="form-group" style="">
                                            <label  class="col-sm-2 control-label">Is task daily?</label>
                                            <div class="col-lg-10">
                                                <select name="is_daily" id="is_daily" class="form-control">
                                                    <option value=""></option>
                                                    <option value="1">Yes</option>
                                                    <option value="0">No</option>
                                                </select>
                                            </div>
                                      </div
                                      
                                      @if(Auth::check() && Auth::user()->access_level == 1)
                                        <div class="form-group">
                                            <label  class="col-sm-2 control-label">Assigned To</label>
                                            <div class="col-lg-10">
                                                {!! Form::select('assigned_to', $users, '',array('class' => 'form-control', 'id' => 'assigned_to', 'required' => 'required')) !!}
                                            </div>
                                        </div>
                                      @endif
                                      

                                      <!-- <div class="form-group">
                                            <label  class="col-sm-2 control-label">Signature</label>
                                            <div class="col-lg-10">
                                                <input type="text" class="form-control" name="signature">
                                            </div>
                                      </div> -->
                                      
                                </fieldset>
                                
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
@section('tasks-create')
<script>
jQuery('.datetimepicker').datetimepicker();
</script>           
@endsection


