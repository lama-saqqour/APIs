<?php

namespace App\Http\Controllers\Api;

use App\Models\Serviceable;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use App\Repositories\ServiceableRepository;
use App\Http\Resources\ServiceableResource;
use App\Http\Requests\ServiceableRequest;

class ServiceablesController extends Controller
{
    protected $serviceable;
    
    public function __construct(ServiceableRepository $serviceableRepository)
    {
        $this->serviceable = $serviceableRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ServiceableResource::collection($this->serviceable->all());
    }

    public function store(ServiceableRequest $request)
    {
        $data = $request->validated(); 
        $data = $request->collect((new Serviceable())->getFillable())->toArray();
        
        $serviceable = $this->serviceable->create($data);

        return $serviceable ? response(new ServiceableResource($serviceable),201) : response(__("Cannot create Additional Services, contact technical support!!"), 500);
    }

    public function show($id)
    {
        //Log::info(print_r(["here"],true));
        $serviceable = $this->serviceable->find($id);
        return $serviceable ?: response(__("Serviceable not found"), 404);
    }

    public function update(ServiceableRequest $request, $id)
    {
        //Log::info(print_r(["here controller", $request->bookings_id],true));
        $data = $request->validated();
        $res = $this->serviceable->update($id, $data);
        return $res ? response(new ServiceableResource($this->serviceable->find($id)), 200) : response(__("Serviceable not found"), 404);
    }


    public function destroy($id)
    {
        if (! $id)
            return response(__("You Should Provide Serviceable id"), 500);
        else
            $res = $this->serviceable->delete($id);
        return ($res == 1) ? response(__("Serviceable Deleted Successfully"), 200) : response(__("Serviceable not found"), 404);
    }
}
