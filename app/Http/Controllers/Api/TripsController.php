<?php

namespace App\Http\Controllers\Api;

use App\Models\Trip;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use App\Repositories\TripRepository;
use App\Http\Resources\TripResource;
use App\Http\Resources\TripCollection;
use App\Http\Requests\Trip\TripRequest;
use Illuminate\Http\Request;

class TripsController extends Controller
{
    protected $trip;
    
    public function __construct( TripRepository $tripRepository)
    {
        $this->trip = $tripRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new TripCollection($this->trip->all());
    }

    public function store(TripRequest $request)
    {
        //Log::info(print_r(["Request starts"],true));
        $data = $request->validated();
        $data = $request->collect((new Trip())->getFillable())
            ->toArray();
        $trip = $this->trip->create($data);

        return $trip ? response(new TripResource($trip),201) : response(__("Cannot create Trip, contact technical support!!"), 500);
    }

    public function show($id)
    {
        //Log::info(print_r(["here"],true));
        $trip = $this->trip->find($id);
        return $trip ?: response(__("Trip not found"), 404);
    }

    public function update(TripRequest $request, $id)
    {
        //Log::info(print_r(["here"],true));
        $data = $request->validated();
        $res = $this->trip->update($id, $data);
        return $res ? response(new TripResource($this->trip->find($id)), 200) : response(__("Trip not found"), 404);
    }


    public function destroy($id)
    {
        if (! $id)
            return response(__("You Should Provide Trip id"), 500);
        else
            $res = $this->trip->delete($id);
        return ($res == 1) ? response(__("Trip Deleted Successfully"), 200) : response(__("Trip not found"), 404);
    }
}
