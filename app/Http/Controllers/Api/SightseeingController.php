<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\SightseeingRepository;
use App\Http\Resources\SightseeingResource;
use App\Http\Requests\Sightseeing\SightseeingRequest;
use App\Models\Sightseeing;

class SightseeingController extends Controller
{
    protected $sightseeing;
    
    public function __construct( SightseeingRepository $sightseeingRepository)
    {
        $this->sightseeing = $sightseeingRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return SightseeingResource::collection($this->sightseeing->all());
    }

    public function store(SightseeingRequest $request)
    {
        $data = $request->validated();
        $data = $request->collect((new Sightseeing())->getFillable())
            ->toArray();
        $sightseeing = $this->sightseeing->create($data);

        return $sightseeing ? response(new SightseeingResource($sightseeing),201) : response(__("Cannot create sightseeing, contact technical support!!"), 500);
    }

    public function show($id)
    {
        $sightseeing = $this->sightseeing->find($id);
        return $sightseeing ?: response(__("Sightseeing not found"), 404);
    }

    public function update(SightseeingRequest $request, $id)
    {
        $data = $request->validated();
        $res = $this->sightseeing->update($id, $data);
        return $res ? response(new SightseeingResource($this->sightseeing->find($id)), 200) : response(__("Sightseeing not found"), 404);
    }


    public function destroy($id)
    {
        if (! $id)
            return response(__("You Should Provide Sightseeing id"), 500);
        else
            $res = $this->sightseeing->delete($id);
        return ($res == 1) ? response(__("Record Deleted Successfully"), 200) : response(__("Sightseeing not found"), 404);
    }
}
