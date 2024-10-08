<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MpesaService;
use Illuminate\Support\Facades\Log;

class MpesaController extends Controller
{
    //
    protected $mpesaService;

    public function __construct(MpesaService $mpesaService)
    {
        $this->mpesaService = $mpesaService;
    }

    public function showPaymentForm()
    {
        $cartTotal = session('cartTotal', 0);
        return view('mpesa.form', compact('cartTotal'));
    }

    public function initiatePayment(Request $request)
    {
        $request->validate([
            "phone" => 'required|string',
        ]);

        $phoneNumber = $request->input('phone');
        $amount = session('cartTotal', 0);
        $accountReference = 'TestPayment';
        $transactionDesc = 'Payment for order';

        try {
            $response = $this->mpesaService->lipaNaMpesaOnline(
                $phoneNumber,
                $amount,
                $accountReference,
                $transactionDesc
            );
            Log::info('response acquired');

            if (isset($response['ResponseCode']) && $response['ResponseCode'] === '0') {
                Log::info('payment initiated successfully');
                return response()->json(['success' => true, 'message' => 'Payment initiated successfully.']);
            }

            Log::error('failed to initiate payment');
            return response()->json(['success' => false, 'message' => $response['errorMessage'] ?? 'Failed to initiate payment.']);
        } catch (\Exception $e) {
            Log::error('Payment initiation error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'An error occurred while initiating payment.']);
        }
    }

    public function handleCallback(Request $request)
    {
        $data = $request->all();

        // You can process the callback data as needed
        Log::info('M-Pesa Callback Data: ', $data);

        return response()->json(['success' => true]);
    }
}
