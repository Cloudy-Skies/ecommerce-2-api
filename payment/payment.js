var paymentForm = document.getElementById("paymentForm");

paymentForm.addEventListener("submit", payWithPaystack, false);

function payWithPaystack() {
  var handler = PaystackPop.setup({
    key: "pk_test_ecd5ba45d5bf06da6e56cf2fee806d6835e24c85", // Replace with your public key

    email: document.getElementById("email-address").value,

    amount: document.getElementById("amount").value * 100, // the amount value is multiplied by 100 to convert to the lowest currency unit

    currency: "GHS", // Use GHS for Ghana Cedis or USD for US Dollars

    ref: "" + Math.floor(Math.random() * 1000000000 + 1), // Replace with a reference you generated

    // callback: function (response) {
    //   //this happens after the payment is completed successfully

    //   var reference = response.ref;
    //     // code below works but we will try to verify ourselves
    // //   alert("Payment complete! Reference: " + reference);


    // //Sampa made us do this
    //   // Make an AJAX call to your server with the reference to verify the transaction
    //   let whichref= response.ref;

    //   $.ajax({
    //     type:"POST",
    //     url: 'process_paystack.php?reference='+response.ref,
    //     // method: 'get',
    //     // success: function (params) {
    //     //     alert(response);
    //     // }
    //     data:{
    //       'checkout':'active',
    //       'name': name,
    //       'email':email,
    //       'reference':reference
    //     },
    //     beforeSend: function () {
    //       console.log("Sending request");
    //       $(".alert").text('Sending request');
    //     },
    //     success: function (response) {
    //       if (response == "Transaction reference not found") {
    //         $(".alert").text('Transaction reference not found');
    //       }else{

    //         $()
    //       }
    //     }
    //   })
    // },

    // reference=response.ref
    callback: function(response) {

      window.location = "process_paystack.php?reference=" + response.reference;
    
    },

    onClose: function () {
      alert("Transaction was not completed, window closed.");
    },
  });

  handler.openIframe();

}


