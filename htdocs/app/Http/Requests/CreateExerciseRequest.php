<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use Auth;

class CreateExerciseRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		//This check is rather redundant since we tackle this problem already in the createExercise function
        //The other possibility can occur during update, which is also handled locally...
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
			'question' => 'required',
            'expected_result' => 'required',
            'start_code' => 'required'
		];
	}

}
