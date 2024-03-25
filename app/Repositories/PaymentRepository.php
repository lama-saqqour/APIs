<?php

namespace App\Repositories;

use App\Interfaces\SimpleRepositoryInterface;
use Illuminate\Support\Facades\Log;
use App\Models\Payment;

class PaymentRepository implements SimpleRepositoryInterface {
    
    public function all()
    {
        return Payment::orderBy('created_at', 'desc')->with(['user','booking','payment_method'])->get();
    }
    
    public function get($data)
    {
        return Payment::where($data)->with(['user','booking','payment_method']);
    }
    
    public function find($id)
    {
        return Payment::with(['user','booking','payment_method'])->find($id);
    }
    public function update($id, $data)
    {
        $payment = Payment::find($id);
        if(!$payment)
            return false;
            return $payment->update($data);
    }

    public function delete($id)
    {
        return Payment::destroy($id);
    }

    public function create($data)
    {
        //log::info(print_r($data,true));
        return Payment::create($data);
    }

    public function getPaymentsByUser($id)
    {
        return Payment::where(['user_id' => $id])->orderBy('created_at', 'desc')->get();
    }

    public function getPaymentsByBooking($id)
    {
        return Payment::where(['booking_id' => $id])->orderBy('created_at', 'desc')->get();
    }
    
    public function getPaymentsByMethod($id)
    {
        return Payment::where(['payment_method_id' => $id])->orderBy('created_at', 'desc')->get();
    }
}