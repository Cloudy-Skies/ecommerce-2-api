
<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Payments</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  </head>
  <body>
    <h1>Payment Test and Verification</h1>
    <form id="paymentForm">

      <div class="form-group">

      <label for="email">Email Address</label>

      <input type="email" id="email-address" required placeholder="Enter email here..." />

      </div>

      <div class="form-group">

      <label for="amount">Amount</label>

      <input type='tel' id="amount" required placeholder="Enter amount here..."/>

      </div>


      <div class="form-group">

      <button type="button" onclick="payWithPaystack()"> Pay </button>

      </div>

    </form>


  <script src="payment.js"></script> 
  <script src="https://js.paystack.co/v1/inline.js"></script>
  </body>
</html>