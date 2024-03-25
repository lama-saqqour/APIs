<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user'=> $this->user,
            'booking' => $this->booking,
            'payment_method' => $this->payment_method,
            'booking_price' => $this->booking_price,
            'paid_percentage' => $this->paid_percentage,
            'discount_amount' => $this->discount_amount,
            'booking_total' => $this->booking_amount,
            'additional_services_price' => $this->additional_services_price,
            'tax'=> $this->tax,
            'card_num'=> $this->card_num,
            
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
            
        ];
    }
}
