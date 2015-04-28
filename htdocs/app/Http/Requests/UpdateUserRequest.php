<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use Auth;

class UpdateUserRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
        //Already done in UsersController@edit
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
            //TODO: finish this
            //'username' => 'required|unique:users|min:3|max:50',
            //'mail' => 'required|max:50',
            //TODO file image
            //image -> png, jpg, ... only

		];
	}

}
