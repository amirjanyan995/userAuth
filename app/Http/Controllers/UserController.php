<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private $category=null;
    private $latestPosts=null;
    private $postModel=null;
    private $userModel=null;
    public function __construct()
    {
        $this->middleware('auth');
        if($this->postModel==null)
            $this->postModel=new Post();

        if($this->userModel==null)
            $this->userModel=new User();

        $this->category=$this->postModel->getCategory();
        $this->latestPosts=$this->postModel->getLatestPosts();
    }
    public function removeProfileIMG(){

    }
    public function uploadProfileIMG(Request $request){

    }
    public function changePassword(Request $request){
        if(Auth::Check())
        {
            $request_data = $request->All();
            $validator = $this->validatePassword($request_data);
            if($validator->fails())
            {
                $error=$validator->getMessageBag()->toArray();
                return redirect()->route('editProfile')->withErrors($error);
            }
            else
            {
                $current_password = Auth::User()->password;
                if(Hash::check($request_data['current-password'], $current_password))
                {
                    $user_id = Auth::User()->id;
                    $obj_user = User::find($user_id);
                    $obj_user->password = Hash::make($request_data['password']);;
                    $obj_user->save();
                    return redirect()->route('editProfile');
                }
                else
                {
                    $error = array('current-password' => 'Please enter correct current password');
                    return redirect()->route('editProfile')->withErrors($error);
                }
            }
        }
        else
        {
            return redirect()->route('login');
        }
    }
    public function validatePassword(array $data)
    {
        $messages = [
            'current-password.required' => 'Please enter current password',
            'password.required' => 'Please enter password',
        ];

        $validator = Validator::make($data, [
            'current-password' => 'required',
            'password' => 'required|same:password',
            'password_confirmation' => 'required|same:password',
        ], $messages);

        return $validator;
    }
    public function editProfile(){
        return view('page.editProfile')->with([
            'category'=>$this->category,
            'latestPosts'=>$this->latestPosts
        ]);
    }
    public function basicInfo(Request $request){

        $this->validate($request,[
            'fname'     => 'bail|required|string|max:32|min:3|regex:/^[a-zA-Z]*$/',
            'lname'     => 'bail|required|string|max:32|min:3|regex:/^[a-zA-Z]*$/',
            'email'     => 'bail|required|string|email|max:64|min:8',
            'phone'     => 'bail|required|max:16|regex:/^\+374\-[0-9]{2}-[0-9]{2}-[0-9]{2}-[0-9]{2}$/',
            'bDate'     =>  'date',
            'species'   =>  'required'
        ]);
        $user=User::find(Auth::user()->id);
        $user->fill($request->all());
        $user->save();
        return back()->with('status','Your information has been successfully updated.');
    }
}