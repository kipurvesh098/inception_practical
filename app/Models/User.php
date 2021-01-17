<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
	use HasFactory, Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $table 		= TBL_USERS;
	protected $primaryKey 	= 'iUserId';
	const CREATED_AT 		= 'dtCreatedAt';
	const UPDATED_AT 		= 'dtUpdatedAt';

	protected $fillable = ['eUserRole', 'vFirstName', 'vLastName', 'vEmail', 'vPhoneNumber', 'vPassword', 'tiStatus', 'vRememberToken', 'dtCreatedAt', 'dtUpdatedAt'];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'vPassword',
		'vRememberToken',
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'dtEmailVerifiedAt' => 'datetime',
	];

	public function getAuthPassword() {
		return $this->vPassword;
	}


	/**
	 * laravel Query Scopes
	 * Check user status is active or inactive
	 * 1-Active,2-Inactive
	 * @author Purvesh Patel
	 */
	public function scopeUserStatus($query) {
		return $query->where('tiStatus',STATUS_ACTIVE);
	}

	/**
	 * laravel Query Scopes
	 * Get only user data
	 * eUserRole = User 
	 * @author Purvesh Patel
	 */
	public function scopeUserRole($query) {
		return $query->where('eUserRole',USER_ROLE);
	}

	/**
	 * laravel Query Scopes
	 * Get only user data
	 * eUserRole = Admin 
	 * @author Purvesh Patel
	 */
	public function scopeAdminRole($query) {
		return $query->where('eUserRole',ADMIN_ROLE);
	}
}