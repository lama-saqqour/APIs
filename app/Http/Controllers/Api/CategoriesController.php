<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use App\Repositories\CategoryRepository;
use App\Http\Resources\CategoryResource;
use App\Http\Requests\CategoryRequest;

class CategoriesController extends Controller
{
    protected $category;
    
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->category = $categoryRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CategoryResource::collection($this->category->all());
    }

    public function store(CategoryRequest $request)
    {
        //Log::info(print_r(["Request starts"],true));
        $data = $request->validated();
        $data = $request->collect((new Category())->getFillable())
            ->toArray();
        $category = $this->category->create($data);

        return $category ? response(new CategoryResource($category),201) : response(__("Cannot create Category, contact technical support!!"), 500);
    }

    public function show($id)
    {
        //Log::info(print_r(["here"],true));
        $category = $this->category->find($id);
        return $category ?: response(__("Category not found"), 404);
    }

    public function update(CategoryRequest $request, $id)
    {
        //Log::info(print_r(["here"],true));
        $data = $request->validated();
        $res = $this->category->update($id, $data);
        return $res ? response(new CategoryResource($this->category->find($id)), 200) : response(__("Category not found"), 404);
    }


    public function destroy($id)
    {
        if (! $id)
            return response(__("You Should Provide Category id"), 500);
        else
            $res = $this->category->delete($id);
        return ($res == 1) ? response(__("Category Deleted Successfully"), 200) : response(__("Category not found"), 404);
    }
}
