<?php

namespace App\Repositories;

use App\Interfaces\SimpleRepositoryInterface;
use App\Models\Booking;

class BookingRepository implements SimpleRepositoryInterface {
    
    public function all()
    {
        return Booking::orderBy('created_at', 'desc')->with(['user','additional_info','trip_price','site_price','payments','services'])->get();
    }
    
    public function get($data)
    {
        return Booking::where($data)->with(['user','additional_info','trip_price','site_price','payments','services']);
    }
    
    public function find($id)
    {
        return Booking::with(['user','additional_info','trip_price','site_price','payments','services'])->find($id);
    }
    public function update($id, $data)
    {
        $b = Booking::find($id);
        if(!$b)
            return false;
        return $b->update($data);
    }

    public function delete($id)
    {
        return Booking::destroy($id);
    }

    public function create($data)
    {
        //log::info(print_r($data,true));
        return Booking::create($data);
    }

    public function getBookingByUser($id)
    {
        return Booking::where(['user_id' => $id])->orderBy('created_at', 'desc')->with(['user','additional_info','trip_price','site_price','payments','services'])->get();
    }

    public function getBookingByTripPrice($id)
    {
        return Booking::where(['trip_price_id' => $id])->orderBy('created_at', 'desc')->with(['user','additional_info','trip_price','site_price','payments','services'])->get();
    }
    
    public function getBookingBySitePrice($id)
    {
        return Booking::where(['site_price_id' => $id])->orderBy('created_at', 'desc')->with(['user','additional_info','trip_price','site_price','payments','services'])->get();
    }
    
    public function getBookingByBookingType($type)
    {
        return Booking::where(['booking_type' => $type])->orderBy('created_at', 'desc')->with(['user','additional_info','trip_price','site_price','payments','services'])->get();
    }
    
    public function getBookingByBookingStatus($status)
    {
        return Booking::where(['booking_status' => $status])->orderBy('created_at', 'desc')->with(['user','additional_info','trip_price','site_price','payments','services'])->get();
    }
}