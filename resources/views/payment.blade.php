<!-- resources/views/payment.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
</head>
<body>
    <h1>Proceed with Payment</h1>
    <p>Total Amount: Rp {{ number_format($totalPrice, 0, ',', '.') }}</p>
    <button id="pay-button">Pay Now</button>

    <!-- Midtrans Snap.js -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>

    <script type="text/javascript">
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function () {
            // Fetch payment token from backend
            fetch('https://fabf-103-154-89-30.ngrok-free.app/payment-token')
                .then(response => response.json())
                .then(data => {
                    snap.pay(data.snap_token, {
                        onSuccess: function(result) {
                            alert('Payment Success!');
                            console.log(result);
                        },
                        onPending: function(result) {
                            alert('Payment Pending!');
                            console.log(result);
                        },
                        onError: function(result) {
                            alert('Payment Failed!');
                            console.log(result);
                        }
                    });
                });
        });
    </script>
</body>
</html>
