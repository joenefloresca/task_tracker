@extends('app_ext')
@section('content')
<div class="middle-box text-center loginscreen animated fadeInDown">
    <div>
        <div>

            <h1 class="logo-name">IN+</h1>

        </div>
        <h3>Welcome to QDF Task Tracker</h3>
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
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <input type="text" class="form-control" name="id_number" placeholder="ID Number" required="">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password" required="">
            </div>

            <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

            <!-- <a href="{{ url('/password/email') }}"><small>Forgot password?</small></a> -->
            <p class="text-muted text-center"><small>Do not have an account?</small></p>
            <a class="btn btn-sm btn-white btn-block" href="{{ url('/auth/register') }}">Create an account</a>
        </form>
        <p class="m-t"> <small><strong>Copyright</strong> Quinn Data Facilities &copy; <?php echo date("Y") ?></small> </p>
    </div>
</div>
@endsection