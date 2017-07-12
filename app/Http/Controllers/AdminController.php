<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\DB;
class AdminController extends Controller
{
    private $postModel=null;
    private $userModel=null;
    public function __construct()
    {
        if($this->postModel==null)
            $this->postModel=new Post();
        if($this->userModel==null)
            $this->userModel=new User();
    }

    public function users(){
        $users=User::all();
        return view('admin.users')->with([
            'users'=>$users
        ]);
    }
    public function posts(){
        $posts=DB::table('postview')
            ->select(['postID','title','categoryName','fname','lname','created_at','updated_at'])
            ->orderBy('created_at','desc')
            ->get();
        return view('admin.posts')->with([
            'posts'=>$posts
        ]);

    }
    /**
     *  edit post page
     */
    public function editPost($postID){
        $post=$this->postModel->getPostForAdmin($postID);
        $category=$this->postModel->getCategory();
        return view('admin.editPost')->with([
            'post'=>$post[0],
            'category'=>$category
        ]);
    }
    /**
     *  edit user
     */
    public function editUser($userID){
        $user=$this->userModel->getUserByID($userID);
        return view('admin.editUser')->with([
            'user'=>$user
        ]);
    }
    /**
     *  update user information
     */
    public function basicUpdate($userID,Request $request){
        $this->validate($request,[
            'fname'     => 'bail|required|string|max:32|min:3|regex:/^[a-zA-Z]*$/',
            'lname'     => 'bail|required|string|max:32|min:3|regex:/^[a-zA-Z]*$/',
            'email'     => 'bail|required|string|email|max:64|min:8',
            'phone'     => 'bail|required|max:16|regex:/^\+374\-[0-9]{2}-[0-9]{2}-[0-9]{2}-[0-9]{2}$/',
            'bDate'     =>  'date',
            'species'   =>  'required'
        ]);
        if($this->userModel->updateUserInformation($userID,$request->all()))
            return back()->with('status','User\'s information has been successfully updated');
    }
    /**
     * delete user
     */
    public function userDel($userID){
        if($this->userModel->deleteUser($userID)){
            echo json_encode([
                'status'=>1
            ]);
        }else{
            echo json_encode([
                'status'=>0,
                'error' => 'can not delete admin'
            ]);
        }
    }
    /**
     * As admin
     */
    public function asAdmin(Request $request,$userID){
        if($this->userModel->asAdmin($userID,$request->all())){
            return redirect()->route('admin.users');
        }
    }
}
