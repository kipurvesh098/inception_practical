<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Auth;

class LoginController extends Controller
{
	use AuthenticatesUsers;

	protected $redirectTo = '/';

	public function __construct(){
		$this->middleware('guest', ['except' => 'logout']);
	}

	public function showLoginForm(){
		$data 					= array();
		$data['page_title'] 	= __("Login");
		return view('admin.auth.login',$data);
	}
	public function login(Request $request){
		$status		= 0;
		$msg		= "Incorrect phone or password";
		$user		= array();
		
		// check validations
		$validator	= Validator::make($request->all(), [
			'phone'		=> 'required', 
			'password'	=> 'required',
		]);
		if ($validator->fails()) {
			$messages   = $validator->messages();
			$status     = 0;
			$msg        = "";

			foreach ($messages->all() as $message) {
				$msg    .= $message . "<br />";
			}
		}
		else{
			$phone			= $request->get('phone');
			$password		= $request->get('password');
			$remember_me	= ($request->get('remember_me') == 'on') ? true : false;
			if (Auth::attempt(['vPhoneNumber' => $phone, 'password' => $password],$remember_me)){
				$status	= 1;
				$msg	= "Logged in successfully";
				$user	= Auth::user();
			}
		}
		return ['status' => $status, 'msg' => $msg, 'data' => $user];
	}
	public function logout(Request $request){
		$this->guard()->logout();
		$request->session()->flush();
		$request->session()->regenerate();
		return redirect()->route('admin.login');
	}
}
