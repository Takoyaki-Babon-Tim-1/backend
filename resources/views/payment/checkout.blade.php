@extends('front.layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6">Checkout</h1>
        <h3>Total: {{ number_format($totalPrice, 0, ',', '.') }}</h3>
        <!-- Show Snap token to trigger Midtrans payment popup -->
        <button id="pay-button" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
            Pay Now
        </button>
    </div>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>
    <script type="text/javascript">
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function() {
            snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    // Tampilkan SweetAlert jika pembayaran berhasil
                    Swal.fire({
                        title: 'Pembayaran Berhasil!',
                        text: 'Terima kasih, pembayaran Anda telah diterima.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(function() {
                        // Redirect ke halaman setelah SweetAlert ditutup
                        window.location.href = "/";
                    });
                    
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
@endsection
