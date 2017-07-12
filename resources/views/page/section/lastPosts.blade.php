<div class="panel panel-default">
    <div class="panel-heading">
        <h4>Latest Posts</h4>
    </div>
    <ul class="list-group">
        @forelse($latestPosts as $post)
            <li class="list-group-item" id="title{{$post->postID}}"><a href="{{route('post.show',$post->postID)}}">{{$post->title}}</a></li>
        @empty
            <li class="list-group-item"><h4 class="text-center">Article not found</h4></li>
        @endforelse
    </ul>
</div>