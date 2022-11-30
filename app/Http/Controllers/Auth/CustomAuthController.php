<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\admin;
use Illuminate\Http\Request;
//use Auth;
use Illuminate\Support\Facades\Auth;

class CustomAuthController extends Controller
{
//    public function __construct()
//    {
////        $this->middleware('auth:site');
////        $this->middleware('verified');
////        $this->middleware('CheckAge');
//    }

    public function Adult(){

        return view('customauth.index');

    }
    public function Site(){
        return view('site');
    }
    public function Admin(){
        return view('dashborad');
    }
    public function AdminLoginForm(){
        return view('auth.adminlogin');
    }
    public function AdminLogin(Request $request){

//        $this->validate($request,
//        ['email'=>'required|email',
//        'password'=>'required|min:6',]
//        );
//        $a=Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password]);
//        if (Auth::guard('admin')->attempt([
//            'email'=>$request->email,
//            'password'=>$request->password,
//        ]))
//        {
//        $credentials = $request->only('email');
        $email = $request->email;
        $password = $request->password;

        if (Auth::guard('admin_first_session')->attempt(['email' => $email, 'password' => $password])) {
            return
//                'yes'
                   redirect()->intended('/adminss')
                ;
        }
        return
//            'no'
//            redirect()->intended('/dashboard')
            back()->withInput($request->only('email'))
            ;
//
    }

//    protected function guard()
//    {
//        return Auth::guard('guard_admin');
//    }
}
