<?php

namespace App\Http\Controllers;
use App\Services\PaymentService;
use App\Gateways\PaystackGateway;
use App\Gateways\PayPalGateway;
use Illuminate\Http\Request;
use Yabacon\Paystack\Paystack;
use Illuminate\Support\Facades\Http;


class PaymentController extends Controller
{

   /* protected $paystack;

    public function __construct()
    {
        // Set your Paystack secret key here
        $this->paystack = new Paystack('sk_test_66104f4657701dd6db15cf77ae480356be054f89');
    }
*/
    public function showPaymentForm() {
        return view('payment.form');
    }

    public function showPaystackForm() {
        return view('payment.paystack');
    }

    /*public function payWithGateway(Request $request, $gateway) {
        // Create an instance of the selected gateway
        switch ($gateway) {
            case 'paystack':
                $paymentGateway = new PaystackGateway();
                break;
            case 'paypal':
                $paymentGateway = new PayPalGateway();
                break;
            // Add more cases for other gateways
            default:
                // Handle unsupported gateway
                break;
        }

        // Set the selected gateway in the PaymentService
        $paymentService = new PaymentService();
        $paymentService->setGateway($paymentGateway);

        // Process the payment using the selected gateway
        $amount = $request->input('amount');
        $result = $paymentService->processPayment($amount);

        // Handle the payment result here
        return view('payment.result', ['result' => $result]);
    }*/

    /*public function processPayment(Request $request, $gateway) {
        // Your payment processing logic using the PaymentService
        // Example:
        $paymentService = new PaymentService();
        $amount = $request->input('amount');
        $paymentService->setGateway(new PaystackGateway()); // Replace with dynamic gateway selection

        $result = $paymentService->processPayment($amount);

        return view('payment.result', ['result' => $result]);
    }*/

// app/Http/Controllers/PaymentController.php

public function verifyPaystackPayment(Request $request)
{
    // Get the payment reference from the request
    $reference = $request->input('reference');

    // Send a request to the Paystack API to verify the payment
    $response = Http::get("https://api.paystack.co/transaction/verify/$reference", [
        'headers' => [
            'Authorization' => 'sk_test_66104f4657701dd6db15cf77ae480356be054f89', // Replace with your Paystack secret key
        ],
    ]);

    $data = $response->json();

    if ($response->successful() && $data['data']['status'] === 'success') {
        // Payment was successful
        return response()->json(['message' => 'Payment successful']);
    } else {
        // Payment failed
        return response()->json(['error' => 'Payment failed'], 400);
    }
}

    public function processPayment(Request $request, $gateway) {
        // Check the selected gateway
        switch ($gateway) {
            case 'paystack':
                $paymentGateway = new PaystackGateway();
                break;
            case 'paypal':
                $paymentGateway = new PayPalGateway();
                break;
            // Add more cases for other gateways
            default:
                // Handle unsupported gateway or show an error message
                return redirect()->back()->with('error', 'Unsupported payment gateway');
        }
    
        // Set the selected gateway in the PaymentService
        $paymentService = new PaymentService();
        $paymentService->setGateway($paymentGateway);
    
        // Process the payment using the selected gateway
        $amount = $request->input('amount');
        $result = $paymentService->processPayment($amount);
    
        // Handle the payment result here
        return view('payment.result', ['result' => $result]);
    }
}

    /*public function showPaystackForm() {
        return view('payment.paystack');
    }*/


   
    /*public function processPayment(Request $request)
    {
        $amount = $request->input('amount');
        $email = $request->input('email');
        $callbackUrl = route('payment.callback');
        $secretKey = 'sk_test_66104f4657701dd6db15cf77ae480356be054f89'; // Your Paystack secret key

        try {
            $response = Http::post('https://api.paystack.co/transaction/initialize', [
                'amount' => $amount * 100, // Convert to kobo (100 kobo = 1 Naira)
                'currency' => 'GHS', // Use GHS for Ghana Cedis or USD for US Dollars
                'email' => $email,
                'callback_url' => $callbackUrl,
            ], [
                'headers' => [
                    'Authorization' => 'Bearer ' . $secretKey,
                    'Content-Type' => 'application/json',
                ],
            ]);

            $data = $response->json();
            
            if ($response->successful() && $data['status'] === true) {
                // Redirect the user to the payment page
                return redirect($data['data']['authorization_url']);
            } else {
                // Handle the error and redirect back with an error message
                return redirect()->back()->with('error', 'Payment initialization failed. Please try again.');
            }
        } catch (\Exception $e) {
            // Handle any exceptions here
            return redirect()->back()->with('error', 'Payment initialization failed. Please try again.');
        }
    }

    public function paymentCallback(Request $request)
    {
        // Verify the payment and get the details
        $paymentDetails = $this->paystack->transaction->verify([
            'reference' => $request->input('reference'),
        ]);

        // Handle the payment result here
        if ($paymentDetails->data->status === 'success') {
            // Payment was successful
            return view('payment.success', ['paymentDetails' => $paymentDetails]);
        } else {
            // Payment failed
            return view('payment.failure', ['paymentDetails' => $paymentDetails]);
        }
    }*/

    


