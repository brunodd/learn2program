<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use Auth;

class UpdateGroupRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
        //Already done in GroupsController@edit
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
            'name' => 'required|unique:groups,name,' . $this->id . '|max:30'
        ];
	}

}
