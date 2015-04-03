<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateUserRequest extends Request {

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
		return [
		    'username' => 'required|unique:users|min:3|max:20',
            'pass' => 'required|min:5|max:20|same:pass_confirmation',
            'mail' => 'required|max:50',
            //TODO file image
            //image -> png, jpg, ... only
		];
	}

}
