<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
class CommentController extends Controller
{
    public function store(Request $request,$postID){
        dump(Auth::user()->id);
        dump($postID);
        dump($request->all());
    }
}
