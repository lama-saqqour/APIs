<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingsResource extends JsonResource
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
            'date' => $this->date,
            'time' => $this->time,
            'return_date' => $this->return_date,
            'return_time' => $this->return_time,
            'booking_status' => $this->booking_status,
            'booking_type' => $this->booking_type,
            'is_return' => $this->is_return,
            'is_paid' => $this->is_paid,
            'is_deleted' => $this->is_deleted,
            'notes'=> $this->notes,
            'user'=> $this->user,
            'trip_price'=> $this->trip_price,
            'site_price'=> $this->site_price,
            'additional_info'=> $this->additional_info,
            'payments'=> $this->payments,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
            
        ];
    }
}
