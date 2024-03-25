<?php

namespace App\Http\Requests\Sightseeing;

use Illuminate\Foundation\Http\FormRequest;

class SightseeingRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'numeric'],
        ];
        $update =  [
            'name' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'numeric'],
        ];
        return ($this->method() === 'POST') ? $store : $update;
    }
}
