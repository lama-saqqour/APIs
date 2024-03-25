<?php

namespace App\Repositories;

use App\Interfaces\SimpleRepositoryInterface;
use App\Models\Sightseeing;

class SightseeingRepository implements SimpleRepositoryInterface {
    
    public function all()
    {
        return Sightseeing::with(['category'])->get();
    }
    
    public function get($data)
    {
        return Sightseeing::where($data)->with(['category']);
    }
    
    public function find($id)
    {
        return Sightseeing::with(['category'])->find($id);
    }
    public function update($id, $data)
    {
        $sightseeing = Sightseeing::find($id);
        if(!$sightseeing)
            return false;
        return $sightseeing->update($data);
    }

    public function delete($id)
    {
        return Sightseeing::destroy($id);
    }

    public function create($data)
    {
        return Sightseeing::create($data);
    }
}