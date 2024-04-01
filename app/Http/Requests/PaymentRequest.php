<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
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
            'bookings_id' => ['required', 'numeric'],
            'payment_method_id' => ['required', 'numeric'],
            'user_id' => ['required', 'numeric'],
            'booking_price' => ['required', 'numeric'],
            'paid_percentage' => ['required', 'numeric'],
            'discount_amount' => ['numeric'],
            'booking_total' => ['numeric'],
            'additional_services_price' => ['numeric'],
            'tax' => ['numeric'],
            'card_num' => ['string', 'max:255']
        ];
        $update =  [
            'bookings_id' => ['required', 'numeric'],
            'payment_method_id' => ['required', 'numeric'],
            'user_id' => ['required', 'numeric'],
            'booking_price' => ['required', 'numeric'],
            'paid_percentage' => ['required', 'numeric'],
            'discount_amount' => ['numeric'],
            'booking_total' => ['numeric'],
            'additional_services_price' => ['numeric'],
            'tax' => ['numeric'],
            'card_num' => ['string', 'max:255']
        ];
        return ($this->method() === 'POST') ? $store : $update;
    }
}
