<?php

namespace App\Http\Requests\Trip;

use Illuminate\Foundation\Http\FormRequest;

class TripPriceRequest extends FormRequest
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
            'car_id' => ['required', 'numeric'],
            'trip_id' => ['required', 'numeric'],
            'start_date' => ['date'],
            'end_date' => ['date'],
            'initial_price' => ['numeric']
        ];
        $update =  [
            'car_id' => ['numeric'],
            'trip_id' => ['numeric'],
            'start_date' => ['date'],
            'end_date' => ['date'],
            'initial_price' => ['numeric']
        ];
        return ($this->method() === 'POST') ? $store : $update;
    }
}
