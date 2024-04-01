<?php

namespace App\Http\Controllers\Api;

use App\Models\TripPrice;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use App\Repositories\TripPriceRepository;
use App\Http\Resources\TripPriceResource;
use App\Http\Resources\TripPriceCollection;
use App\Http\Requests\Trip\TripPriceRequest;

class TripsPriceController extends Controller
{
    protected $trip_price;
    
    public function __construct( TripPriceRepository $tripPriceRepository)
    {
        $this->trip_price = $tripPriceRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TripPriceResource::collection($this->trip_price->all());
    }

    public function store(TripPriceRequest $request)
    {
        //Log::info(print_r(["Request starts"],true));
        $data = $request->validated();
        $data = $request->collect((new TripPrice())->getFillable())
            ->toArray();
        $trip_price = $this->trip_price->create($data);

        return $trip_price ? response(new TripPriceResource($trip_price),201) : response(__("Cannot create Trip Price, contact technical support!!"), 500);
    }

    public function show($id)
    {
        //Log::info(print_r(["here"],true));
        $trip_price = $this->trip_price->find($id);
        return $trip_price ?: response(__("Trip Price not found"), 404);
    }

    public function update(TripPriceRequest $request, $id)
    {
        //Log::info(print_r(["here"],true));
        $data = $request->validated();
        $res = $this->trip_price->update($id, $data);
        return $res ? response(new TripPriceResource($this->trip_price->find($id)), 200) : response(__("Trip Price not found"), 404);
    }


    public function destroy($id)
    {
        if (! $id)
            return response(__("You Should Provide Trip Price id"), 500);
        else
            $res = $this->trip_price->delete($id);
        return ($res == 1) ? response(__("Trip Price Deleted Successfully"), 200) : response(__("Trip Price not found"), 404);
    }
}
