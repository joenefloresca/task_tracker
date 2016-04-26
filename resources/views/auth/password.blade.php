@extends('app_ext')
@section('content')
<div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>
                <h1 class="logo-name">IN+</h1>
            </div>
            <h3>Welcome to IN+</h3>
            
            <p>Reset Password</p>
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <input type="email" class="form-control" name="email" placeholder="Email Address" value="{{ old('email') }}">
                </div>
             
                <button type="submit" class="btn btn-primary block full-width m-b">Send Password Reset Link</button>

               
            </form>
            <p class="m-t"> <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small> </p>
        </div>
    </div>
@endsection
