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
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>

    <script type="text/javascript">
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function() {
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    alert("Pembayaran berhasil!");
                    console.log(result);
                },
                onPending: function(result) {
                    alert("Menunggu pembayaran!");
                    console.log(result);
                },
                onError: function(result) {
                    alert("Pembayaran gagal!");
                    console.log(result);
                },
                onClose: function() {
                    alert('Anda menutup pop-up tanpa menyelesaikan pembayaran');
                }
            });
        });
    </script>
    {{-- <script type="module">
        import {
            initializeApp
        } from "https://www.gstatic.com/firebasejs/11.0.1/firebase-app.js";
        import {
            getMessaging,
            onMessage
        } from "https://www.gstatic.com/firebasejs/11.0.1/firebase-messaging.js";

        const firebaseConfig = {
            apiKey: "AIzaSyB8Zd5E5RTmIsjJTZXUE58vosQXHhnGWJc",
            authDomain: "takoyaki-ba16a.firebaseapp.com",
            projectId: "takoyaki-ba16a",
            storageBucket: "takoyaki-ba16a.appspot.com",
            messagingSenderId: "994555351260",
            appId: "1:994555351260:web:a2925c0f7c124df8a56419",
            measurementId: "G-LRNZMLFN4P"
        };


        const app = initializeApp(firebaseConfig);
        const messaging = getMessaging(app);

        onMessage(messaging, (payload) => {
            console.log('Message received. ', payload);
            alert(payload.notification.title + ": " + payload.notification.body);
        });
    </script> --}}

</body>

</html>
