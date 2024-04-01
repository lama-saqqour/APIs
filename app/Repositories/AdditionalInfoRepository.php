<?php

namespace App\Repositories;

use App\Interfaces\SimpleRepositoryInterface;
use Illuminate\Support\Facades\Log;
use App\Models\AdditionalInfo;

class AdditionalInfoRepository implements SimpleRepositoryInterface {
    
    public function all()
    {
        return AdditionalInfo::get();
    } 
    
    public function get($data)
    {
        return AdditionalInfo::where($data);
    }
    
    public function find($id)
    {
        return AdditionalInfo::find($id);
    }
    public function update($id, $data)
    {
        $additionalInfo = AdditionalInfo::find($id);
        if(!$additionalInfo)
            return false;
            return $additionalInfo->update($data);
    }

    public function delete($id)
    {
        return AdditionalInfo::destroy($id);
    }

    public function create($data)
    {
        return AdditionalInfo::create($data);
    }
}