<?php

namespace App\Http\Controllers\Api;

use App\Models\Discount;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use App\Repositories\DiscountRepository;
use App\Http\Resources\DiscountResource;
use App\Http\Requests\DiscountRequest;

class DiscountsController extends Controller
{
    protected $discount;
    
    public function __construct(DiscountRepository $discountRepository)
    {
        $this->discount = $discountRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return DiscountResource::collection($this->discount->all());
    }

    public function store(DiscountRequest $request)
    {
        //Log::info(print_r(["Request starts"],true));
        $data = $request->validated();
        $data = $request->collect((new Discount())->getFillable())
            ->toArray();
        $discount = $this->discount->create($data);

        return $discount ? response(new DiscountResource($discount),201) : response(__("Cannot create Discount, contact technical support!!"), 500);
    }

    public function show($id)
    {
        //Log::info(print_r(["here"],true));
        $discount = $this->discount->find($id);
        return $discount ?: response(__("Discount not found"), 404);
    }

    public function update(DiscountRequest $request, $id)
    {
        //Log::info(print_r(["here"],true));
        $data = $request->validated();
        $res = $this->discount->update($id, $data);
        return $res ? response(new DiscountResource($this->discount->find($id)), 200) : response(__("Discount not found"), 404);
    }


    public function destroy($id)
    {
        if (! $id)
            return response(__("You Should Provide Discount id"), 500);
        else
            $res = $this->discount->delete($id);
        return ($res == 1) ? response(__("Discount Deleted Successfully"), 200) : response(__("Discount not found"), 404);
    }
}
