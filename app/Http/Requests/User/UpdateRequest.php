<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'password' => ['nullable', 'string', 'max:255'],
            'role_id' => ['required', 'exists:roles,id'],
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'First Name is Must',
            'last_name.required' => 'Last Name is Must',
            'email.required' => 'email is Must',
            'role_id.required' => 'Role is Must',
        ];
    }
}
