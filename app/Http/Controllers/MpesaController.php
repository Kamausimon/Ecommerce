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
        return view('mpesa.payment');
    }

    public function initiatePayment(Request $request)
    {
        $request->validate([
            "phone" => 'required|string',
            'amount' => 'required|numeric|min:1',
        ]);

        $phoneNumber = $request->input('phone');
        $amount = $request->input('amount');
        $accountReference = 'TestPayment';
        $transactionDesc = 'Payment for order';

        try {
            $response = $this->mpesaService->lipaNaMpesaOnline(
                $phoneNumber,
                $amount,
                $accountReference,
                $transactionDesc
            );

            if (isset($response['ResponseCode']) && $response['ResponseCode'] === '0') {
                return response()->json(['success' => true, 'message' => 'Payment initiated successfully.']);
            }

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
