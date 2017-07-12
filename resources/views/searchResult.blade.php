@forelse($posts as $post)
    <li class="serach-result">
        <a href="{{route('post.show',$post->postID)}}">
            {{--@if($post->imgPath!=null)
                <div class="col-lg-2 col-md-2 col-sm-2">
                    <img src="{{asset($post->imgPath)}}" style="max-width: 100%;">
                </div>
            @endif--}}
            <div class="col-lg-12 col-md-12 col-sm-12">
                <h5>{{$post->title}}</h5>
            </div>
        </a>
    </li>
@empty
    <li id="search-noresult">
        <h5>Post not Found</h5>
    </li>
@endforelse