<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\Category;
use App\Http\Requests\CategoryFormRequest;
use Illuminate\Support\Str;
use App\Helpers\AWSHelper;

class CategoryController extends Controller
{
	/**
	 * Show Category list design table
	 * @author Purvesh Patel
	 */
	public function indexCategory() {
		$data['page_title'] = TITLE_CATEGORY;
		return view('admin.category.index',$data);
	}

	/**
	 * Get category list by datatable ajax
	 * @author Purvesh Patel
	 */
	public function fetchCategoryData(Request $request) {
		$categoryData = Category::with('parent');
		return Datatables::of($categoryData)
		->editColumn('iParentCategoryId', function ($categoryData) {
			return ($categoryData->parent)?$categoryData->parent->vTitle:'';
		})
		->editColumn('vIcon', function ($categoryData) {
			return ($categoryData->vIcon)?'<i class="'.$categoryData->vIcon.' font-size-30"></i>':'';
		})
		->editColumn('vImage', function ($categoryData) {
			return ($categoryData->vImage)?'<img src="'.AWSHelper::generatePresignedURLS3($categoryData->vImage, CATEGORY_IMAGES_PATH.$categoryData->iCategoryId.'/').'" class="table-img"/>':'';
		})
		->editColumn('tiStatus', function ($categoryData) {
			return ($categoryData->tiStatus == STATUS_ACTIVE)?'<span class="label label-success">Active</span>':'<span class="label label-danger">Inactive</span>';
		})
		->addColumn('action', function($categoryData){
			$btn = '<a href="'.route('admin.category.edit',$categoryData->iCategoryId).'" class="btn btn-social-icon"><i class="fa fa-edit"></i></a>';
			$btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$categoryData->iCategoryId.'" data-original-title="Delete" class="btn btn-social-icon deleteCategory"><i class="fa fa-trash text-danger"></i></a>';
			return $btn;
		})
		->filter(function ($query) {
			$vTitle 			= request()->get("vTitle");
			$iParentCategoryId 	= request()->get("iParentCategoryId");
			if(!empty($vTitle)){
				$query = $query->where("vTitle", "LIKE","%".addslashes($vTitle)."%");
			}

			if(!empty($iParentCategoryId)){
				$query->whereHas('parent', function ($q) use ($iParentCategoryId) {
					$q->where("vTitle", "LIKE","%".addslashes($iParentCategoryId)."%");
				});
			}
		})
		->rawColumns(['action','vIcon','vImage','tiStatus'])
		->setRowId(function($categoryData) {
			return 'category_dt_row_' . $categoryData->iCategoryId;
		})
		->make(true);
	}

	/**
	 * Show create new category page design
	 * @author Purvesh Patel
	 */
	public function createCategory() {
		$data['page_title'] 	= TITLE_CATEGORY;
		$data['categoryList'] 	= Category::select('vTitle', 'iCategoryId')->pluck('vTitle', 'iCategoryId')->toArray();
		$data['category'] 		= array();
		return view('admin.category.add',$data);
	}

	/**
	 * Save new category details
	 * @author Purvesh Patel
	 */
	public function storeCategory(CategoryFormRequest $request) {
		$vSlug 		= Str::slug($request->vTitle, '-');
		$category 	= new Category;
		$category->vTitle 				= $request->vTitle;
		$category->iParentCategoryId 	= $request->iParentCategoryId;
		$category->vSlug 				= $vSlug;
		$category->tiStatus 			= $request->tiStatus;
		$category->save();

		flash(FLASH_MESSAGE_CATEGORY_CREATE)->success();
		return \Redirect::route('admin.category.list');
	}
	
	/**
	 * Show update user page design
	 * @author Purvesh Patel
	 */
	public function editCategory($iCategoryId) {
		$data['page_title'] 	= TITLE_CATEGORY;
		$data['categoryList'] 	= Category::select('vTitle', 'iCategoryId')->pluck('vTitle', 'iCategoryId')->toArray();
		$data['category'] 		= Category::findOrFail($iCategoryId);
		return view('admin.category.edit',$data);
	}

	/**
	 * Save old user details
	 * @author Purvesh Patel
	 */
	public function updateCategory($iCategoryId, CategoryFormRequest $request) {
		$fileNameToStore 	= "";
		$category 			= Category::findOrFail($iCategoryId);
		$vSlug 				= Str::slug($request->vTitle, '-');
		$category->vTitle 				= $request->vTitle;
		$category->iParentCategoryId 	= $request->iParentCategoryId;
		$category->vSlug 				= $vSlug;
		$category->tiStatus 			= $request->tiStatus;
		$category->save();
		
		flash(FLASH_MESSAGE_CATEGORY_UPDATE)->success();
		return \Redirect::route('admin.category.list');
	}

	/**
	 * Delete Category
	 * @author Purvesh Patel
	 */
	public function deleteCategory(Request $request) {
		$iCategoryId = $request->input('iCategoryId');
		try {
			$category = Category::findOrFail($iCategoryId);
			$category->delete();
			echo 'ok';
		} catch (ModelNotFoundException $e) {
			echo 'notok';
		}
	}
}
