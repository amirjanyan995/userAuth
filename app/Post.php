<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Null_;

class Post extends Model
{
    protected $table = 'posts';
    protected $primaryKey='postID';
    protected $fillable=['title','miniDescription','description','authorID','categoryID','imgPath'];

    /**
     *      Get All Posts
     */
    public function getPosts(){
        $posts=DB::table('postview')
            ->select(['postID','title','miniDescription','authorID','categoryID','created_at','categoryName','fname','lname','imgPath','profileImgPath'])
            ->orderBy('created_at','desc')
            ->paginate(5);

        return $posts;
    }
    /**
     *
     */
    public function getSinglePost($postID){
        return DB::table('postview')
            ->select(['postID','title','description','authorID','categoryID','created_at','categoryName','fname','lname','imgPath','profileImgPath'])
            ->where([
                ['postID','=',$postID]])
            ->get();
    }

    /**
     *  Get All Posts By $authorID
     */
    public function getPostsByAuthor($authorID){
        return DB::table('postview')
            ->select(['postID','title','miniDescription','authorID','categoryID','created_at','categoryName','fname','lname','imgPath','profileImgPath'])
            ->where([
                ['authorID','=',$authorID]
                /*['authorID','=',Auth::user()->id]*/])
            ->orderBy('created_at','desc')
            ->paginate(5);
    }
    /**
     *  Get All Posts By $ategoryID
     */
    public function getPostsByCategory($categoryID){
        return DB::table('postview')
            ->select(['postID','title','miniDescription','authorID','categoryID','created_at','categoryName','fname','lname','imgPath','profileImgPath'])
            ->where([
                ['categoryID','=',$categoryID]
            ])
            ->orderBy('created_at','desc')
            ->paginate(5);

    }
    /**
     *  get post for edit
     */
    public function getPostForEdit($postID){
        return DB::table('postview')
            ->select(['postID', 'title', 'description', 'authorID', 'categoryID', 'created_at', 'categoryName', 'fname', 'lname','imgPath'])
            ->where([
                ['postID', '=', $postID],
                ['authorID', '=', Auth::user()->id]])
            ->get();
    }
    /**
     *  get post for edit
     */
    public function getPostForAdmin($postID){
        return DB::table('postview')
            ->select(['postID', 'title', 'description', 'authorID', 'categoryID', 'created_at', 'categoryName', 'fname', 'lname','imgPath'])
            ->where([
                ['postID', '=', $postID]
               ])
            ->get();
    }
    /**
     *  Get Category
     */
    public function getCategory(){
        return Category::select()
            ->orderBy('categoryName','asc')
            ->get();
    }
    /**
     *  Latest Posts
     */
    public function getLatestPosts(){
        return Post::select(['title','postID'])
            ->orderBy('created_at','desc')
            ->limit(5)
            ->get();
    }
    /**
     *  Create new post
     */
    public function createNewPost($data){
        // mini Description
        $len=intval(intval(strlen($data['description']))*0.15);
        $data['miniDescription']=substr($data['description'],0,$len)." ...";

        $data['authorID']=Auth::user()->id;
        $post=$this;
        $post->fill($data);
        $post->save();
        //Post::create($data);
    }
    /**
     *
     */
    public function deletePostByID($postID){
        $post=Post::find($postID);
        $post->delete();
        return true;
    }
    /**
     *  remove img
     */
    public function removeImg($postID){
        $post=Post::find($postID);

        $path=$post->imgPath;
        if(file_exists(public_path() .'/'. $path))
            unlink(public_path() .'/'. $path);

        $post->imgPath=null;
        $post->save();
        return true;
    }
    /**
     * search
     */
    public function search($val){
        return Post::where('title','LIKE',"%$val%")
            ->limit(5)
            ->get();
    }
}
