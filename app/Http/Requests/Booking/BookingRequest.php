<?php

namespace App\Http\Requests\Booking;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
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
            'is_return' => ['required', 'boolean'],
            'date' => ['required', 'date'],
            'time' => ['required', 'date_format:H:i'],
            'return_date' => ['date'],
            'return_time' => ['date_format:H:i'],
            'booking_type' => ['required','string','in:trip,hourly'],
            'trip_price_id' => ['required_without:site_price_id', 'int'],
            'site_price_id' => ['required_without:trip_price_id', 'int'],
            'booking_price' => ['required','numeric'],
            'additional_services_price' => ['numeric'],
            'paid_percentage' => ['numeric'],
            'discount_amount' => ['numeric'],
            'booking_total' => ['required','numeric'],
            'tax' => ['numeric'],
            'name' => ['required','string','max:55'],
            'email' => ['required','email'],
            'whatsapp' => ['required','phone:mobile:INTERNATIONAL'],
            'payment_method_id' => ['required', 'numeric'],
            'visa_photo' => ['file', 'nullable'],
            'notes' => ['string'],
        ];
        $update =  [
            'date' => ['required', 'date'],
            'time' => ['required', 'date_format:H:i'],
            'return_date' => ['date'],
            'return_time' => ['date_format:H:i'],
            'booking_type' => ['required','string','in:trip,hourly'],
            'trip_price_id' => ['required_without:site_price_id', 'int'],
            'site_price_id' => ['required_without:trip_price_id', 'int'],
            'booking_price' => ['required','numeric'],
            'additional_services_price' => ['numeric'],
            'paid_percentage' => ['numeric'],
            'discount_amount' => ['numeric'],
            'booking_total' => ['required','numeric'],
            'tax' => ['numeric'],
            'name' => ['required','string','max:55'],
            'email' => ['required','email'],
            'whatsapp' => ['required','phone:mobile:INTERNATIONAL'],
            'payment_method_id' => ['required', 'numeric'],
            'visa_photo' => ['file', 'nullable'],
            'notes' => ['string'],
        ];
        return ($this->method() === 'POST') ? $store : $update;
    }
}
