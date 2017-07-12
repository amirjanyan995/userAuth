<div class="panel panel-default">
    <div class="col-lg-12" style="margin-top: 15px;">
        @if(Auth::user()->profileImgPath==null)
            <img src="{{asset('img/'.Auth::user()->species.'.png')}}" class="img-circle" style="max-width: 100%">
        @else
            <img src="{{asset(Auth::user()->profileImgPath)}}" class="img-circle" style="max-width:100%">
        @endif
    </div>

        <h4 class="text-center"><i>{{ Auth::user()->fname }}</i></h4>
        <h4 class="text-center"><i>{{ Auth::user()->lname }}</i></h4>
        <h5 class="text-center"><i>{{ Auth::user()->email }}</i></h5>
        <h5 class="text-center"><i>{{ Auth::user()->phone }}</i></h5>
        <h5 class="text-center"><i>{{ Auth::user()->bDate }}</i></h5>

</div>