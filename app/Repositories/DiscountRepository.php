<?php

namespace App\Repositories;

use App\Interfaces\SimpleRepositoryInterface;
use Illuminate\Support\Facades\Log;
use App\Models\Discount;

class DiscountRepository implements SimpleRepositoryInterface {
    
    public function all()
    {
        return Discount::get();
    } 
    
    public function get($data)
    {
        return Discount::where($data);
    }
    
    public function find($id)
    {
        return Discount::find($id);
    }
    public function update($id, $data)
    {
        $discount = Discount::find($id);
        if(!$discount)
            return false;
            return $discount->update($data);
    }

    public function delete($id)
    {
        return Discount::destroy($id);
    }

    public function create($data)
    {
        return Discount::create($data);
    }
}