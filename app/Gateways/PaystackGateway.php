<?php

// app/Gateways/PaystackGateway.php
namespace App\Gateways;

use App\Contracts\PaymentGateway;

class PaystackGateway implements PaymentGateway {
    public function pay($amount) {
        // Paystack-specific logic here
        return "Paid $amount via Paystack";
    }
}

