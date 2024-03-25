<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $store =  [
            'name' => 'required|string|min:6|max:55',
            'password' =>  [
                Password::min(8)
                ->letters()
                ->symbols(),
                'confirmed'
            ],
            'phone' => 'sometimes|nullable|string|min:6|max:20|unique:users,phone,',
            'email' => 'email|max:100|unique:users,email,',
            'user_type_id' => 'required|numeric',
        ];
        $update =  [
            'name' => 'required|string|min:6|max:150',
            'phone' => 'sometimes|nullable|string|min:6|max:20|unique:users,phone,'.$this->id,
            'email' => 'email|max:100|unique:users,email,'.$this->id,
        ];
        return ($this->method() === 'POST') ? $store : $update;

    }
}
