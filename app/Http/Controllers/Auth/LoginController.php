<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    //
    public function getLogin() {
        return view('auth.login');
    }
    public function postLogin(Request $request) {
        // nơi mình sẽ xử lý code

       // dd($request->all());
        $rules = [
          'email'=>'required|email',
          'password'=>'required'
        ];
        $messages = [
          'email.required'=> 'moi ban nhap email',
          'email.email'=>'moi ban nhap dung dinh dang email',
          'password.required' =>'moi ban nhap password'
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        if ($validator->fails()) {
            return redirect('login')->withErrors($validator);
        } else {
            $email = $request->input('email');
            $password = $request->input('password');
            if (Auth::attempt(['email'=>$email,'password'=>$password])) {
                return redirect('test');
            } else {
                Session::flash('error','sai email va mat khau');
               return redirect('login');
            }
        }
    }

    public function getLogout() {
        Auth::logout();
        return redirect('login');
    }
}
