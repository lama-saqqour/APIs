<?php

namespace App\Repositories;

use App\Interfaces\SimpleRepositoryInterface;
use Illuminate\Support\Facades\Log;
use App\Models\AdditionalServices;

class AdditionalServicesRepository implements SimpleRepositoryInterface {
    
    public function all()
    {
        return AdditionalServices::get();
    } 
    
    public function get($data)
    {
        return AdditionalServices::where($data);
    }
    
    public function find($id)
    {
        return AdditionalServices::find($id);
    }
    public function update($id, $data)
    {
        $additionalServices = AdditionalServices::find($id);
        if(!$additionalServices)
            return false;
            return $additionalServices->update($data);
    }

    public function delete($id)
    {
        return AdditionalServices::destroy($id);
    }

    public function create($data)
    {
        return AdditionalServices::create($data);
    }
}