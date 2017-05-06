<?php namespace App\Http\Requests;

class CreateCvRequest extends Request {

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
            'name' => 'required',
            'birthday' => 'required|date_format:"Y-m-d"',
            'gender' => 'required|in:M,F',
            'email' => 'required|email',
            'telephone' => 'required',
            'photo'     => 'image|max:10240',
            'cv_file'   => 'mimes:doc,pdf',
		];

		$rules['job_city_id'] = 'required|integer';

		return $rules;
	}

}
