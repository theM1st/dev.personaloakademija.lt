<?php namespace App\Http\Requests;


class CreateBannerRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
        if (\Auth::check())
        {
            return true;
        }

        return false;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
        $rules = [
            'banner_name'  => 'required',
            'banner_link'  => 'required',
            'banner_image' => 'image|max:10240',
            'banner_zone'  => 'required',
        ];

		return $rules;
	}
}
