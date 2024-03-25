<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\SightseeingPriceRepository;
use App\Http\Resources\SightseeingPriceResource;
use App\Http\Requests\Sightseeing\SightseeingPriceRequest;
use App\Models\SightseeingPrice;
use Illuminate\Support\Facades\Log;

class SightseeingPriceController extends Controller
{
    protected $sightseeingPrice;
    
    public function __construct( SightseeingPriceRepository $sightseeingPriceRepository)
    {
        $this->sightseeingPrice = $sightseeingPriceRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return SightseeingPriceResource::collection($this->sightseeingPrice->all());
    }

    public function store(SightseeingPriceRequest $request)
    {
        //Log::info(print_r(["here",(new sightseeingPrice())->getFillable()],true));
        $data = $request->validated();
        $data = $request->collect((new sightseeingPrice())->getFillable())
            ->toArray();
        $sightseeingPrice = $this->sightseeingPrice->create($data);

        return $sightseeingPrice ? response(new SightseeingPriceResource($sightseeingPrice),201) : response(__("Cannot create SightseeingPrice, contact technical support!!"), 500);
    }

    public function show($id)
    {
        $sightseeingPrice = $this->sightseeingPrice->find($id);
        return $sightseeingPrice ?: response(__("SightseeingPrice not found"), 404);
    }

    public function update(SightseeingPriceRequest $request, $id)
    {
        $data = $request->validated();
        $res = $this->sightseeingPrice->update($id, $data);
        return $res ? response(new SightseeingPriceResource($this->sightseeingPrice->find($id)), 200) : response(__("SightseeingPrice not found"), 404);
    }


    public function destroy($id)
    {
        if (! $id)
            return response(__("You Should Provide SightseeingPrice id"), 500);
        else
            $res = $this->sightseeingPrice->delete($id);
        return ($res == 1) ? response(__("Record Deleted Successfully"), 200) : response(__("SightseeingPrice not found"), 404);
    }
}
