@extends('layouts.admin')
@section('content')
    <div style="margin: auto;margin-top: 15px;">
        <div class="row" >
            <div class="col-lg-7 col-lg-offset-2 col-md-6 col-md-offset-3 col-sm-5 col-sm-offset-2 col-xs-6   " >
                {{--<div class="col-lg-7 col-md-8 col-sm-8 col-xs-12" >--}}
                <div class="panel1 panel-body">
                    <label for="userInfo">User Info:</label>
                    <form name="userInfo" role="form" method="post" action="{{ route('admin.user.update',['id'=>$user->id]) }}">
                        {{ csrf_field() }}
                        @if (session('status'))
                        <div class="alert alert-success" id="updateStatus">
                            {{ session('status') }}
                        </div>
                        @endif
                        {{--fname--}}
                        @if ($errors->has('fname'))
                            <span class="help-block">
                                            <i>{{ $errors->first('fname') }}</i>
                                        </span>
                        @endif
                        <div class="input-group {{ $errors->has('fname') ? ' has-error' : '' }}" >
                            <span class="input-group-addon">First name:</span>
                            <input type="text" id="fname" class="form-control input-md" name="fname" placeholder="First Name" value="{{ $user->fname }}" required autofocus>
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
                            <input type="text" id="lname" class="form-control input-md" name="lname" placeholder="Last Name" value="{{ $user->lname }}" required>
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
                            <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" placeholder="Email" required>
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
                            <input id="phone" type="text" class="form-control" name="phone" value="{{ $user->phone }}" placeholder="Phone number" required>
                        </div>
                        <br>
                        {{--species--}}
                        <div class="input-group">
                            <div class="form-group center-block" >
                                <label class="custom-control custom-radio">
                                    <input  name="species" type="radio" class="custom-control-input" value="female" @if($user->species=='female') checked @endif>
                                    <span class="custom-control-description">Female</span>
                                </label>
                                <label class="custom-control custom-radio">
                                    <input name="species" type="radio" class="custom-control-input" value="male" @if($user->species=='male') checked @endif>
                                    <span class="custom-control-description">Male</span>
                                </label>
                            </div>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon">Birthday:</span>
                            <div class="form-group">
                                <input dirname="bDate" type="date" class="form-control" name="bDate" value="{{ $user->bDate}}" placeholder="Date of Birth" >
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

                    </form>
                </div>
            </div>
        </div>
        <!-- Appoint as admin  -->
        <div class="row centered-form" >
            <div class="col-lg-7 col-lg-offset-2 col-md-6 col-md-offset-3 col-sm-5 col-sm-offset-2 col-xs-6   " >
                <div class="panel1 panel-body">
                    <form name="password" role="form" method="post" action="{{ route('asAdmin',['id'=>$user->id]) }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="input-group ">
                            <label for="category">User Role:</label>
                            <select class="form-control" id="role" name="role" required>
                                <option value="1">User</option>
                                <option value="5">Admin</option>
                            </select>
                        </div>
                        </br>
                        <div class="input-group">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block btn-md">
                                    As
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection