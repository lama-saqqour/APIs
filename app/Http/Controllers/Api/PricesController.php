<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Price;
use App\Http\Requests\StorePriceRequest;
use App\Http\Requests\UpdatePriceRequest;
use App\Http\Resources\PricesResource;

class PricesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ['prices' => PricesResource::collection(Price::all())];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePriceRequest $request)
    {
        $data = $request->validated();

        $price = Price::create($data);
        return new PricesResource($price);
    }

    /**
     * Display the specified resource.
     */
    public function show(Price $price)
    {
        return new PricesResource($price);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePriceRequest $request, Price $price)
    {
        $data = $request->validated();

        $price->update($data);
        return new PricesResource($price);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Price $price)
    {
        $price->delete();
        return response('', 204);
    }
}
