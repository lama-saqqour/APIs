<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\PaymentRepository;
use App\Http\Resources\PaymentResource;

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

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $payment = $this->payment->find($id);
        return $payment ?: response(__("Payment not found"), 404);
    }

}
