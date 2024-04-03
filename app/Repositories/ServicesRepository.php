<?php

namespace App\Repositories;

use App\Interfaces\SimpleRepositoryInterface;
use Illuminate\Support\Facades\Log;
use App\Models\Services;

class ServicesRepository implements SimpleRepositoryInterface {
    
    public function all()
    {
        return Services::get();
    } 
    
    public function get($data)
    {
        return Services::where($data);
    }
    
    public function find($id)
    {
        return Services::find($id);
    }
    public function update($id, $data)
    {
        $Services = Services::find($id);
        if(!$Services)
            return false;
            return $Services->update($data);
    }

    public function delete($id)
    {
        return Services::destroy($id);
    }

    public function create($data)
    {
        return Services::create($data);
    }
}