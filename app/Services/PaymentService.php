<?php

// app/Services/PaymentService.php
namespace App\Services;

use App\Contracts\PaymentGateway;

class PaymentService {
    protected $gateway;

    public function setGateway(PaymentGateway $gateway) {
        $this->gateway = $gateway;
    }

    public function processPayment($amount) {
        return $this->gateway->pay($amount);
    }
}

