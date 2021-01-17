<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller{
	public function dashboard(){
		$data['page_title'] = TITLE_DASHBOARD;
		$data['user'] = User::where('eUserRole',USER_ROLE)->count();
		return view('admin.dashboard',$data);
	}
}
