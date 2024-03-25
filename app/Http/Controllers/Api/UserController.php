<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\User\UserRequest;
use App\Http\Resources\UserResource;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    protected $user;
    
    public function __construct( UserRepository $userRepository)
    {
        $this->user = $userRepository;
    }
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    
    //basic functions should not changed (index,show,store,update,destroy)
    public function index()
    {
        return UserResource::collection($this->user->all());
        
        /*
        return UserResource::collection(
            User::query()->where('is_admin', 1)->orderBy('id', 'desc')->get()
        );*/

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);
        $data['user_type_id'] = $data['user_type'];
        $user = $this->user->create($data);
        return response(new UserResource($user), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = $this->user->find($id);
        return $user?:response(__("User not found"), 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, $id)
    {/*
        $user = $this->user->find($id);
        if(!$user)
            return response(__("User not found"), 404);*/
        $data = $request->validated();
        $data = $request->collect((new User())->getFillable())->toArray();
        
        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }
        
        $res = $this->user->update($id, $data);
        return $res?  response(new UserResource($this->user->find($id)), 200): response(__("User not found"), 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if(!$id)
            return response(__("You Should Provide User id"),500);
        else
            $res = $this->user->delete($id);
            return ($res==1)? response(__("Record Deleted Successfully"), 200): response(__("User not found"), 404); 
    }
}
