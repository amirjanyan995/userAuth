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
    <link rel="stylesheet" type="text/css" href="{{asset('css/userPage.css')}}">
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
<!-- Navigation panel -->
<header class="navbar navbar-inverse navbar-fixed-top bs-docs-nav" role="banner">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('post.index') }}">
                <i class="glyphicon glyphicon-user"></i>
            </a>
        </div>
        <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
            <div class="nav navbar-nav navbar-left">
                <ul class="nav navbar-nav">
                    <li><a href="{{ route('editProfile') }}">Edit Profile</a></li>
                    <li><a href="{{ route('post.create') }}">Add Post</a></li>
                    @if(Auth::user()->role==5)
                        <li><a href="{{ route('admin.posts') }}">Admin page</a></li>
                    @endif
                    <div class="col-lg-5 col-sm-4 col-md-4 hidden-xs" style="margin-top: 10px">
                        <input type="text" class="form-control dropdown-toggle"  placeholder="Search" id="search" autocomplete="off">
                        <div id="block-search-result">
                            <ul id="list-search-result">
                            </ul>
                        </div>
                    </div>
                </ul>
            </div>
            {{--right panel--}}
            <div class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        {{ Auth::user()->fname}}&nbsp;
                        @if(Auth::user()->profileImgPath==null)
                            <img src="{{asset('img/'.Auth::user()->species.'.png')}}" class="img-circle" style="max-width: 31px;max-height: 31px;">
                        @else
                            <img src="{{asset(Auth::user()->profileImgPath)}}" class="img-circle" style="max-width: 31px;max-height: 31px;">
                        @endif
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="{{ route('editProfile') }}">
                                Edit Profile
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('post.create') }}">
                                Add Post
                            </a>
                        </li>
                        <hr >
                        <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
            </div>
        </nav>
    </div>
</header>
<!--Open container   end in user/foother.php-->
<div class="container">
    <div class="row">
    @yield('content')
    <!--Open col-->
        <div class="col-sm-3 hidden-sm hidden-xs">
            {{--user infor--}}
            @section('userinformation')
                @include('page.section.userInfo')
            @show

            {{--latest post--}}
            @section('latestPosts')
                @include('page.section.lastPosts')
            @show

            {{--category--}}
            @section('category')
                @include('page.section.category',$category)
            @show
        </div>
        <!--  Close col   open in userInfo.php -->
    </div>
    <!-- end container -->
</div>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/script.js') }}"></script>
<!-- jQuery (necessary for  Bootstrap's JavaScript plugins) -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
</body>
</html>