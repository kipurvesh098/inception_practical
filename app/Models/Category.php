<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	use HasFactory;
	protected $table 		= TBL_CATEGORY;
	protected $primaryKey 	= 'iCategoryId';
	const CREATED_AT 		= 'dtCreatedAt';
	const UPDATED_AT 		= 'dtUpdatedAt';

	protected $fillable = ['iParentCategoryId', 'vTitle', 'vSlug', 'tiStatus', 'dtCreatedAt', 'dtUpdatedAt'];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function parent(){
		return $this->belongsTo('App\Models\Category', 'iParentCategoryId','iCategoryId');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\hasMany
	 */
	public function children(){
		return $this->hasMany('App\Models\Category', 'iParentCategoryId','iCategoryId');
	} 

	/**
	 * laravel Query Scopes
	 * get null parent id
	 * @author Purvesh Patel
	 */
	public function scopeMainCategoryList($query){
		return $query->whereNull('iParentCategoryId');
	}

	/**
	 * laravel Query Scopes
	 * Check user status is active or inactive
	 * 1-active,0-inactive
	 * @author Purvesh Patel
	 */
	public function scopeCategoryStatus($query)
	{
		return $query->where('tiStatus',STATUS_ACTIVE);
	}
}
