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
        //This check is rather redundant since we tackle this problem already in the edit functions
        if ( !empty(loadUser($this->id)) and (loadUser($this->id)[0]->id == Auth::id()))
        {
		    return true;
	    }
        else
        {
            return false;
        }
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
            'username' => 'required|unique:users,username,' . loadUser($this->id)[0]->id . '|min:3|max:20'
		];
	}

}
