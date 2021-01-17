<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminFormRequest extends FormRequest
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
		$iUserId 			= (int) $this->input('iUserId', 0);
		$vPassword 			= 'required|min:6';
		$vConfirmPassword 	= 'required|min:6|same:vPassword';
		$iUserIdstr 		= '';
		if ($iUserId > 0) {
			$iUserIdstr 	= ',' . $iUserId. ',iUserId';
			$vPassword 		= '';
			$vConfirmPassword = '';
		}
		return [
			'vFirstName' 		=> 'required',
			'vLastName' 		=> 'required',
			'vEmail' 			=> 'nullable|unique:'.TBL_USERS.',vEmail' . $iUserIdstr . '|email',
			'vPassword' 		=> $vPassword,
			'vConfirmPassword' 	=> $vConfirmPassword,
			'vPhoneNumber' 		=> 'required|unique:'.TBL_USERS.',vPhoneNumber' . $iUserIdstr . '|numeric|digits_between:1,15',
			'tiStatus' 			=> 'required',
		];
	}
}
