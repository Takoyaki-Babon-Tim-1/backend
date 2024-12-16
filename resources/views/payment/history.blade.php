@extends('front.layouts.app')

@section('content')
    <div class="mx-auto max-w-[540px] rounded-lg bg-white p-4">
        {{-- HEADING --}}
        <div class="pb-8">
            <h1 class="text-2xl font-semibold">Riwayat</h1>
        </div>

        <div class="flex flex-row pb-3 gap-x-10">
            <div><a href="{{ route('payment.history', ['status' => 'semua']) }}"
                    class="text-lg font-medium {{ request('status') === 'semua' ? 'underline decoration-2 underline-offset-2' : 'text-gray-400' }}">Semua</a>
            </div>
            <div><a href="{{ route('payment.history', ['status' => 'selesai']) }}"
                    class="text-lg font-medium {{ request('status') === 'selesai' ? 'underline decoration-2 underline-offset-2' : 'text-gray-400' }}">Selesai</a>
            </div>
            <div><a href="{{ route('payment.history', ['status' => 'dibatalkan']) }}"
                    class="text-lg font-medium {{ request('status') === 'dibatalkan' ? 'underline decoration-2 underline-offset-2' : 'text-gray-400' }}">Dibatalkan</a>
            </div>
        </div>

        {{-- Cek jika tidak ada order --}}
        @if (isset($noOrdersMessage))
            <div class="py-4 text-center text-gray-600">
                <p>{{ $noOrdersMessage }}</p>
            </div>
        @else
            @foreach ($orders as $order)
                <div class="mb-4 bg-white rounded-xl">
                    <p>ID <span class="font-bold">{{ $order->order_id }}</span></p>
                    <hr class="text-gray-200">

                    <div id="order-content"
                        class="flex flex-col gap-y-3 overflow-hidden max-h-[120px] transition-all duration-300">
                        @foreach ($order->products as $product)
                            <div class="flex flex-row justify-between pt-2">
                                <div class="flex flex-row items-center justify-center gap-x-3">
                                    <div class="w-6/12">
                                        <img src="{{ Storage::url($product->thumbnail) }}" alt="image-order"
                                            class="object-contain w-full max-w-[90px] h-auto rounded-xl">
                                    </div>
                                    <div class="flex flex-col">
                                        <p class="font-bold truncate">{{ $product->name }}</p>
                                        <p>{{ $order->created_at->format('d M Y') }}</p>
                                    </div>
                                </div>
                                <div>
                                    <div class="bg-[#E6F2F2] text-[#27AE60] flex items-center justify-center py-1 px-3">
                                        {{ $order->status }}</div>
                                    <div class="flex items-end pt-10">Rp
                                        {{ number_format($order->total_price, 0, ',', '.') }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Lihat Semua Button --}}
                    <div class="flex flex-col items-center justify-center w-full pt-2">
                        <button id="toggle-button" class="flex flex-col items-center pb-2 text-sm font-normal gap-x-1">
                            <div>
                                <div id="button-text">Lihat Semua</div>
                            </div>
                            <div>
                                <img id="toggle-icon" src="{{ asset('assets/images/icons/down.svg') }}" alt="down-arrow"
                                    class="transition-transform">
                            </div>
                        </button>
                    </div>

                    <div class="flex flex-row justify-between pt-2">
                        <div></div>
                        <div>
                            <p>Total: Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                            <div class="pt-2 place-self-end">
                                <button class="px-3 py-1 bg-[#EBF400] rounded-xl font-semibold">Pesan lagi</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    {{-- Bottom Navigation --}}
    <div id="BottomNav"
        class="fixed z-50 bottom-0 w-full max-w-[640px] mx-auto border-t border-[#E7E7E7] py-4 px-5 bg-white/70 backdrop-blur">
        <div class="flex items-center justify-evenly">
            <a href="{{ route('front.index') }}" class="nav-items">
                <div class="flex flex-col items-center text-center gap-[7px] text-sm leading-[21px] font-semibold">
                    <img src="assets/images/icons/jelajahi-hitam.svg" class="w-6 h-6" alt="icon">
                    <span>Beranda</span>
                </div>
            </a>
            <a href="{{ route('cart.index') }}" class="nav-items">
                <div class="flex flex-col items-center text-center gap-[7px] text-sm leading-[21px]">
                    <img src="assets/images/icons/cart-black.svg" class="w-6 h-6" alt="icon">
                    <span>Keranjang</span>
                </div>
            </a>
            <a href="{{ route('payment.history') }}" class="nav-items">
                <div class="flex flex-col items-center text-center gap-[7px] text-sm leading-[21px]">
                    <img src="assets/images/icons/riwayat-kuning.svg" class="w-6 h-6" alt="icon">
                    <span>Aktivitas</span>
                </div>
            </a>
            <a href="{{ route('customer.profile') }}" class="nav-items">
                <div class="flex flex-col items-center text-center gap-[7px] text-sm leading-[21px]">
                    <img src="assets/images/icons/profil-black.svg" class="w-6 h-6" alt="icon">
                    <span>Profil</span>
                </div>
            </a>
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleButton = document.getElementById('toggle-button');
        const orderContent = document.getElementById('order-content');
        const toggleIcon = document.getElementById('toggle-icon');
        const buttonText = document.getElementById('button-text');

        toggleButton.addEventListener('click', function() {
            if (orderContent.style.maxHeight === 'none') {
                toggleIcon.src = '{{ asset('assets/images/icons/down.svg') }}';
                orderContent.style.maxHeight = '120px';
                toggleIcon.style.transform = 'rotate(0deg)';
                buttonText.innerText = 'Lihat Semua';
            } else {
                orderContent.style.maxHeight = 'none';
                toggleIcon.src = '{{ asset('assets/images/icons/down.svg') }}';
                toggleIcon.style.transform = 'rotate(180deg)';
                buttonText.innerText = 'Tutup';
            }
        });
    });
</script>
