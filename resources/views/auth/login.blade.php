@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row centered-form">
            <div class="col-xs-10 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4 ">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <p class="panel-title text-center">Login Form</p>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post" action="{{ route('login') }}">
                            {{ csrf_field() }}

                            {{--email--}}
                            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input type="email" id="email" class="form-control input-lg" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>
                                </div>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                @endif
                            </div>

                            {{--Password--}}
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                    <input id="password" type="password" class="form-control input-lg" name="password" placeholder="Password" required>
                                </div>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            {{--Remember me--}}
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block btn-lg">
                                    Login
                                </button>
                            </div>
                            {{--<input name="loginSubmit" type="submit" value="Sign in" class="btn btn-primary btn-block btn-lg">--}}
                            <a href="{{ route('register') }}" class="btn btn-link">Register</a>
                            <a href="{{ route('password.request') }}" class="btn btn-link">Forgot Password</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
