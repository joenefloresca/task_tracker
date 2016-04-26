@extends('app_ext')
@section('content')
<div class="middle-box text-center loginscreen   animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name">IN+</h1>

            </div>
            <h3>Register to QDF Task Tracker</h3>
            <p>Create account to see it in action.</p>
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
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/register') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Name" name="name" required="">
                </div>

                <!-- <div class="form-group">
                    <input type="email" class="form-control" placeholder="Email" name="email" required="">
                </div> -->

                <div class="form-group">
                    <input type="text" class="form-control" placeholder="ID Number" name="id_number" required="">
                </div>

                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password" name="password" required="">
                </div>

                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation">
                </div>

                <button type="submit" class="btn btn-primary block full-width m-b">Register</button>

                <p class="text-muted text-center"><small>Already have an account?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="{{ url('/auth/login') }}">Login</a>
            </form>
            <p class="m-t"> <small><strong>Copyright</strong> Quinn Data Facilities &copy; <?php echo date("Y") ?></small> </p>
        </div>
    </div>
@endsection
