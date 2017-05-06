<?php namespace App\Http\Requests;

use Illuminate\Support\Facades\Input;

class CreateOfferRequest extends Request {

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
            'city_id' => 'required',
            'scope_id' => 'required',
            'offer_duration' => 'required|integer',
            'work_position' => 'required',
            'logo'     => 'image|max:10240',
            'company_description' => 'required|min:10',
            'offer_description' => 'min:10',
            'offer_requirements' => 'min:10',
            'offer_skills' => 'min:10',
            'company_offers' => 'min:10',
            'salary_from'   => 'numeric',
            'salary_to'   => 'numeric',
            'recruitment_days'   => 'integer',
        ];

        if (Input::get('recruitment') == 'days') {
            $rules['recruitment_days'] = 'required|integer';
        }

        if (strpos(\Route::currentRouteAction(), 'preview') !== false)
        {
            unset($rules['logo']);
        }

		return $rules;
	}
}
