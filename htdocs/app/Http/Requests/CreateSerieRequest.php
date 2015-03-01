<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateSerieRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		if ( Auth::check() )
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
            'title' =>'required|max:50',
            'subject' => 'required|max:50',
            'difficulty' => 'required'
		];
	}

}
