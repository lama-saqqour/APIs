<?php

namespace App\Http\Controllers\Api;

use App\Models\AdditionalServices;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use App\Repositories\AdditionalServicesRepository;
use App\Http\Resources\AdditionalServicesResource;
use App\Http\Requests\AdditionalServicesRequest;

class AdditionalServicesController extends Controller
{
    protected $additionalServices;
    
    public function __construct(AdditionalServicesRepository $additionalServicesRepository)
    {
        $this->additionalServices = $additionalServicesRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return AdditionalServicesResource::collection($this->additionalServices->all());
    }

    public function store(AdditionalServicesRequest $request)
    {
        //Log::info(print_r(["Request starts"],true));
        $data = $request->validated();
        $data = $request->collect((new AdditionalServices())->getFillable())
            ->toArray();
        $additionalServices = $this->additionalServices->create($data);

        return $additionalServices ? response(new AdditionalServicesResource($additionalServices),201) : response(__("Cannot create Additional Services, contact technical support!!"), 500);
    }

    public function show($id)
    {
        //Log::info(print_r(["here"],true));
        $additionalServices = $this->additionalServices->find($id);
        return $additionalServices ?: response(__("Additional Services not found"), 404);
    }

    public function update(AdditionalServicesRequest $request, $id)
    {
        //Log::info(print_r(["here"],true));
        $data = $request->validated();
        $res = $this->additionalServices->update($id, $data);
        return $res ? response(new AdditionalServicesResource($this->additionalServices->find($id)), 200) : response(__("Additional Services not found"), 404);
    }


    public function destroy($id)
    {
        if (! $id)
            return response(__("You Should Provide Additional Services id"), 500);
        else
            $res = $this->additionalServices->delete($id);
        return ($res == 1) ? response(__("Additional Services Deleted Successfully"), 200) : response(__("Additional Services not found"), 404);
    }
}
