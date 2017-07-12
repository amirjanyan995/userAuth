<div class="panel panel-default">
    <div class="panel-heading">
        <h4>Categories</h4>
    </div>
    <ul class="list-group">
        @foreach($category as $single)
            <li class="list-group-item"><a href="{{route('post.category',$single->categoryID)}}">{{$single->categoryName}}</a></li>
        @endforeach
    </ul>
</div>