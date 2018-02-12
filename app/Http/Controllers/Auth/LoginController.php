<?php

namespace App\Http\Controllers\Auth;

use Request;
use Auth;
use bcrypt;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    //use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
   // protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    // }
    public function login()
    {
        $email=Request::get('email');
        $password=Request::get('password');
        $site=Request::get('site');
         if (Auth::attempt(['email' => $email, 'password' => $password,'site'=>$site])) {
            // Authentication passed...
            $data['login']="true";
        }
        else
        {
            $data['login']="false";
        }
        return $data;
    }
    public function register()
    {
        $email=Request::get('email');
        $password1=Request::get('password');
        $password=bcrypt(Request::get('password'));
        $username=Request::get('username');
        $site=Request::get('site');
        $user=new User;
        $user->name=$username;
        $user->email=$email;
        $user->site=$site;
        $user->password=$password;
        $user2=User::whereRaw("name='".$username."'")->first();
        if(count($user2)>0)
        {
            $data['login']="false";
            $data['message']="Username Already Taken";
            return $data;
        }
        $user3=User::whereRaw("email='".$email."'")->first();
        if(count($user3)>0)
        {
            $data['login']="false";
            $data['message']="Email Already Taken";
            return $data;
        }
        if($user->save())
        {
            $data['register']="true";
        }
        else
        {
            $data['register']="false";
        }
        if (Auth::attempt(['email' => $email, 'password' => $password1,'site'=>$site])) {
            // Authentication passed...1
            $data['login']="true";
        }
        else
        {
            $data['login']="false";
            $data['message']="Wrong username and Password";
        }
        return $data;
    }
    public function authcheck()
    {
            if(Auth::check())
            {
                  $data['login']="true";
            }
            else
            {
                 $data['login']="false";
            }
            return $data;
    }
    public function logout()
    {
        Auth::logout();
         $data['logout']="true";
         return $data;
    }

}
