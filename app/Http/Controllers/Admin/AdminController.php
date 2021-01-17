<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\User;
use App\Http\Requests\AdminFormRequest;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		//
	}

	/**
	 * Show admin details in table
	 * @author Purvesh Patel
	 */
	public function indexAdmin() {
		$data['page_title'] = TITLE_ADMIN_LIST;
		return view('admin.admin.index',$data);
	}

	/**
	 * Get admin list by datatable ajax
	 * @author Purvesh Patel
	 */
	public function fetchAdminData(Request $request) {
		$adminData = User::AdminRole();
		return Datatables::of($adminData)
		->editColumn('tiStatus', function ($adminData) {
			return ($adminData->tiStatus == STATUS_ACTIVE)?'<span class="label label-success">Active</span>':'<span class="label label-danger">Inactive</span>';
		})
		->addColumn('action', function($adminData){
			$btn = '<a href="'.route('admin.admin.edit',$adminData->iUserId).'" class="btn btn-social-icon"><i class="fa fa-edit"></i></a>';
			$btn = $btn.'  <a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$adminData->iUserId.'" data-original-title="Delete" class="btn btn-social-icon deleteAdmin"><i class="fa fa-trash text-danger"></i></a>';
			return $btn;
		})
		->filter(function ($query) {
			$vFirstName 	= request()->get("vFirstName");
			$vLastName 		= request()->get("vLastName");
			$vEmail 		= request()->get("vEmail");
			$vPhoneNumber 	= request()->get("vPhoneNumber");
			if(!empty($vFirstName)){
				$query = $query->where("vFirstName", "LIKE","%".addslashes($vFirstName)."%");
			}
			if(!empty($vLastName)){
				$query = $query->where("vLastName", "LIKE","%".addslashes($vLastName)."%");
			}
			if(!empty($vEmail)){
				$query = $query->where("vEmail", "LIKE","%".addslashes($vEmail)."%");
			}
			if(!empty($vPhoneNumber)){
				$query = $query->where("vPhoneNumber", "LIKE","%".$vPhoneNumber."%");
			}
		})
		->rawColumns(['action','tiStatus'])
		->setRowId(function($adminData) {
			return 'admin_dt_row_' . $adminData->iUserId;
		})
		->make(true);
	}

	/**
	 * Show create new admin page design
	 * @author Purvesh Patel
	 */
	public function createAdmin() {
		$data['page_title'] = TITLE_ADMIN_LIST;
		$data['users'] 		= array();
		return view('admin.admin.add',$data);
	}

	/**
	 * Save new admin details
	 * @author Purvesh Patel
	 */
	public function storeAdmin(AdminFormRequest $request) {
		$user 				= new User;
		$user->vFirstName 	= $request->vFirstName;
		$user->vLastName 	= $request->vLastName;
		$user->vEmail 		= $request->vEmail;
		$user->vPassword 	= Hash::make($request->vPassword);
		$user->vPhoneNumber = $request->vPhoneNumber;
		$user->tiStatus 	= $request->tiStatus;
		$user->save();

		flash(FLASH_MESSAGE_ADMIN_CREATE)->success();
		return \Redirect::route('admin.admin.list');
	}
	
	/**
	 * Show update admin page design
	 * @author Purvesh Patel
	 */
	public function editAdmin($iUserId) {
		$data['page_title'] = TITLE_ADMIN_LIST;
		$data['users'] 		= User::findOrFail($iUserId);
		return view('admin.admin.edit',$data);
	}

	/**
	 * Save old admin details
	 * @author Purvesh Patel
	 */
	public function updateAdmin($iUserId, AdminFormRequest $request) {
		$fileNameToStore 	= "";
		$user 				= User::find($iUserId);
		$user->vFirstName 	= $request->vFirstName;
		$user->vLastName 	= $request->vLastName;
		$user->vEmail 		= $request->vEmail;
		if (!empty($request->vPassword)) {
			$user->vPassword = Hash::make($request->vPassword);
		}
		$user->vPhoneNumber = $request->vPhoneNumber;
		$user->tiStatus 	= $request->tiStatus;
		$user->save();

		flash(FLASH_MESSAGE_ADMIN_UPDATE)->success();
		return \Redirect::route('admin.admin.list');
	}

	/**
	 * Delete Admin data
	 * @author Purvesh Patel
	 */
	public function deleteAdmin(Request $request) {
		$iUserId = $request->input('iUserId');
		try {
			$user = User::findOrFail($iUserId)->delete();
			echo 'ok';
		} catch (ModelNotFoundException $e) {
			echo 'notok';
		}
	}
}
