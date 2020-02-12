<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Role extends FormRequest
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
        $id = $this->route()->parameter('role');

        return [
            'name' => 'required|unique:roles,title' . ($is_update ? ',' . $id : ''),
        ];
    }
}
