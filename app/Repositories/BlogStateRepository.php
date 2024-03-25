<?php

namespace App\Repositories;

use App\Models\Blog;
use App\Interfaces\SimpleRepositoryInterface;
use Illuminate\Support\Facades\Log;
use App\Models\BlogState;

class BlogStateRepository implements SimpleRepositoryInterface {
    
    public function all()
    {
        return BlogState::orderBy('created_at', 'desc')->get();
    } 
    
    public function get($data)
    {
        return BlogState::where($data)->with(['blogs']);
    }
    
    public function find($id)
    {
        return BlogState::with(['blogs'])->find($id);
    }
    public function update($id, $data)
    {
        $blogState = BlogState::find($id);
        if(!$blogState)
            return false;
            return $blogState->update($data);
    }

    public function delete($id)
    {
        return BlogState::destroy($id);
    }

    public function create($data)
    {
        //log::info(print_r($data,true));
        return BlogState::create($data);
    }
}