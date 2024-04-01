<?php

namespace App\Http\Controllers\Api;

use App\Models\UserType;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use App\Repositories\UserTypeRepository;
use App\Http\Resources\UserTypeResource;
use App\Http\Requests\UserTypeRequest;

class UserTypesController extends Controller
{
    protected $userType;
    
    public function __construct(UserTypeRepository $userTypeRepository)
    {
        $this->userType = $userTypeRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return UserTypeResource::collection($this->userType->all());
    }

    public function store(UserTypeRequest $request)
    {
        //Log::info(print_r(["Request starts"],true));
        $data = $request->validated();
        $data = $request->collect((new UserType())->getFillable())
            ->toArray();
        $userType = $this->userType->create($data);

        return $userType ? response(new UserTypeResource($userType),201) : response(__("Cannot create User Type, contact technical support!!"), 500);
    }

    public function show($id)
    {
        //Log::info(print_r(["here"],true));
        $userType = $this->userType->find($id);
        return $userType ?: response(__("UserType not found"), 404);
    }

    public function update(UserTypeRequest $request, $id)
    {
        //Log::info(print_r(["here"],true));
        $data = $request->validated();
        $res = $this->userType->update($id, $data);
        return $res ? response(new UserTypeResource($this->userType->find($id)), 200) : response(__("UserType not found"), 404);
    }


    public function destroy($id)
    {
        if (! $id)
            return response(__("You Should Provide UserType id"), 500);
        else
            $res = $this->userType->delete($id);
        return ($res == 1) ? response(__("UserType Deleted Successfully"), 200) : response(__("UserType not found"), 404);
    }
}
