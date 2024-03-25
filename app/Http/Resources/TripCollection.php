<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Repositories\TripRepository;

class TripCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        $trip = new TripRepository();
        return [
            'filters'=>["from"=>$trip->from(),"to"=>$trip->to()],
            'data' => $this->collection->map(
                function ( $obj ) {
                    return new TripResource($obj);
                })
        ];
    }
}
