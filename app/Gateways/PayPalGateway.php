<?php

namespace App\Gateways;

use App\Contracts\PaymentGateway;

class PayPalGateway implements PaymentGateway {
    public function pay($amount) {
        // PayPal-specific logic here
        return "Paid $amount via PayPal";
    }
}
