@extends('layouts.page')
@section('content')
    <div class="col-md-9 singlePost" >
        @forelse($posts as $post)
            <div class="panel panel-default" style="min-height: 250px;padding-left: 30px; padding-right: 29px;">
                <div class="row post" id="post{{$post->postID}}">
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
                            <div class="col-lg-3 col-md-4 col-sm-7 col-xs-6 " >
                                <img src="{{asset($post->imgPath)}}" alt="erik" style="max-width: 100%;">

                            </div>
                        @endif
                        <p class="postDescription">{{$post->miniDescription}}</p>
                    </div>
                    <div class="row">
                        {{--CATEGORY--}}
                        <div class="col-sm-6 col-md-6" >
                            <h5 class="glyphicon glyphicon-time">&nbsp;{{$post->created_at}}</h5>
                        </div>
                        {{--EDIT,DELETE,CREATE--}}
                        <div class="col-sm-6 col-md-6 text-right" >
                            <a class="btn btn-primary btn-sm" href="{{route('post.show',$post->postID)}}">
                                <b>continue reading &raquo;</b>
                            </a>
                        </div>
                    </div>
                    {{-- <hr style="color: #0f0f0f">--}}
                    </br>
                </div>
            </div>
        @empty
            <div class="panel panel-default" style="min-height: 250px;padding-left: 30px; padding-right: 29px;">
                <div class="row">
                    <div class="panel-heading postTitle">
                        <h2 class="text-center">Aricle not found</h2>
                    </div>
                </div>
            </div>
        @endforelse
            <center>{!! $posts->render() !!}</center>
    </div>
@endsection