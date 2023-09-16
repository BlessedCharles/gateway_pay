<?php
// app/Contracts/PaymentService.php

namespace App\Contracts;

interface PaymentService
{
    public function pay($amount);
    public function paymentCallback($request);
}
