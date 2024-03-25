<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\PaymentMethodRepository;
use App\Http\Resources\PaymentMethodResource;

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

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $paymentMethod = $this->paymentMethod->find($id);
        return $paymentMethod ?: response(__("Payment Method not found"), 404);
    }

}
