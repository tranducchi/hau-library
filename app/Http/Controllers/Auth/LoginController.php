<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

//    public function authenticate(Request $request)
//    {
//        $credentials = $request->only('student_id', 'password');
//        if (Auth::attempt($credentials)) {
//            // Authentication passed...
//            return redirect()->intended('/admin');
//        }
//    }
     public function redirectPath()
     {
         if (\Auth::user()->role == '1') {
             return "/admin";
             // or return route('routename');
         }

         return "/";
         $redirectTo = RouteServiceProvider::HOME;
     }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
