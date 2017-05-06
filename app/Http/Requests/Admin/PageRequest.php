<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

class PageRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $languages = appLanguages();

        $rules = [];

        foreach ($languages as $lang) {
            $rules["title_$lang->locale"] = 'sometimes|required|string|max:200';
        }

        return $rules;
    }
}
