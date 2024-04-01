<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Repositories\PaymentRepository;
use App\Http\Resources\PaymentResource;
use App\Http\Requests\PaymentRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    protected $payment;

    public function __construct(PaymentRepository $paymentRepository)
    {
        $this->payment = $paymentRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return PaymentResource::collection($this->payment->all());
    }
    public function store(PaymentRequest $request)
    {
        //Log::info(print_r(["Request starts"],true));
        $data = $request->validated();
        $data = $request->collect((new Payment())->getFillable())
            ->toArray();
        $payment = $this->payment->create($data);

        return $payment ? response(new PaymentResource($payment),201) : response(__("Cannot create Payment, contact technical support!!"), 500);
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $payment = $this->payment->find($id);
        return $payment ?: response(__("Payment not found"), 404);
    }
    public function update(PaymentRequest $request, $id)
    {
        //Log::info(print_r(["here"],true));
        $data = $request->validated();
        $res = $this->payment->update($id, $data);
        return $res ? response(new PaymentResource($this->payment->find($id)), 200) : response(__("Payment not found"), 404);
    }


    public function destroy($id)
    {
        if (! $id)
            return response(__("You Should Provide Payment id"), 500);
        else
            $res = $this->payment->delete($id);
        return ($res == 1) ? response(__("Payment Deleted Successfully"), 200) : response(__("Payment not found"), 404);
    }

}
