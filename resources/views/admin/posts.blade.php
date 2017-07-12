@extends('layouts.admin')

@section('content')
    <h3>Posts</h3>
    <table  class="usersTable">
        <tr>
            <th>Post ID</th>
            <th>Title</th>
            <th>Category</th>
            <th>Author</th>
            <th>Created at</th>
            <th>Updated at</th>
        </tr>
        @foreach($posts as $post)
            {{--{{dump($user)}}--}}
            <tr id="post{{$post->postID}}">
                <td class="id">         {{$post->postID}}                       </td>
                <td class="title">      {{$post->title}}                        </td>
                <td class="category">   {{$post->categoryName}}                 </td>
                <td class="author">     {{$post->fname." ".$post->lname}}       </td>
                <td class="created">    {{$post->created_at}}                   </td>
                <td class="created">    {{$post->updated_at}}                   </td>
                <td>
                    <ul class="hr">
                        <a href="{{route('admin.posts.edit',['id' => $post->postID])}}" class="buttons">
                            <li class="glyphicon glyphicon-edit" alt="Edit Post">

                            </li>
                        </a>
                        <li class="glyphicon glyphicon-remove buttons" alt="Remove Post" onclick="delPost({{$post->postID}})" >
                            {{ csrf_field() }}
                        </li>
                    </ul>
                </td>
            </tr>
        @endforeach

    </table>
@endsection