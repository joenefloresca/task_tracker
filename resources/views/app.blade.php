<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>QDF Task Tracker</title>

	<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet">
	<link href="{{ asset('css/plugins/toastr/toastr.min.css') }}" rel="stylesheet">
	<link href="{{ asset('js/plugins/gritter/jquery.gritter.css') }}" rel="stylesheet">
	<link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/datapicker/datepicker3.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/datetimepicker/jquery.datetimepicker.css') }}" rel="stylesheet">

    <link href="{{ asset('css/plugins/dataTables/dataTables.bootstrap.css') }}" rel="stylesheet">
    

    <!-- <link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.6/cerulean/bootstrap.min.css" rel="stylesheet"> -->


    <link href="{{ asset('css/plugins/dataTables/dataTables.responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/dataTables/dataTables.tableTools.min.css') }}" rel="stylesheet">

    <link href="{{ asset('css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-formhelpers.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-side-notes.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrapValidator.css') }}" rel="stylesheet">

    <script src="{{ asset('js/jquery-2.1.1.js') }}"></script>


</head>

<body>
	<div id="wrapper">
	<nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> <span>
                            <!-- <img class="img-circle" src="{{asset('img/profile_small.jpg')}}"> -->
                             </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">@if(Auth::check()){{Auth::user()->name}}@endif</strong>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="{{ url('auth/logout') }}">Logout</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        IN+
                    </div>
                </li>
                 @if(Auth::check())
                <li>
                    <a href="{{ url('home') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
                </li> 
               
                
                <li>
                    <a href="#"><i class="fa fa-credit-card"></i> <span class="nav-label">Tasks</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li class="active"><a href="{{ url('tasks') }}">Tasks List</a></li>
                        <li class="active"><a href="{{ url('tasks/create') }}">Add Task</a></li>  
                    </ul>
                </li>
                 @endif
   
            </ul>
        </div>
    </nav>

    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            <form role="search" class="navbar-form-custom" action="http://webapplayers.com/inspinia_admin-v2.3/search_results.html">
                <div class="form-group">
                    <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
                </div>
            </form>
        </div>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <span class="m-r-sm text-muted welcome-message">Welcome to QDF Task Tracker.</span>
                </li>

                <li>
                    <a href="{{ url('auth/logout') }}">
                        <i class="fa fa-sign-out"></i> Log out
                    </a>
                </li>
            </ul>

        </nav>
        </div>

	@yield('content')

	<div class="footer">
        
        <div>
            <center><strong>Copyright</strong> Quinn Data Facilities &copy; <?php echo date("Y") ?></center>
        </div>
    </div>

    </div>
    </div>

    <!-- Mainly scripts -->
    
    <script src="{{ asset('js/jquery-2.1.1.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-formhelpers.js') }}"></script>
    <script src="{{ asset('js/bootstrapValidator.js') }}"></script>
    <script src="{{ asset('js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
    <script src="{{ asset('js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{ asset('js/inspinia.js') }}"></script>
    <script src="{{ asset('js/plugins/pace/pace.min.js') }}"></script>

    <!-- Data picker -->
    <script src="{{ asset('js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>

    <!-- Datepicker -->
    <script src="{{ asset('js/plugins/datetimepicker/jquery.datetimepicker.js') }}"></script>

    <!-- Data Tables -->
    <script src="{{ asset('js/plugins/dataTables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('js/plugins/dataTables/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('js/plugins/dataTables/dataTables.responsive.js') }}"></script>
    <script src="{{ asset('js/plugins/dataTables/dataTables.tableTools.min.js') }}"></script>
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script>
        $("body").addClass("skin-3");
    </script>

    @yield('home')
    @yield('tasks-create')
    @yield('tasks-index')

</body>
</html>
