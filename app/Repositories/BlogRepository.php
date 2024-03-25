<?php

namespace App\Repositories;

use App\Models\Blog;
use App\Interfaces\SimpleRepositoryInterface;
use Illuminate\Support\Facades\Log;

class BlogRepository implements SimpleRepositoryInterface {
    
    public function all()
    {
        return Blog::orderBy('created_at', 'desc')->with(['user','state'])->get();
    }
    
    public function get($data)
    {
        return Blog::where($data)->with(['user','state']);
    }
    
    public function find($id)
    {
        return Blog::with(['user','state'])->find($id);
    }
    public function update($id, $data)
    {
        $blog = Blog::find($id);
        if(!$blog)
            return false;
        return $blog->update($data);
    }

    public function delete($id)
    {
        return Blog::destroy($id);
    }

    public function create($data)
    {
        //log::info(print_r($data,true));
        return Blog::create($data);
    }

    public function getBlogByUser($id)
    {
        return Blog::where(['user' => $id])->orderBy('created_at', 'desc')->get();
    }

    public function getBlogByState($id)
    {
        return Blog::where(['state' => $id])->orderBy('created_at', 'desc')->get();
    }
}