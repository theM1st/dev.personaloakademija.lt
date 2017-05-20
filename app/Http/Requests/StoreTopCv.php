<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTopCv extends FormRequest
{
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
        return [

            'name' => 'required',
            'gender' => 'required',
            'age' => 'required|integer',
            'city_id' => 'required|integer',
            'telephone' => 'required',
            'email' => 'required|email',
            'scope_id' => 'required|integer',
            'scope_category_id' => 'required|integer',
            'cv_status' => 'required',
        ];
    }
}
