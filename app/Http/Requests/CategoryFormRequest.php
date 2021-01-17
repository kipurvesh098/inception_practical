<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryFormRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		$iCategoryId 	= (int) $this->input('iCategoryId', 0);
		$iCategoryIdstr 	= '';
		if ($iCategoryId > 0) {
			$iCategoryIdstr = ',' . $iCategoryId. ',iCategoryId';
		}
		return [
			'vTitle' 		=> 'required|max:255|unique:'.TBL_CATEGORY.',vTitle' . $iCategoryIdstr,
			'vIcon' 		=> 'nullable|image|max:1024|mimes:jpeg,jpg,png',
			'vImage' 		=> 'nullable|image|max:1024|mimes:jpeg,jpg,png',
			'vBannerImage' 	=> 'nullable|image|max:1024|mimes:jpeg,jpg,png',
			'tiStatus' 		=> 'required',
		];
	}
}
