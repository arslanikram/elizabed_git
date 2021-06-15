<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Session;

class LoginController extends Controller
{
    public function index(){
    	return view('admin.login.index');
    }

    public function login(Request $request){

    	$request->validate([
    		'email' => 'required',
    		'password' => 'required'
    	]);

    	$email = $request->email;
    	$password = md5($request->password);

    	$admin = Admin::find(1);

    	$db_email = $admin->email;
    	$db_password = $admin->password;

    	if($email === $db_email && $password === $db_password){
    		Session::put('logged_in', 'active');
    		return redirect('admin/dashboard')->with('success', 'Admin Login Successfully');

    	}else{

    		return redirect('admin/login')->with('fail', 'Invalid email or password');

    	}


    }


    public function logout(){
    	Session::forget('logged_in');
    	return redirect('admin/login');
    }




}
