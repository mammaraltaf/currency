<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Omnipay\Omnipay;


class MonerisPaymentController extends Controller
{
    public function payment(Request $request)
    {
        // Create a gateway instance
        $gateway = Omnipay::create('Moneris');
        $gateway->setMerchantId('monca07926');
        $gateway->setMerchantKey('oVxLG8KP1gTFf66wkFXZ');
        $gateway->setTestMode(true);

        // Set the parameters for the purchase request
        $parameters = [
            'orderNumber' => '12sds345', // Replace '12345' with your actual order number or identifier
            'amount' => '100.00',
            'paymentMethod' => 'card', // Specify the payment method as 'card'
            'card' => [
                'number' => '4242424242424242',
                'expiryMonth' => '12',
                'expiryYear' => '23',
                'cvv' => '123',
                'cvd_info' => true, // Enable CVV/CVD information
            ],
        ];

        // Try sending the purchase request
        try {
            $response = $gateway->purchase($parameters)->send();

            // Check the response
            if ($response->isSuccessful()) {
                dd($response);
                // Payment successful
                $transactionId = $response->getTransactionReference();
                dd('success', $transactionId);
            } else {
                // Payment failed
                $errorMessage = $response->getMessage();
                dd('error', $errorMessage);
            }
        } catch (\Exception $e) {
            // Handle any exceptions or errors
            dd('exception', $e->getMessage());
        }
    }



//    public function payment(Request $request)
//    {
//        // Validate the request input
//        $validatedData = $request->validate([
//            'orderNumber' => 'required|string|max:255',
//            'amount' => 'required|numeric|min:0.01',
//            'card_number' => 'required|string|numeric|digits_between:12,19',
//            'expiry_month' => 'required|string|digits:2|numeric|min:1|max:12',
//            'expiry_year' => 'required|string|digits:2|numeric',
//            'cvv' => 'required|string|numeric|digits_between:3,4',
//            // Add more validation rules for other fields if necessary
//        ]);
//
//        try {
//            // Create a gateway instance using dependency injection
//            $gateway = Omnipay::create('Moneris');
//            $gateway->setMerchantId(config('payment.moneris.merchant_id'));
//            $gateway->setMerchantKey(config('payment.moneris.merchant_key'));
//            $gateway->setTestMode(config('payment.moneris.test_mode'));
//
//            // Set the parameters for the purchase request
//            $parameters = [
//                'orderNumber' => $validatedData['orderNumber'],
//                'amount' => $validatedData['amount'],
//                'paymentMethod' => 'card', // Specify the payment method as 'card'
//                'card' => [
//                    'number' => $validatedData['card_number'],
//                    'expiryMonth' => $validatedData['expiry_month'],
//                    'expiryYear' => $validatedData['expiry_year'],
//                    'cvv' => $validatedData['cvv'],
//                    'cvd_info' => true, // Enable CVV/CVD information
//                ],
//            ];
//
//            // Send the purchase request
//            $response = $gateway->purchase($parameters)->send();
//
//            // Check the response
//            if ($response->isSuccessful()) {
//                // Payment successful
//                $transactionId = $response->getTransactionReference();
//
//                // Log the successful transaction
//                \Log::info('Payment successful. Transaction ID: ' . $transactionId);
//
//                // Return success response to the client
//                return response()->json(['status' => 'success', 'transactionId' => $transactionId]);
//            } else {
//                // Payment failed
//                $errorMessage = $response->getMessage();
//
//                // Log the payment failure
//                \Log::error('Payment failed. Error Message: ' . $errorMessage);
//
//                // Return error response to the client
//                return response()->json(['status' => 'error', 'message' => $errorMessage], 422);
//            }
//        } catch (InvalidRequestException $e) {
//            // Handle InvalidRequestException
//            \Log::error('Invalid request. Error Message: ' . $e->getMessage());
//            return response()->json(['status' => 'error', 'message' => 'Invalid request'], 400);
//        } catch (\Exception $e) {
//            // Handle any other exceptions or errors
//            \Log::error('Exception occurred. Error Message: ' . $e->getMessage());
//            return response()->json(['status' => 'error', 'message' => 'Something went wrong'], 500);
//        }
//    }
}
