<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

class SlideshowRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'image' => 'required'
        ];

        return $rules;
    }
}
