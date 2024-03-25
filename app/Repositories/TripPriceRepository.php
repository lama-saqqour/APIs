<?php

namespace App\Repositories;

use App\Interfaces\SimpleRepositoryInterface;
use App\Models\TripPrice;

class TripPriceRepository implements SimpleRepositoryInterface {
    
    public function all()
    {
        return TripPrice::orderBy('created_at', 'desc')->with(['car','trip'])->get();
    }
    
    public function get($data)
    {
        return TripPrice::where($data)->with(['car','trip']);
    }
    
    public function find($id)
    {
        return TripPrice::with(['car','trip'])->find($id);
    }
    public function update($id, $data)
    {
        $trip_price = TripPrice::find($id);
        if(!$trip_price)
            return false;
            return $trip_price->update($data);
    }

    public function delete($id)
    {
        return TripPrice::destroy($id);
    }

    public function create($data)
    {
        //log::info(print_r($data,true));
        return TripPrice::create($data);
    }
}