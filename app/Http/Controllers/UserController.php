<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserController extends Controller
{
    public function create()
    {
    	$user = new User();
    	$user->username = "user123";
    	$user->password = bcrypt('user123');
    	$user->save();
    }
    public function postdangnhap(Request $request)
    {
    	// return $request->all();
    	if(Auth::attempt(['username' => $request->username,'password' => $request->password])){
    		return "Đăng nhập thành công";
    	}else{
    		return "Đăng nhập không thành công";
    	}
    }
    public function postdangky(Request $request)
    {
        $user = new User();
        $user->username = $request->username;
        $user->password = $request->password;
        $user->save();
        
    }
}
