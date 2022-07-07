<?php

namespace App\Http\Controllers;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Http\Request;

class PaypalController extends Controller
{
    public function processPaypal(Request $request)
    {
      $this->validate($request,[
        'price'=>['required', 'numeric'],
      ]);
      $provider = new PayPalClient;
        $provider -> setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('processSuccess'),
                "cancel_url" => route('processCancel'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "PHP",
                        "value" => $request->price,
                    ]
                ]
            ]
        ]);

        if (isset($response['id']) && $response['id'] != null) {

            // redirect to approve href
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }

            return redirect()
                ->route('dashboard')
                ->with('error', 'Paypal Transaction Failed.');

        } else {
            return redirect()
                ->route('dashboard')
                ->with('error', $response['message'] ?? 'Paypal Transaction Failed.');
        }
    }

    public function processSuccess(Request $request)
    {
      $provider = new PayPalClient;
       $provider->setApiCredentials(config('paypal'));
       $provider->getAccessToken();
       $response = $provider->capturePaymentOrder($request['token']);

       if (isset($response['status']) && $response['status'] == 'COMPLETED') {
           return redirect()
               ->route('dashboard')
               ->with('success', 'Paypal Transaction Successful.');
       } else {
           return redirect()
               ->route('dashboard')
               ->with('error', $response['message'] ?? 'Paypal Transaction Failed.');
       }
    }

    public function processCancel(Request $request)
    {
        return redirect()
            ->route('dashboard')
            ->with('error', $response['message'] ?? 'Transaction Cancelled.');
    }

}
