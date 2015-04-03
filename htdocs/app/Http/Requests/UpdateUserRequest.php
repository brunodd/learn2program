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

            //TODO Armin: will use validator in userscontroller@update because rules change depending on which fields are filled in, something like that

		];
	}

}
