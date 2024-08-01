<?php

namespace App\Services;

use Safaricom\Mpesa\Mpesa;

class MpesaService
{
    protected $mpesa;

    public function __construct(Mpesa $mpesa)
    {
        $this->mpesa = $mpesa;
    }
    public function lipaNaMpesaOnline($phoneNumber, $amount, $AccountReference, $TransactionDesc)
    {
        $BusinessShortCode = '174379'; // Replace with your Business Shortcode
        $lipaNaMpesaOnlinePasskey = 'YOUR_LNM_PASSKEY'; // Replace with your Lipa na M-Pesa Passkey

        //timestamp generation
        $Timestamp = date('YmdHis');

        //generate password
        $password = base64_encode("{$BusinessShortCode}{$lipaNaMpesaOnlinePasskey}{$Timestamp}");

        $response = $this->mpesa->STKPushSimulation(
            $BusinessShortCode,
            $password,
            $Timestamp,
            'CustomerPayBillOnline',
            $amount,
            $phoneNumber,
            $BusinessShortCode,
            $phoneNumber,
            env('MPESA_CALLBACK_URL'),
            $AccountReference,
            $TransactionDesc
        );

        return json_decode($response, true);
    }
}
