<?php

namespace App;

use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fname','lname', 'email','phone','bDate','password','profileImgPath','species'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getUserByID($userID){
        return User::find($userID);
    }
    /**
     *  update user information
     */
    public function updateUserInformation($userID,$data){
        $user=User::find($userID);
        $user->fill($data);
        $user->save();
        return true;
    }
    /**
     * delete user
     */
    public function deleteUser($userID){
        $user=User::find($userID);
        if($user->role==5){
            return false;
        }else{
            $user->delete();
            return true;
        }

    }
    /**
     * as admin
     */
    public function asAdmin($userID,$data){
        $user=User::find($userID);
        $user->role=$data['role'];
        $user->save();
        return true;
    }
}
