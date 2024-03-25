<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if(auth()->user()->is_admin) {
            return true;
        }
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'string|nullable',
            'email' => 'string|nullable',
            'phone' => 'string|nullable',
            'whatsapp' => 'string|nullable',
            'facebook' => 'string|nullable',
            'instagram' => 'string|nullable',
            'twitter' => 'string|nullable',
        ];
    }
}
