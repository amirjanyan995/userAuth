@extends('layouts.page')
@section('content')
    <div class="col-md-9 panel panel-default" style="padding-left: 30px; padding-right: 29px;">
        <div class="row post">
            <div class="panel-heading postTitle">
                <a href="{{route('post.show',$post->postID)}}"><h3>{{$post->title}}</h3></a>
            </div>
            <div class="row" >
                {{-- AUTHOR --}}
                <div class="col-sm-12 col-md-12" >
                    By <a href="{{route('post.author',$post->authorID)}}">{{$post->fname." ".$post->lname}}</a>
                </div>
                </br></br>
                {{--CATEGORY--}}
                <div class="col-sm-6 col-md-6 col-xs-6" >
                            <span class="glyphicon glyphicon-folder-open">
                            </span> &nbsp;<a href="{{route('post.category',$post->categoryID)}}">{{$post->categoryName}}</a>
                </div>
                {{--EDIT,DELETE,CREATE--}}
                <div class="group2 col-sm-6 col-md-6 col-xs-6" >
                    @if($post->authorID==\Illuminate\Support\Facades\Auth::user()->id)
                        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-6">
                            <a href="{{route('post.edit',$post->postID)}}" class="btn btn-default btn-xs">
                                <i class="glyphicon glyphicon-edit"></i>
                                &nbsp;Edit post
                            </a>
                        </div>
                        <div class=" col-lg-3 col-sm-4 col-md-4 col-xs-6">
                            <form action="{{route('post.delete',$post->postID)}}" method = "post">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-default btn-xs" onclick="return confirm('Delete post?')">
                                    <i class="glyphicon glyphicon-remove"></i>&nbsp;Delete post
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
            <div class="row ">
                @if($post->imgPath!=null)
                    <div class="col-lg-4 col-md-4 col-sm-7 col-xs-6 " >
                        <img src="{{asset($post->imgPath)}}" alt="erik" style="max-width: 100%;">
                    </div>
                @endif
                <p class="postDescription">{{$post->description}}</p>
            </div>

        </div>
        <div class="row">
            {{--CATEGORY--}}
            <div class="col-sm-6 col-md-6" >
                <h5 class="glyphicon glyphicon-time">&nbsp;{{$post->created_at}}</h5>
            </div>
        </div>

        <hr style="color: #0f0f0f">
        {{--comments--}}
        <div class="row">
            <div class="col-sm-12">
                <div class="comment-tabs">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="active"><a href="#comments" role="tab" data-toggle="tab"><h4 class="reviews text-capitalize">Comments</h4></a></li>
                        <li><a href="#add-comment" role="tab" data-toggle="tab"><h4 class="reviews text-capitalize">Add comment</h4></a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="comments">
                            <ul class="media-list">
                                @for($i=0;$i<5;$i++)
                                    <li class="media">
                                        <a class="pull-left" href="#">
                                            <img class="media-object img-circle" src="{{asset('img/'.Auth::user()->species.'.png')}}" alt="profile">
                                        </a>
                                        <div class="media-body">
                                            <div class="well well-lg">
                                                <a href="{{route('post.author',$post->authorID)}}"><h4 class="media-heading text-uppercase reviews">{{$post->fname." ".$post->lname}}</h4></a>

                                                <div class="media-date text-uppercase reviews list-inline">
                                                    <b>&nbsp;{{$post->created_at}}</b>
                                                </div>
                                                <p class="media-comment">
                                                    Great snippet! Thanks for sharing.
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                @endfor
                            </ul>
                        </div>
                        <div class="tab-pane" id="add-comment">
                            <form action="{{route('addComment',$post->postID)}}" method="post" class="form-horizontal" id="commentForm" role="form">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="email" class="col-sm-2 control-label">Comment</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="comment" id="addComment" rows="5"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button class="btn btn-success btn-circle text-uppercase" type="submit" id="submitComment"><span class="glyphicon glyphicon-send"></span> Summit comment</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection