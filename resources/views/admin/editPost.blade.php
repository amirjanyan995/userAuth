@extends('layouts.admin')
@section('content')
        <form role="form" method="post" enctype="multipart/form-data" role="form" action="{{route('post.update',['postID'=>$post->postID])}}">
            <input type="hidden" name="_method" value="put" />
            </br>
            @if (session('status'))
                <div class="alert alert-success" id="updateStatus">
                    {{ session('status') }}
                </div>
            @endif
            @if(count($errors)>0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {{ csrf_field() }}
            <div class="row"  style="margin-top: 15px">
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group {{ $errors->has('postTitle') ? ' has-error' : '' }}">
                        <label for="postTitle">Title:</label>
                        <input type="text" name="title" class="form-control input-md" value="{{$post->title}}" required>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group ">
                        <label for="category">Category:</label>
                        <select class="form-control" id="category" name="categoryID" required>
                            @foreach($category as $single)selected="selected"
                            <option value="{{$single->categoryID}}"
                                    @if($single->categoryID=$post->categoryID)
                                    selected="selected"
                                    @endif>
                                {{$single->categoryName}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group" >
                <label for="description">Text:</label>
                <textarea class="form-control" rows="15" name="description" id="description"  style="resize: vertical; " required>{{$post->description}}</textarea>
            </div>
            {{--add image--}}
            <div class="input-group" >
                <label style="width: 150px;" id="upload">
                    @if($post->imgPath==null)
                        Upload Images
                        <input type="file" class="btn btn-default btn-file" name="photo" accept="image/jpeg,image/png,image/gif"/>
                    @else
                        <img id="postIMG" src="{{asset($post->imgPath)}}">
                        <input type="file" class="btn btn-default btn-file" name="photo" id="uploadIMG" accept="image/jpeg,image/png,image/gif" style="display: none"/>
                    @endif
                </label>

            </div>
            @if($post->imgPath!=null)
                <span id="uloadText" onclick="delImg({{$post->postID}})">Remove Image</span>
            @endif
            <br>
            <button type="submit" class="btn btn-primary btn pull-right">Update Post</button>
            </br>
            <hr style="color: #0f0f0f">
        </form>
@endsection