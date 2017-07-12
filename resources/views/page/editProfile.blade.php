@extends('layouts.page')
@section('content')
    <div class="col-md-9 panel panel-default" style="min-height: 250px;padding-left: 30px; padding-right: 29px;">
        <div class="panel-heading">
            <p class="text-left" id="panel-title">Basic info</p>
        </div>
        <div style="margin: auto">
            <div class="row" >
                <div class="col-lg-7 col-lg-offset-2 col-md-6 col-md-offset-3 col-sm-5 col-sm-offset-2 col-xs-6   " >
                    {{--<div class="col-lg-7 col-md-8 col-sm-8 col-xs-12" >--}}
                    <div class="panel-heading123">
                        <p class="text-left" >User info</p>
                    </div>
                    @if (session('status'))
                        </br>
                        <div class="alert alert-success" id="updateStatus">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="panel1 panel-body">
                        <form name="userInfo" role="form" method="post" action="{{ route('basicUpdate') }}">
                            {{ csrf_field() }}
                            <div class="row">
                                {{--fname--}}
                                @if ($errors->has('fname'))
                                    <span class="help-block">
                                            <i>{{ $errors->first('fname') }}</i>
                                        </span>
                                @endif
                                <div class="input-group {{ $errors->has('fname') ? ' has-error' : '' }}" >
                                    <span class="input-group-addon">First name:</span>
                                    <input type="text" id="fname" class="form-control input-md" name="fname" placeholder="First Name" value="{{ Auth::user()->fname }}" required autofocus>
                                </div>
                                <br>
                                {{--lname--}}
                                @if ($errors->has('lname'))
                                    <span class="help-block">
                                            <i>{{ $errors->first('v') }}</i>
                                        </span>
                                @endif
                                <div class="input-group {{ $errors->has('lname') ? ' has-error' : '' }}">
                                    <span class="input-group-addon">Last name:</span>
                                    <input type="text" id="lname" class="form-control input-md" name="lname" placeholder="Last Name" value="{{ Auth::user()->lname }}" required>
                                </div>
                                <br>

                                {{--email--}}
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                            <i>{{ $errors->first('email') }}</i>
                                        </span>
                                @endif
                                <div class="input-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <span class="input-group-addon">Email:</span>
                                    <input id="email" type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" placeholder="Email" required>
                                </div>
                                <br>

                                {{--phone--}}
                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                            <i>{{ $errors->first('phone') }}</i>
                                        </span>
                                @endif
                                <div class="input-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                                    <span class="input-group-addon">Phone:</span>
                                    <input id="phone" type="text" class="form-control" name="phone" value="{{ Auth::user()->phone }}" placeholder="Phone number" required>
                                </div>
                                <br>
                                {{--species--}}
                                <div class="input-group">
                                    <div class="form-group center-block" >
                                        <label class="custom-control custom-radio">
                                            <input  name="species" type="radio" class="custom-control-input" value="female" @if(Auth::user()->species=='female') checked @endif>
                                            <span class="custom-control-description">Female</span>
                                        </label>
                                        <label class="custom-control custom-radio">
                                            <input name="species" type="radio" class="custom-control-input" value="male" @if(Auth::user()->species=='male') checked @endif>
                                            <span class="custom-control-description">Male</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon">Birthday:</span>
                                    <div class="form-group">
                                        <input dirname="bDate" type="date" class="form-control" name="bDate" value="{{ Auth::user()->bDate}}" placeholder="Date of Birth" >
                                    </div>
                                </div>
                                <br>
                                <div class="input-group">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block btn-md">
                                            Update
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <hr style="border-bottom: 2px solid #bbb">

            <!-- Old New Confirm (Password) -->
            <div class="row centered-form" >
                <div class="col-lg-5 col-md-6 col-sm-5 col-xs-6 col-sm-offset-2 col-md-offset-3 col-lg-offset-2" >
                    <div class="panel-heading123">
                        <p class="text-left">Password</p>
                    </div>
                    <div class="panel1 panel-body">
                        <form name="password" role="form" method="post" action="{{ route('changePassword') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            {{--old password--}}
                            <div class="form-group {{ $errors->has('current-password') ? ' has-error' : '' }}">
                                <div class="input-group">
                                    <span class="input-group-addon psw">Old password:</span>
                                    <input type="password" class="form-control" name="current-password" required>
                                </div>
                                @if ($errors->has('current-password'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('current-password') }}</strong>
                                        </span>
                                @endif
                            </div>
                            {{--new password--}}
                            <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                <div class="input-group">
                                    <span class="input-group-addon psw">New Password:</span>
                                    <input type="password" class="form-control" name="password" required>
                                </div>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                @endif
                            </div>
                            {{--new password confirm--}}
                            <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <div class="input-group">
                                    <span class="input-group-addon psw">Confirm password:</span>
                                    <input type="password" class="form-control" name="password_confirmation" required>
                                </div>
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div class="input-group">
                                <div class="form-group">
                                    <input name="passwordSubmit" type="submit" value="Save" class="btn btn-primary btn-block btn-md">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Upload  File-->

            {{--<hr style="border-bottom: 2px solid #bbb">
            <div class="row centered-form" >
                <div class="col-lg-5 col-md-6 col-sm-5 col-xs-6 col-sm-offset-2 col-md-offset-3 col-lg-offset-2" >
                    <div class="panel-heading123">
                        <p class="text-left">Upload new image</p>
                    </div>
                    <div class="panel1 panel-body">
                        <div style="margin: auto">
                            @if(count($errors)>0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{$error}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form name="uploadPhoto" enctype="multipart/form-data" role="form" method="post" action="{{route('profileIMG')}}">
                                {{ csrf_field() }}
                                <div class="input-group">
                                    <input type="file" class="btn btn-default btn-file" name="profileIMG" accept="image/jpeg,image/png,image/gif"/>
                                </div>
                                <br>
                                <div class="input-group">
                                    <div class="form-group">
                                        <input type="submit" name="uploadSubmit" value="Upload" class="btn btn-primary btn-block btn-md"/>
                                    </div>
                                </div>
                            </form>
                            @if(Auth::user()->profileImgPath!=null)
                                <form action="{{route('removeProfileIMG')}}" method="post" >
                                    {{ csrf_field() }}
                                    <button type="submit" id="removeProfileIMG" onclick="return confirm('Delete image?')">
                                        <i class="glyphicon glyphicon-remove"></i>&nbsp;Remove Image
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>--}}
        </div>
    </div>
@endsection