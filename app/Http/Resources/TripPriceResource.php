<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TripPriceResource extends JsonResource
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
            'car_id' => $this->car_id,
            'trip_id' => $this->trip_id,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'initial_price' => $this->initial_price,
            'car' => $this->car,
            'trip' => $this->trip,
            'bookings' => BookingsResource::collection($this->bookings),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
        ];
    }
}
