<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class User extends FormRequest
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
        $is_update = $this->isMethod('patch');
        $id = $this->route()->parameter('user');

        $rules = [
            'email' => 'required|email|unique:users,email' . ($is_update ? ',' . $id : ''),
            'first_name' => 'required',
            'last_name' => 'required',
            'role_id' => 'required|exists:roles,id'
            
        ];

        if(!$is_update) {
            $rules['password'] = 'required';
        }

        return $rules;
    }
}
