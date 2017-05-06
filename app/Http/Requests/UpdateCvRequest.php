<?php namespace App\Http\Requests;

use Route;

class UpdateCvRequest extends Request {
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
        $rules = [];

        if (Route::input('state') == 1) {
            $rules = (new CreateCvRequest())->rules();
        } elseif (Route::input('state') == 3) {
            $rules['study_from_year'] = 'required|integer';
            $rules['study_to_year'] = 'required|integer';
            $rules['institution_name'] = 'required';
            $rules['study_scope'] = 'required';
            $rules['specialty'] = 'required';
            $rules['study_grade_id'] = 'required|integer';
        } elseif (Route::input('state') == 4 && !Request::get('skip')) {
            if (Request::get('form_type') == 'works') {
                $rules['interested_work_city_id'] = 'required|array|min:1';
                $rules['work_scope_id'] = 'required|array|min:1';
                $rules['interested_work_position'] = 'sometimes|required';
            }
            if (Request::get('form_type') == 'experiences') {
                //$rules['work_from_year'] = 'required|integer';
                //$rules['work_to_year'] = 'required|integer';
                //$rules['company_name'] = 'required';
                //$rules['work_position'] = 'required';
            }
        } elseif (Route::input('state') == 5) {
            $rules['first_language_id'] = 'required|integer';
        } elseif (Route::input('state') == 8 && !Request::get('skip')) {
            $rules['participation_type_id'] = 'required|integer';
            $rules['participation_year'] = 'required|integer';
            $rules['participation_name'] = 'required';
            $rules['participation_organizer'] = 'required';
            $rules['participation_description'] = 'required';
        } elseif (Route::input('state') == 9 && !Request::get('skip')) {
            $rules['recomendation_type_id'] = 'required|integer';
            $rules['recomendation_year'] = 'required|integer';
            $rules['recomendation_name'] = 'required';
            $rules['recomendation_description'] = 'required';
        } elseif (Route::input('state') == 10 && !Request::get('skip')) {
            $rules['trial_salary'] = 'integer';
            $rules['full_salary'] = 'integer';
            $rules['driving_a_year'] = 'date_format:Y';
            $rules['driving_b_year'] = 'date_format:Y';
            $rules['driving_c_year'] = 'date_format:Y';
            $rules['driving_d_year'] = 'date_format:Y';
        }

		return $rules;
	}

}
