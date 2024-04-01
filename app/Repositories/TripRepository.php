<?php

namespace App\Repositories;

use App\Interfaces\SimpleRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Google\Service\SemanticTile\TriangleStrip;
use App\Models\Trip;

class TripRepository implements SimpleRepositoryInterface {
    
    public function all()
    {
        return Trip::orderBy('created_at', 'desc')->with(['prices'])->get();
    }
    
    public function from(){
        return Trip::select('from')->distinct()->get()->pluck('from');
    }
    
    public function to(){
        return Trip::select('to')->distinct()->get()->pluck('to');
    }
    
    public function get($data)
    {
        return Trip::where($data)->with(['prices']);
    }
    
    public function find($id)
    {
        return Trip::with(['prices'])->find($id);
    }
    public function update($id, $data)
    {
        $trip = Trip::find($id);
        if(!$trip)
            return false;
            return $trip->update($data);
    }

    public function delete($id)
    {
        return Trip::destroy($id);
    }

    public function create($data)
    {
        
        //log::info(print_r("Here?",true));
        //log::info(print_r($data,true));
        return Trip::create($data);
    }
}