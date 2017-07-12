<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'fname'     => 'bail|required|string|max:32|min:3|regex:/^[a-zA-Z]*$/',
            'lname'     => 'bail|required|string|max:32|min:3|regex:/^[a-zA-Z]*$/',
            'email'     => 'bail|required|string|email|max:64|min:8|unique:users',
            'phone'     => 'bail|required|max:16|unique:users|regex:/^\+374\-[0-9]{2}-[0-9]{2}-[0-9]{2}-[0-9]{2}$/',
            'bDate'     =>  'date',
            'password'  => 'required|string|min:6|confirmed',
            'species'   =>  'required'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'fname'     => $data['fname'],
            'lname'     => $data['lname'],
            'email'     => $data['email'],
            'phone'     => $data['phone'],
            'bDate'     => $data['bDate'],
            'password'  => bcrypt($data['password']),
            'species'   => $data['species'],
        ]);
    }
}
