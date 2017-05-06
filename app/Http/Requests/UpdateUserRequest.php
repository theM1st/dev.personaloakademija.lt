<?php namespace App\Http\Requests;

use Route;
use Input;
use App\User;

class UpdateUserRequest extends Request {

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
        $rules = (new RegisterUserRequest())->rules();
        unset($rules['email']);

        $id = $this->route('users');

        $user = User::findOrFail($id);

        if ($user->user_type == 'company') {
            if (\Auth::user()->isAdmin()) {
                $rules['email'] = 'required|unique:users,email,' . $user->id;
                $rules['company_name'] = 'required';
            }
            $rules['company_code'] = 'required';
            $rules['company_position'] = 'required';
            $rules['company_address'] = 'required';
        } else {
            $rules['email'] = 'required|unique:users,email,' . $user->id;
        }

        return $rules;
    }
}