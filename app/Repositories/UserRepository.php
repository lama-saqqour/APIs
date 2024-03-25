<?php

namespace App\Repositories;

use App\Models\User;
use App\Interfaces\SimpleRepositoryInterface;
use Illuminate\Support\Facades\Log;

class UserRepository implements SimpleRepositoryInterface {
    
    public function all()
    {
        return User::orderBy('name', 'asc')->with(['user_type'])->get();
    }
    
    public function get($data)
    {
        return User::where($data)->with(['user_type']);
    }
    
    public function find($id)
    {
        return User::with(['user_type'])->find($id);
    }
    public function update($id, $data)
    {
        $user = User::find($id);
        if(!$user)
            return false;
        return $user->update($data);
    }

    public function delete($id)
    {
        return User::destroy($id);
    }

    public function create($data)
    {
        //log::info(print_r($data,true));
        return User::create($data);
    }

    public function getUserByType($type)
    {
        return User::where(['user_type' => $type])->orderBy('name', 'asc')->get();
    }

    
}