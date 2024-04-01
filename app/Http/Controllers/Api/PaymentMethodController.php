<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use App\Repositories\PaymentMethodRepository;
use App\Http\Resources\PaymentMethodResource;
use App\Http\Requests\PaymentMethodRequest;

class PaymentMethodController extends Controller
{

    protected $paymentMethod;

    public function __construct(PaymentMethodRepository $paymentMethodRepository)
    {
        $this->paymentMethod = $paymentMethodRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return PaymentMethodResource::collection($this->paymentMethod->all());
    }

    public function store(PaymentMethodRequest $request)
    {
        //Log::info(print_r(["Request starts"],true));
        $data = $request->validated();
        $data = $request->collect((new PaymentMethod())->getFillable())
            ->toArray();
        $paymentMethod = $this->paymentMethod->create($data);

        return $paymentMethod ? response(new PaymentMethodResource($paymentMethod),201) : response(__("Cannot create Payment Method, contact technical support!!"), 500);
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $paymentMethod = $this->paymentMethod->find($id);
        return $paymentMethod ?: response(__("Payment Method not found"), 404);
    }

    public function update(PaymentMethodRequest $request, $id)
    {
        //Log::info(print_r(["here"],true));
        $data = $request->validated();
        $res = $this->paymentMethod->update($id, $data);
        return $res ? response(new PaymentMethodResource($this->paymentMethod->find($id)), 200) : response(__("Payment method not found"), 404);
    }


    public function destroy($id)
    {
        if (! $id)
            return response(__("You Should Provide Payment Method id"), 500);
        else
            $res = $this->paymentMethod->delete($id);
        return ($res == 1) ? response(__("Payment Method Deleted Successfully"), 200) : response(__("Payment Method not found"), 404);
    }

}
