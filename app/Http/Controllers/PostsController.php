<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use App\Post;
use Validator;
use Image;
use Auth;
use DB;

class PostsController extends Controller
{
    private $category=null;
    private $latestPosts=null;
    private $postModel=null;

    public function __construct()
    {
        $this->middleware('auth');
        if($this->postModel==null)
            $this->postModel=new Post();
        $this->category=$this->postModel->getCategory();
        $this->latestPosts=$this->postModel->getLatestPosts();
    }
    /**
     *  Display a listing of the posts.
     */
    public function index()
    {
        $posts=$this->postModel->getPosts();

        return view('page.index')->with([
            'category'=>$this->category,
            'latestPosts'=>$this->latestPosts,
            'posts'=>$posts
        ]);
    }
    /**
     *  Show the form for creating a new post.
     */
    public function create()
    {
        return view('page.newPost')->with([
            'category'=>$this->category,
            'latestPosts'=>$this->latestPosts
        ]);
    }

    /**
     *  Store a newly created post in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required|max:255|unique:posts,title',
            'categoryID'=>'required',
            'description'=>'required|min:100'

        ]);
        if($request->hasFile('photo')){
            $this->validate($request,[
                'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            $image = Input::file('photo');
            $filename  = time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('img/posts/' . $filename);
            Image::make($image->getRealPath())->save($path);
            $request['imgPath']='img/posts/' . $filename;
            unset($request['photo']);
        }

        $this->postModel->createNewPost($request->all());
        return redirect()->route('post.index');
    }

    /**
     *  Display the specified post.
     */
    public function show($postID)
    {
        $post=$this->postModel->getSinglePost($postID);

        if (count($post) != 0) {
            $post = $post[0];
            return view('page.singlePost')->with([
                'category' => $this->category,
                'latestPosts' => $this->latestPosts,
                'post' => $post
            ]);
        }
    }

    /**
     *  Show the form for editing the specified post.
     */
    public function edit($postID)
    {
        $post = $this->postModel->getPostForEdit($postID);
        if (count($post) != 0) {
            $post = $post[0];
            return view('page.editPost')->with([
                'category' => $this->category,
                'latestPosts' => $this->latestPosts,
                'post' => $post
            ]);
        }
        abort(404);
    }

    /**
     *  Update the specified resource in storage.
     */
    public function update(Request $request, $postID)
    {
        $this->validate($request,[
            'title'=>'required|max:255',
            'categoryID'=>'required',
            'description'=>'required|min:100'
        ]);

        $data=$request->all();
        if($request->hasFile('photo')){
            $this->validate($request,[
                'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            $image = Input::file('photo');
            $filename  = time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('img/posts/' . $filename);
            Image::make($image->getRealPath())->save($path);
            $data['imgPath']='img/posts/' . $filename;
            unset($data['photo']);
        }
        // mini Description
        $len=intval(intval(strlen($data['description']))*0.15);
        $data['miniDescription']=substr($data['description'],0,$len)." ...";

        //find post by POST_ID
        $post=Post::find($postID);
        if($post->imgPath!=null){
            $path=$post->imgPath;
            if(file_exists(public_path() .'/'. $path))
                unlink(public_path() .'/'. $path);
        }
        // update data
        $post->fill($data);

        //Save changes
        $post->save();

        //return redirect()->route('post.show',$postID);
        return back()->with('status','Post successfully updated');
    }

    /**
     *  Remove the specified resource from storage.
     */
    public function delete($postID,Request $request)
    {
        if($request->ajax()){
            if($this->postModel->deletePostByID($postID)){
                echo json_encode([
                    'status'=>1
                ]);
            }else{
                echo json_encode([
                    'status'=>0
                ]);
            }
        }else{
            $this->postModel->deletePostByID($postID);
            return redirect()->route('post.index');
        }
    }
    /**
     *  Get All By Category ID
     */
    public function category($categoryID){
        $byCategory=$this->postModel->getPostsByCategory($categoryID);
        return view('page.index')->with([
            'category'=>$this->category,
            'latestPosts'=>$this->latestPosts,
            'posts'=>$byCategory
        ]);
    }
    /**
     *  Get All By Author ID
     */
    public function userPosts($authorID){
        $byAuthor=$this->postModel->getPostsByAuthor($authorID);
        return view('page.index')->with([
            'category'=>$this->category,
            'latestPosts'=>$this->latestPosts,
            'posts'=>$byAuthor
        ]);
    }
    /**
     *  Remove Post Image
     */
    public function removeImg($postID){
        if($this->postModel->removeImg($postID)){
            echo json_encode([
                'status'=>1
            ]);
        }else{
            echo json_encode([
                'status'=>0
            ]);
        }
    }
    /**
     * post search
     */
    public function search($val){
        $posts=$this->postModel->search($val);
        return view('searchResult')->with([
            'posts' => $posts
        ]);
    }
}
