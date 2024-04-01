<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Support\Facades\Log;

class AdditionalInfoRequest extends FormRequest
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
        //Log::info(print_r(["Request"],true));
        $store =  [
            'bookings_id' => ['required', 'numeric'],
            'notes' => ['string', 'max:255'],
            'visa_photo' => ['string', 'max:255']
        ];
        $update =  [
            'bookings_id' => ['required', 'numeric'],
            'notes' => ['string', 'max:255'],
            'visa_photo' => ['string', 'max:255']
        ];
        return ($this->method() === 'POST') ? $store : $update;
    }
}
