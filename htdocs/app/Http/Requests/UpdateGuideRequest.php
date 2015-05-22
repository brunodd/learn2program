<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateGuideRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
        //taken care of in GuidesController@edit
        return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
            'content' => 'required'
		];
	}

}
