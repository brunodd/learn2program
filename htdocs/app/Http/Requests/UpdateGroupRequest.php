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
        //This check is rather redundant since we tackle this problem already in the create & edit functions
        if (isFounderOfGroup($this->id, Auth::id()))
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
            'name' => 'required|unique:groups,name,' . $this->id . '|max:30'
        ];
	}

}
