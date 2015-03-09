<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use Auth;

class CreateSerieRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
        //This check is rather redundant since we tackle this problem allready in the create & edit functions
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
            'title' =>'required|max:50',
            'subject' => 'required|max:50',
            'difficulty' => 'required'
		];
	}

}
