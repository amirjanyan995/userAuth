@extends('layouts.admin')

@section('content')

    <h3>Users</h3>
    <table  class="usersTable">
        <tr>
            <th>User ID</th>
            <th >First Name</th>
            <th>last Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Birth Date</th>
            <th>Spacies</th>
            <th>Role</th>
            <th>Created at</th>
            <th>Updated at</th>
        </tr>
        @foreach($users as $user)
            {{--{{dump($user)}}--}}
            <tr id="user{{$user->id}}">
                <td class="id">     {{$user->id}}       </td>
                <td class="fname">  {{$user->fname}}    </td>
                <td class="lname">  {{$user->lname}}    </td>
                <td class="email">  {{$user->email}}    </td>
                <td class="phone">  {{$user->phone}}    </td>
                <td class="bDate">  {{$user->bDate}}    </td>
                <td class="species">{{$user->species}}  </td>
                <td class="role">
                    <?php
                    switch ($user->role){
                        case 1:
                            echo "User";
                            break;
                        case 5:
                            echo "Admin";
                            break;
                    }
                    ?>
                </td>
                <td class="created">{{$user->created_at}}</td>
                <td class="created">{{$user->updated_at}}</td>
                <td>
                    <ul class="hr">
                        <a href="{{route('admin.user.edit',['id' => $user->id])}}" class="buttons">
                            <li class="glyphicon glyphicon-edit" alt="Edit Post">

                            </li>
                        </a>
                        <a href="#">
                            <li class="glyphicon glyphicon-remove" onclick="delUser({{$user->id}})">
                                {{ csrf_field() }}
                            </li>
                        </a>
                    </ul>
                </td>
            </tr>
        @endforeach

    </table>
@endsection