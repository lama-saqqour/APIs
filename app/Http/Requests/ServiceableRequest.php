<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class ServiceableRequest extends FormRequest
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
            'serviceable_id' => ['required', 'numeric'],
            'services_id' => ['required', 'numeric']
        ];
        $update =  [
            'serviceable_id' => ['required', 'numeric'],
            'services_id' => ['required', 'numeric']
        ];
        return ($this->method() === 'POST') ? $store : $update;
    }
}
