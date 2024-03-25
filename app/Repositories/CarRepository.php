<?php

namespace App\Repositories;

use App\Interfaces\SimpleRepositoryInterface;
use App\Models\Car;

class CarRepository implements SimpleRepositoryInterface {
    
    public function all()
    {
        return Car::orderBy('created_at', 'desc')->with(['category','driver'])->get();
    }
    
    public function get($data)
    {
        return Car::where($data)->with(['category','driver']);
    }
    
    public function find($id)
    {
        return Car::with(['category','driver'])->find($id);
    }
    public function update($id, $data)
    {
        $car = Car::find($id);
        if(!$car)
            return false;
            return $car->update($data);
    }

    public function delete($id)
    {
        return Car::destroy($id);
    }

    public function create($data)
    {
        //log::info(print_r($data,true));
        return Car::create($data);
    }
}