@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-10 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4 ">
                <div class="panel panel-default">
                    <div class="panel-heading">Reset Password</div>

                    <h3><i class="fa fa-lock fa-4x"></i></h3>
                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        {{--Email address--}}
                        <form role="form" method="POST" action="{{ route('password.request') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" placeholder="Email Address" required autofocus>
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
                                    <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
                                </div>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif

                            </div>
                            {{--password confirm--}}
                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Password Confirm" required>
                                </div>
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif

                            </div>
                            <div class="form-group">
                                <button type="submit"class="btn btn-primary btn-block">
                                    Reset Password
                                </button>
                            </div>
                            <a href="{{ route('login') }}" class="btn btn-link">Sign in</a>
                            <a href="{{ route('register') }}" class="btn btn-link">Register</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
