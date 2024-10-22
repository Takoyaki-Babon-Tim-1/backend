@extends('front.layouts.app')

@section('content')
    <div class="container px-4 py-8 mx-auto">
        <h1 class="mb-6 text-2xl font-bold">Checkout</h1>
        <h3>Total: {{ number_format($totalPrice, 0, ',', '.') }}</h3>
        <!-- Show Snap token to trigger Midtrans payment popup -->
        <button id="pay-button" class="px-4 py-2 font-bold text-white bg-indigo-500 rounded hover:bg-indigo-700">
            Bayar Sekarang
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
