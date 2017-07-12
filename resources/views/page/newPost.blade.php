@extends('layouts.page')
@section('content')
    <div class="col-md-9 panel panel-default" style="min-height: 818px;padding-left: 30px; padding-right: 29px;">
        <form role="form" method="post" enctype="multipart/form-data" role="form" action="{{route('post.store')}}">
            </br>
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
                        <input type="text" name="title" id="postTitle" class="form-control input-md" value="{{old('title')}}" required>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group ">
                        <label for="category">Category:</label>
                        <select class="form-control" id="category" name="categoryID" required>
                            @foreach($category as $single)
                                <option value="{{$single->categoryID}}">{{$single->categoryName}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group" >
                <label for="body">Text:</label>
                <textarea class="form-control" rows="15" name="description"  style="resize: vertical; " required>{{old('description')}}</textarea>
            </div>
            {{--post image--}}
            <div class="input-group">
                <label for="photo">Upload Images</label>
                <input type="file" class="btn btn-default btn-file" name="photo" id="photo" accept="image/jpeg,image/png,image/gif"/>
            </div>
            <br>
            <button type="submit" class="btn btn-primary btn pull-right">Add Post</button>
            </br>
            <hr style="color: #0f0f0f">
        </form>
    </div>
@endsection