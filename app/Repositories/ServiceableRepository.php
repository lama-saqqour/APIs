<?php

namespace App\Repositories;

use App\Interfaces\SimpleRepositoryInterface;
use Illuminate\Support\Facades\Log;
use App\Models\Serviceable;

class ServiceableRepository implements SimpleRepositoryInterface {
    
    public function all()
    {
        return Serviceable::with(['services','bookings'])->get();
    } 
    
    public function get($data)
    {
        return Serviceable::where($data)->with(['services','bookings']);
    }
    
    public function find($id)
    {
        return Serviceable::with(['services','bookings'])->find($id);
    }
    public function update($id, $data)
    {
        $serviceable = Serviceable::find($id);
        if(!$serviceable)
            return false;
            return $serviceable->update($data);
    }

    public function delete($id)
    {
        return Serviceable::destroy($id);
    }

    public function create($data)
    {
        //log::info(print_r($data,true));
        return Serviceable::create($data);
    }
}