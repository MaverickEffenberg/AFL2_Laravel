<?php

namespace App\Http\Controllers;

use App\Services\CheckoutService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $checkoutService;

    public function __construct(CheckoutService $checkoutService)
    {
        $this->checkoutService = $checkoutService;
    }

    public function checkout(Request $request)
    {
        $data = [
            'product_id' => $request->input('product_id'),
            'customer_id' => $request->input('customer_id'),
            'quantity' => $request->input('quantity'),
            'total_price' => $request->input('total_price'),
            'customer_name' => $request->input('name'),
            'customer_email' => $request->input('email'),
            'customer_phone' => $request->input('phone_number'),
        ];

        $result = $this->checkoutService->processCheckout($data);

        return response()->json([
            'snap_token' => $result['snap_token'],
            'transaction' => $result['transaction']
        ]);
    }
}