<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Support\Facades\Log;

class PaypalController extends Controller
{
    /**
     * Display the transaction creation form.
     *
     * @return \Illuminate\View\View
     */
    public function createTransaction()
    {
        return view('transaction');
    }

    /**
     * Process the PayPal transaction.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function processTransaction(Request $request)
    {
        // Validate input (optional if you want to ensure the amount is correct)
        $validated = $request->validate([
            'amount' => 'required|numeric|min:0.01',
            // Add other fields validation as needed
        ]);

        // Initialize PayPal client
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        $provider->setAccessToken($paypalToken);

        // Create order
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('successTransaction'),
                "cancel_url" => route('cancelTransaction'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $validated['amount'], // Use dynamic amount
                    ]
                ]
            ]
        ]);

        // Check if the order was successfully created
        if (isset($response['id']) && $response['id'] != null) {
            // Redirect to PayPal for approval
            foreach ($response['links'] as $link) {
                if ($link['rel'] === 'approve') {
                    return redirect()->away($link['href']);
                }
            }

            return redirect()
                ->route('createTransaction')
                ->with('error', 'Something went wrong while redirecting to PayPal.');
        } else {
            // Log error for debugging
            Log::error('PayPal Order Creation Failed: ', ['response' => $response]);

            return redirect()
                ->route('createTransaction')
                ->with('error', $response['message'] ?? 'Something went wrong. Unable to create PayPal order.');
        }
    }

    /**
     * Handle success after the transaction.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function successTransaction(Request $request)
    {
        // Initialize PayPal client
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        // Capture payment
        $response = $provider->capturePaymentOrder($request->get('token'));

        // Check if the payment was successfully captured
        if (isset($response['status']) && $response['status'] === 'COMPLETED') {
            return redirect()
                ->route('createTransaction')
                ->with('success', 'Transaction completed successfully.');
        } else {
            // Log error for debugging
            Log::error('PayPal Payment Capture Failed: ', ['response' => $response]);

            return redirect()
                ->route('createTransaction')
                ->with('error', $response['message'] ?? 'Something went wrong during the transaction.');
        }
    }

    /**
     * Handle cancellation of the transaction.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cancelTransaction(Request $request)
    {
        return redirect()
            ->route('createTransaction')
            ->with('error', 'You have canceled the transaction.');
    }
}
