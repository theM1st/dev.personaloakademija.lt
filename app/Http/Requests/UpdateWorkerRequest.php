<?php namespace App\Http\Requests;

use Route;

class UpdateWorkerRequest extends Request {

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
        $rules = [
            'name'      => 'required',
            'email'     => 'required|unique:users,email,'.$this->id,
        ];

		return $rules;
	}

}
