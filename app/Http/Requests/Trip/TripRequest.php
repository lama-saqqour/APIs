<?php

namespace App\Http\Requests\Trip;

use Illuminate\Foundation\Http\FormRequest;

class TripRequest extends FormRequest
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
            'from' => ['string', 'max:255'],
            'to' => ['string', 'max:255'],
            'start_date' => ['date'],
            'end_date' => ['date'],
            'prices' => ['numeric'],
        ];
        $update =  [
            'from' => ['string', 'max:255'],
            'to' => ['string', 'max:255'],
            'start_date' => ['date'],
            'end_date' => ['date'],
            'prices' => ['numeric'],
        ];
        return ($this->method() === 'POST') ? $store : $update;
    }
}
