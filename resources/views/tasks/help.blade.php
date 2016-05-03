@extends('app')
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Help Page</h2>
        <ol class="breadcrumb">
            <li>
                @if(Auth::check() && Auth::user()->access_level == 1)
                    <a href="{{ url('home') }}">Home</a>
                @else
                     <a href="{{ url('tasks') }}">Tasks</a>   
                @endif
            </li>
            <li class="active">
                <strong>Help Page</strong>
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
                            <h5><small>Help Page</small></h5>
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

                            

                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection



