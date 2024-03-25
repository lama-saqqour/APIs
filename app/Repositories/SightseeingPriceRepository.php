<?php

namespace App\Repositories;

use App\Interfaces\SimpleRepositoryInterface;
use App\Models\SightseeingPrice;

class SightseeingPriceRepository implements SimpleRepositoryInterface {
    
    public function all()
    {
        return SightseeingPrice::with(['car','sightseeing'])->get();
    }
    
    public function get($data)
    {
        return SightseeingPrice::where($data)->with(['car','sightseeing']);
    }
    
    public function find($id)
    {
        return SightseeingPrice::with(['car','sightseeing'])->find($id);
    }
    public function update($id, $data)
    {
        $sightseeingPrice = SightseeingPrice::find($id);
        if(!$sightseeingPrice)
            return false;
        return $sightseeingPrice->update($data);
    }

    public function delete($id)
    {
        return SightseeingPrice::destroy($id);
    }

    public function create($data)
    {
        return SightseeingPrice::create($data);
    }
}