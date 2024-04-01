<?php

namespace App\Http\Controllers\Api;

use App\Models\AdditionalInfo;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use App\Repositories\AdditionalInfoRepository;
use App\Http\Resources\AdditionalInfoResource;
use App\Http\Requests\AdditionalInfoRequest;
use Illuminate\Http\Request;
class AdditionalInfoController extends Controller
{
    protected $additionalInfo;
    
    public function __construct(AdditionalInfoRepository $additionalInfoRepository)
    {
        $this->additionalInfo = $additionalInfoRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return AdditionalInfoResource::collection($this->additionalInfo->all());
    }

    public function store(AdditionalInfoRequest $request)
    {
        //Log::info(print_r(["Request starts"],true));
        $data = $request->validated();
        $data = $request->collect((new AdditionalInfo())->getFillable())
            ->toArray();
        $additionalInfo = $this->additionalInfo->create($data);

        return $additionalInfo ? response(new AdditionalInfoResource($additionalInfo),201) : response(__("Cannot create Additional Info, contact technical support!!"), 500);
    }

    public function show($id)
    {
        //Log::info(print_r(["here"],true));
        $additionalInfo = $this->additionalInfo->find($id);
        return $additionalInfo ?: response(__("Additional Info not found"), 404);
    }

    public function update(AdditionalInfoRequest $request, $id)
    {
        //Log::info(print_r(["here"],true));
        $data = $request->validated();
        $res = $this->additionalInfo->update($id, $data);
        return $res ? response(new AdditionalInfoResource($this->additionalInfo->find($id)), 200) : response(__("Additional Info not found"), 404);
    }


    public function destroy($id)
    {
        if (! $id)
            return response(__("You Should Provide Additional Info id"), 500);
        else
            $res = $this->additionalInfo->delete($id);
        return ($res == 1) ? response(__("Additional Info Deleted Successfully"), 200) : response(__("Additional Info not found"), 404);
    }
}
