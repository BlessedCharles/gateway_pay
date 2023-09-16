// resources/js/payment.js

document.addEventListener("DOMContentLoaded", function () {
    const paymentForm = document.getElementById('paymentForm');
    paymentForm.addEventListener("submit", function (e) {
        e.preventDefault();

        const selectedGateway = document.getElementById("gateway").value;
        const email = document.getElementById("email").value;
        const amount = document.getElementById("amount").value;

        if (selectedGateway === 'paystack') {
            initiatePaystackPayment(email, amount);
        } else if (selectedGateway === 'paypal') {
            // Handle PayPal payment initiation here
        }
        // Add more payment gateway handling as needed
    });
});

function initiatePaystackPayment(email, amount) {
    const publicKey = 'your-paystack-public-key'; // Replace with your Paystack public key
    const reference = generateReference();

    const handler = PaystackPop.setup({
        key: publicKey,
        email: email,
        amount: amount * 100, // Amount in kobo (100 kobo = 1 Naira)
        currency: 'NGN', // Use your desired currency code
        ref: reference,
        callback: function (response) {
            // Handle successful payment here
            console.log(response);
            // You may want to send payment details to your server for verification
            verifyPaystackPayment(reference);
        },
        onClose: function () {
            // Handle payment window close
            console.log('Payment window closed.');
        }
    });

    handler.openIframe();
}

function generateReference() {
    // Generate a unique payment reference (e.g., timestamp or random string)
    return 'PAY' + Date.now();
}

function verifyPaystackPayment(reference) {
    // Send an AJAX request to your server to verify the payment
    // Example: fetch('/api/verify-paystack-payment', { method: 'POST', body: JSON.stringify({ reference }) })
    // Handle payment verification on your server
}
