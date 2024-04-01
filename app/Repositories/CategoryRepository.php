<?php

namespace App\Repositories;

use App\Interfaces\SimpleRepositoryInterface;
use Illuminate\Support\Facades\Log;
use App\Models\Category;

class CategoryRepository implements SimpleRepositoryInterface {
    
    public function all()
    {
        return Category::with(['cars','sightseeings'])->get();
    } 
    
    public function get($data)
    {
        return Category::where($data)->with(['cars','sightseeings']);
    }
    
    public function find($id)
    {
        return Category::with(['cars','sightseeings'])->find($id);
    }
    public function update($id, $data)
    {
        $category = Category::find($id);
        if(!$category)
            return false;
            return $category->update($data);
    }

    public function delete($id)
    {
        return Category::destroy($id);
    }

    public function create($data)
    {
        return Category::create($data);
    }
}