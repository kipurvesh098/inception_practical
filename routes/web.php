<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;

# Admin Routes 
Route::prefix('admin')->group(function () {
	# Admin Auth Routes
	Route::group(['namespace' => 'Auth','as'=>'admin.'], function () {

		// Authentication Routes...
		Route::get('/', [LoginController::class, 'showLoginForm']);
		Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
		Route::post('login', [LoginController::class, 'login'])->name('login.submit');
		Route::get('logout', [LoginController::class, 'logout'])->name('logout');
	});

	# Admin Login after Routes
	Route::group(['namespace' => 'Admin', 'middleware' => 'admin','as'=>'admin.'], function () {
		# Dashboard
		Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

		# Start Admin CRUD
		Route::prefix('admin')->group(function () {
			Route::group(['as'=>'admin.'], function () {
				Route::get('list', [AdminController::class, 'indexAdmin'])->name('list');
				Route::get('create', [AdminController::class, 'createAdmin'])->name('create');
				Route::post('store', [AdminController::class, 'storeAdmin'])->name('store');
				Route::get('fetch', [AdminController::class, 'fetchAdminData'])->name('fetch.data');
				Route::get('edit/{iUserId}', [AdminController::class, 'editAdmin'])->name('edit');
				Route::put('update/{iUserId}', [AdminController::class, 'updateAdmin'])->name('update');
				Route::delete('delete', [AdminController::class, 'deleteAdmin'])->name('delete');
			});
		});
		# End Admin CRUD

		# Start Category CRUD
		Route::prefix('category')->group(function () {
			Route::group(['as'=>'category.'], function () {
				Route::get('list', [CategoryController::class, 'indexCategory'])->name('list');
				Route::get('create', [CategoryController::class, 'createCategory'])->name('create');
				Route::post('store', [CategoryController::class, 'storeCategory'])->name('store');
				Route::get('fetch', [CategoryController::class, 'fetchCategoryData'])->name('fetch.data');
				Route::get('edit/{iCategoryId}', [CategoryController::class, 'editCategory'])->name('edit');
				Route::put('update/{iCategoryId}', [CategoryController::class, 'updateCategory'])->name('update');
				Route::delete('delete', [CategoryController::class, 'deleteCategory'])->name('delete');
			});
		});
		# End Category CRUD
	});
});

Route::get('/', [LoginController::class, 'showLoginForm']);