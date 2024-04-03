<?php

namespace App\Http\Controllers\Api;

use App\Models\Services;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use App\Repositories\ServicesRepository;
use App\Http\Resources\ServicesResource;
use App\Http\Requests\ServicesRequest;

class ServicesController extends Controller
{
    protected $Services;
    
    public function __construct(ServicesRepository $ServicesRepository)
    {
        $this->Services = $ServicesRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ServicesResource::collection($this->Services->all());
    }

    public function store(ServicesRequest $request)
    {
        //Log::info(print_r(["Request starts"],true));
        $data = $request->validated();
        $data = $request->collect((new Services())->getFillable())
            ->toArray();
        $Services = $this->Services->create($data);

        return $Services ? response(new ServicesResource($Services),201) : response(__("Cannot create Additional Services, contact technical support!!"), 500);
    }

    public function show($id)
    {
        //Log::info(print_r(["here"],true));
        $Services = $this->Services->find($id);
        return $Services ?: response(__("Additional Services not found"), 404);
    }

    public function update(ServicesRequest $request, $id)
    {
        //Log::info(print_r(["here"],true));
        $data = $request->validated();
        $res = $this->Services->update($id, $data);
        return $res ? response(new ServicesResource($this->Services->find($id)), 200) : response(__("Additional Services not found"), 404);
    }


    public function destroy($id)
    {
        if (! $id)
            return response(__("You Should Provide Additional Services id"), 500);
        else
            $res = $this->Services->delete($id);
        return ($res == 1) ? response(__("Additional Services Deleted Successfully"), 200) : response(__("Additional Services not found"), 404);
    }
}
