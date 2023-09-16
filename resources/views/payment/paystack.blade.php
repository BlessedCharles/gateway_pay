<form id="paymentForm">
    <div class="form-group">
      <label for="email">Email Address</label>
      <input type="email" id="email-address" required />
    </div>
    <div class="form-group">
      <label for="amount">Amount</label>
      <input type="tel" id="amount" required />
    </div>
    <div class="form-group">
      <label for="first-name">First Name</label>
      <input type="text" id="first-name" />
    </div>
    <div class="form-group">
      <label for="last-name">Last Name</label>
      <input type="text" id="last-name" />
    </div>
    <div class="form-submit">
      <button type="submit" onclick="payWithPaystack()"> Pay </button>
    </div>
  </form>
  
  <script src="https://js.paystack.co/v1/inline.js"></script>
  <script>
    const paymentForm = document.getElementById('paymentForm');
paymentForm.addEventListener("submit", payWithPaystack, false);

function payWithPaystack(e) {
  e.preventDefault();

  let handler = PaystackPop.setup({
    key: 'pk_test_aab5f9bdbcb2f01bc6fb6f5d3293dcc3e6882b60', // Replace with your public key
    email: document.getElementById("email-address").value,
    amount: document.getElementById("amount").value * 100,
    currency: 'GHS', // Use GHS for Ghana Cedis or USD for US Dollars
    ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
    // label: "Optional string that replaces customer email"
    onClose: function(){
      alert('Window closed.');
    },
    callback: function(response){
      let message = 'Payment complete! Reference: ' + response.reference;
      alert(message);
    }
  });

  handler.openIframe();
}
  </script>