<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CarsResource extends JsonResource
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
            'name' => $this->name,
            'image' => $this->image,
            'car_category' => $this->category,
            'driver' => $this->driver,
            'num_passengers' => $this->num_passengers,
            'bags' => $this->bags,
            'color' => $this->color,
        ];
    }
}
