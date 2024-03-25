<?php

namespace App\Repositories;

use App\Interfaces\SimpleRepositoryInterface;
use App\Models\PaymentMethod;

class PaymentMethodRepository implements SimpleRepositoryInterface {
    
    public function all()
    {
        return PaymentMethod::orderBy('id', 'asc')->get();
    } 
    
    public function get($data)
    {
        return PaymentMethod::where($data)->with(['payments']);
    }
    
    public function find($id)
    {
        return PaymentMethod::with(['payments'])->find($id);
    }
    public function update($id, $data)
    {
        $paymentMethod = PaymentMethod::find($id);
        if(!$paymentMethod)
            return false;
            return $paymentMethod->update($data);
    }

    public function delete($id)
    {
        return PaymentMethod::destroy($id);
    }

    public function create($data)
    {
        //log::info(print_r($data,true));
        return PaymentMethod::create($data);
    }
}