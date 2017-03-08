@extends('layouts.login')

@section('content')

<style type="text/css">
    .form-horizontal .form-group {
         margin: 0px !important; 
    }
</style>

<div class="login-box">
  <div class="login-logo">
    <a href="/">MyStocks</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
      
      {{ csrf_field() }}

      <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
            <span class="fa fa-envelope form-control-feedback"></span>
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
      </div>
      
      <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
            <input id="password" type="password" class="form-control" name="password" required>
            <span class="fa fa-lock form-control-feedback"></span>
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
      </div>

      <div class="row">
            <div class="col-xs-8">
              <div class="checkbox">
                    <label>
                        {{-- <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me --}}
                    </label>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div>
            <!-- /.col -->
      </div>

    </form>

    {{-- <a class="btn btn-link" href="{{ url('/password/reset') }}"> Forgot Your Password? </a> --}}

  </div>
  <!-- /.login-box-body -->
</div>
@endsection
