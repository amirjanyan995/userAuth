@extends('layouts.app')

@section('content')
    <div class="container" id="registration">
        <div class="row centered-form">
            <div class="col-xs-10 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4 ">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <p class="panel-title text-center">Please fill the form</p>
                    </div>
                    <div class="panel-body">
                        <form  role="form" method="POST" action="{{ route('register') }}"><!--action="registration/validation"-->
                            {{ csrf_field() }}
                            {{--fname lname--}}

                            <div class="row">
                                <div class="form-group">
                                    <div class="col-xs-6 col-sm-6 col-md-6 {{ $errors->has('fname') ? ' has-error' : '' }}">
                                        <input type="text" id="fname" class="form-control input-md" name="fname" placeholder="First Name" value="{{ old('fname') }}" required autofocus>
                                    </div>
                                    @if ($errors->has('fname'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('fname') }}</strong>
                                        </span>
                                    @endif
                                {{--</div>
                                <div class="form-group">--}}
                                    <div class="col-xs-6 col-sm-6 col-md-6 {{ $errors->has('lname') ? ' has-error' : '' }}">
                                        <input type="text" id="lname" class="form-control input-md" name="lname" placeholder="Last Name" value="{{ old('lname') }}" required>
                                    </div>
                                    @if ($errors->has('lname'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('lname') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            </br>
                            {{--Email--}}
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" required>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                @endif
                            </div>
                            {{--Phone--}}
                            <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                                <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}" placeholder="+374-xx-xx-xx-xx" required>
                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                @endif
                            </div>
                            {{--Birth Date--}}
                            <span  class="error" id="bdateError"></span>
                            <div class="form-group">
                                <input  dirname="birthDate" language="en" type="date" class="form-control" id="bDate" name="bDate" placeholder="Date of Birth" required>
                            </div>
                            {{--Password--}}
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
                                    </div>
                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
                                    </div>
                                </div>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                             <strong>{{ $errors->first('password') }}</strong>
                                         </span>
                                @endif
                            </div>
                            {{--species--}}
                            <div class="form-group center-block" style="text-align:">
                                <label class="custom-control custom-radio">
                                    <input  name="species" id="female" type="radio" class="custom-control-input" value="female"  required>
                                    <span class="custom-control-description">Female</span>
                                </label>
                                <label class="custom-control custom-radio">
                                    <input name="species" id="male" type="radio" class="custom-control-input" value="male"  required>
                                    <span class="custom-control-description">Male</span>
                                </label>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block btn-lg">
                                Register
                            </button>
                            <a href="{{ route('login') }}" class="btn btn-link">Sign in</a>
                            <a href="{{ route('password.request') }}" class="btn btn-link">Forgot Password</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
