<?php

namespace App\Repositories;

use App\Models\UserType;
use App\Interfaces\SimpleRepositoryInterface;
use Illuminate\Support\Facades\Log;

class UserTypeRepository implements SimpleRepositoryInterface {
    
    public function all()
    {
        return UserType::get();
    }
    
    public function get($data)
    {
        return UserType::where($data);
    }
    
    public function find($id)
    {
        return UserType::find($id);
    }
    public function update($id, $data)
    {
        $userType = UserType::find($id);
        if(!$userType)
            return false;
        return $userType->update($data);
    }

    public function delete($id)
    {
        return UserType::destroy($id);
    }

    public function create($data)
    {
        //log::info(print_r($data,true));
        return UserType::create($data);
    }

    
}