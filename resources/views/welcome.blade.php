@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Welcome to Our Payment Gateway</h1>
    <p>Click below to make a payment:</p>
    <a href="{{ route('show.payment.form') }}" class="btn btn-primary">Make a Payment</a>
</div>
@endsection
