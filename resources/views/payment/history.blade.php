@extends('front.layouts.app')
@section('content')
    <div class="mx-auto max-w-[540px] rounded-lg bg-white p-4">
        {{-- HEADING --}}
        <div class="pb-8">
            <h1 class="text-2xl font-semibold ">Riwayat</h1>
        </div>
        {{-- LIST PICKER FILTERING --}}
        <div class="flex flex-row pb-3 gap-x-10">
            <div><a href="#" class="text-lg font-medium underline decoration-2 underline-offset-2 ">Semua</a></div>
            <div><a href="#" class="text-lg font-medium text-gray-400 ">Selesai</a></div>
            <div><a href="#" class="text-lg font-medium text-gray-400 ">Dibatalkan</a></div>
        </div>

        <div class="bg-white rounded-xl">
            <p>ID <span class="font-bold">ORDER-1730387429-5</span></p>
            <hr class="text-gray-200">


            <div id="order-content" class="flex flex-col gap-y-3 overflow-hidden max-h-[120px] transition-all duration-300">
                <div class="flex flex-row justify-between pt-2">
                    <div class="flex flex-row items-center justify-center gap-x-3">
                        <div class="w-6/12">
                            <img src="{{ asset('assets/images/thumbnails/thumbnail-1.png') }}" alt="image-order"
                                class="object-contain w-full max-w-[90px] h-auto rounded-xl">
                        </div>
                        <div class="flex flex-col">
                            <p class="font-bold truncate">Takoyaki Panas</p>
                            <p>19 Sep 2024</p>
                        </div>
                    </div>
                    <div>
                        <div class="bg-[#E6F2F2] text-[#27AE60] flex items-center justify-center py-1 px-3">Sukses</div>
                        <div class="flex items-end pt-10">Rp 10.000</div>
                    </div>
                </div>


                <div class="flex flex-row justify-between pt-2">
                    <div class="flex flex-row items-center justify-center gap-x-3">
                        <div class="w-6/12">
                            <img src="{{ asset('assets/images/thumbnails/thumbnail-1.png') }}" alt="image-order"
                                class="object-contain w-full max-w-[90px] h-auto rounded-xl">
                        </div>
                        <div class="flex flex-col">
                            <p class="font-bold truncate">Takoyaki Keju</p>
                            <p>20 Sep 2024</p>
                        </div>
                    </div>
                    <div>
                        <div class="bg-[#E6F2F2] text-[#27AE60] flex items-center justify-center py-1 px-3">Sukses</div>
                        <div class="flex items-end mt-10">Rp 15.000</div>
                    </div>
                </div>
            </div>

            {{-- LIHAT SEMUA --}}
            <div class="flex flex-col items-center justify-center w-full pt-2">
                <button id="toggle-button" class="flex flex-col items-center pb-2 text-sm font-normal gap-x-1">
                    <div>
                        <div id="button-text"> Lihat Semua </div>
                    </div>
                    <div> <img id="toggle-icon" src="{{ asset('assets/images/icons/down.svg') }}" alt="down-arrow"
                            class="transition-transform"></div>


                </button>
            </div>


            <div class="flex flex-row justify-between pt-2">
                <div></div>
                <div>
                    <p>Total: Rp 25.000</p>
                    <div class="pt-2 place-self-end">
                        <button class="px-3 py-1 bg-[#EBF400] rounded-xl font-semibold">Pesan lagi</button>
                    </div>
                </div>
            </div>
        </div>



        <div class="bg-white rounded-xl">
            <p>ID <span class="font-bold">ORDER-1730387429-5</span></p>
            <hr class="text-gray-200">
            <div class="flex flex-row justify-between pt-2">
                <div class="flex flex-row items-center justify-center gap-x-3">
                    <div class="w-6/12"><img src="assets/images/thumbnails/thumbnail-1.png" alt="image-order"
                            class="object-contain w-full max-w-[90px] h-auto rounded-xl"></div>
                    <div class="flex flex-col">
                        <div>
                            <p class="font-bold truncate ">Takoyaki Panas</p>
                        </div>
                        <div>
                            <p>19 Sep 2024</p>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="bg-[#FEF4EE] text-[#FF0000] flex items-center justify-center py-1 px-3">Gagal</div>
                    <div class="flex items-end pt-10">Rp 10.000</div>
                </div>
            </div>
        </div>
    </div>


    <div id="BottomNav"
        class="fixed z-50 bottom-0 w-full max-w-[640px] mx-auto border-t border-[#E7E7E7] py-4 px-5 bg-white/70 backdrop-blur">
        <div class="flex items-center justify-evenly ">
            <a href="{{ route('front.index') }}" class="nav-items">
                <div class="flex flex-col items-center text-center gap-[7px] text-sm leading-[21px] font-semibold">
                    <img src="assets/images/icons/jelajahi-hitam.svg" class="w-6 h-6" alt="icon">
                    <span>Beranda</span>
                </div>
            </a>
            <a href="{{ route('cart.index') }}"" class="nav-items">
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
            <a href="{{ route('customer.profile') }}"class="nav-items">
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
                toggleIcon.src =
                    '{{ asset('assets/images/icons/down.svg') }}';
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
