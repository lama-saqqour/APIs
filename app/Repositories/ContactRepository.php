<?php

namespace App\Repositories;

use App\Interfaces\SimpleRepositoryInterface;
use Illuminate\Support\Facades\Log;
use App\Models\Contact;

class ContactRepository implements SimpleRepositoryInterface {
    
    public function all()
    {
        return Contact::get();
    } 
    
    public function get($data)
    {
        return Contact::where($data);
    }
    
    public function find($id)
    {
        return Contact::find($id);
    }
    public function update($id, $data)
    {
        $contact = Contact::find($id);
        if(!$contact)
            return false;
            return $contact->update($data);
    }

    public function delete($id)
    {
        return Contact::destroy($id);
    }

    public function create($data)
    {
        return Contact::create($data);
    }
}