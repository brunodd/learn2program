<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use Auth;

class CreateAnswerRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
        if ( Auth::check() ) //maybe restrict the maker from making his own exercise?
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
            'given_code' => 'required'
		];
	}

}
