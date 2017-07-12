<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Armenian Social  Network</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('css/admin.css')}}">

    <!--google fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz:400,300,700' rel='stylesheet' type='text/css'>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-left">
    <ul class="nav navbar-nav">
        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                {{--http://2.bp.blogspot.com/-wqJojh3X3T0/UXn2guDI3jI/AAAAAAAADec/gpAyE6o9Qo8/s1600/laravel-4-framework.jpg--}}
                {{ Auth::user()->fname}}&nbsp;
                @if(Auth::user()->profileImgPath==null)
                    <img src="{{asset('img/'.Auth::user()->species.'.png')}}" class="img-circle" style="max-width: 31px;max-height: 31px;">
                @else
                    <img src="{{asset(Auth::user()->profileImgPath)}}" class="img-circle" style="max-width: 31px;max-height: 31px;">
                @endif
                <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu">
                <hr >
                <li>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
        </li>
        <li><a href="{{route('post.index')}}" style="font-size: 15px;">Site</a></li>
        <li><a href="{{route('admin.posts')}}">Posts</a></li>
        <li><a href="{{route('admin.users')}}">Users</a></li>
    </ul>
</div>
<div class="container">
    @yield('content')
</div>


<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/admin.js') }}"></script>
<script src="{{ asset('js/script.js') }}"></script>
<!-- jQuery (necessary for  Bootstrap's JavaScript plugins) -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
</body>
</html>