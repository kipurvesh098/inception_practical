<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\User;

class UserResource extends JsonResource
{
	/**
	 * Transform the resource into an array.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	public function toArray($request)
	{
		return [
			'iUserId'	 			=> $this->iUserId,
			'iUserTypeId'			=> $this->iUserTypeId,
			'vFirstName'			=> $this->vFirstName,
			'vLastName'				=> $this->vLastName,
			'vEmail'				=> $this->vEmail,
			'vPassword'				=> $this->vPassword,
			'vPhoneNumber'			=> $this->vPhoneNumber,
			'tiStatus'				=> $this->tiStatus,
			'vRememberToken'		=> $this->vRememberToken
		];
	}
}
