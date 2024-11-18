@extends('front.layouts.app')
@section('content')
    <nav class="flex items-center justify-between px-5 mt-[30px]">
        <a href="index.html" class="flex shrink-0">
            <img src="{{ asset('assets/images/logos/takoyaki-babon-logo.svg') }}" alt="icon" class="w-32">
        </a>
        <div class="flex items-center gap-1">
            @guest
                <a href="/login" class="text-sm font-semibold ">Masuk |</a>
                <a href="/register" class="text-sm font-semibold ">Daftar</a>
            @endguest
            @auth
                <a href="{{ route('cart.index') }}">
                    <div class="relative">
                        <div
                            class="flex items-center justify-center w-10 h-10 rounded-full bg-white shadow-[0_10px_20px_0_#D6D6D6AB] transition-all duration-300 hover:shadow-[0_10px_20px_0_#EBF40080]">
                            <img src="https://img.icons8.com/material-outlined/48/shopping-cart--v1.png"
                                class="object-contain w-5 h-5" alt="icon">
                        </div>

                        @if ($cartItemCount > 0)
                            <span
                                class="absolute bottom-0 right-0 flex items-center justify-center w-4 h-4 text-xs font-semibold text-white bg-[#EBF400] rounded-full">
                                {{ $cartItemCount }}
                            </span>
                        @endif
                    </div>
                </a>
            @endauth
        </div>

    </nav>
    <div id="SearchForm" class="px-5 mt-[30px]">
        <form action="search.html"
            class="flex items-center rounded-full p-[5px_14px] pr-[5px] gap-[10px] bg-white shadow-[0_12px_30px_0_#D6D6D652] transition-all duration-300 focus-within:ring-1 focus-within:ring-[#EBF400]">
            <img src="assets/images/icons/menu.svg" alt="icon">
            <input type="text" name="search" id="search"
                class="w-full font-semibold outline-none appearance-none placeholder:font-normal placeholder:text-gray-300"
                placeholder="Mau makan apa nih hari ini?">
            <button type="submit" class="flex items-baseline shrink-0">
                <img src="assets/images/icons/search.svg" alt="icon">
            </button>
        </form>
    </div>
    {{-- <img src="{{ Storage::url($category->icon) }}" class="object-cover " alt="icon"> --}}
    {{-- Caategory --}}
    <section id="Categories" class="mt-[30px] ">
        <div class="flex items-center justify-between px-5">
            <h2 class="font-semibold">Kategori Menu</h2>
        </div>
        <div class="w-full px-5 mt-3">
            <div class="grid grid-cols-4 gap-2 justify-items-stretch sm:grid-cols-4 lg:grid-cols-4 ">
                @forelse ($categories as $category)
                    <div class="w-full ">
                        <a href="category.html" class="card">
                            <div class="flex flex-col w-full  rounded-xl text-center bg-[#EBF400]">
                                <div class="flex justify-center w-full h-auto sm:w-16 lg:w-full">
                                    <img src="assets/images/thumbnails/thumbnail-1.png"
                                        class="object-contain w-full h-full rounded-t-xl" alt="icon">
                                </div>

                                <div class="py-2 md:py-3">
                                    <h3 class="text-sm font-medium">{{ $category->name }}</h3>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                @endforelse
            </div>

        </div>

    </section>
    {{-- End Category --}}



    {{-- diskon --}}
    @if ($discountedProducts->isNotEmpty())
        <section id="Diskon">
            <div class="flex items-center justify-between px-5 my-4">
                <div class="flex gap-2 ">
                    <h2 class="font-semibold">Diskon Hari ini </h2>
                    <img src="/assets/images/icons/discount.svg" alt="discount">
                </div>
                <a href="#" class="text-xs font-medium">Lihat Semua</a>
            </div>
            <div class="swiper w-full mt-3 pb-[100px]">
                <div class="swiper-wrapper">
                    {{-- ITEM YANG DISKON --}}
                    @foreach ($discountedProducts as $product)
                        <div class="swiper-slide w-fit">
                            <a href="{{ route('front.detail', ['product' => $product->slug]) }}" class="card">
                                <div
                                    class="w-40 space-y-[10px] rounded-xl  pb-5 transition-all duration-300 hover:border-[#EBF400]">
                                    <div
                                        class="flex h-full  w-full shrink-0 items-center justify-center overflow-hidden rounded-xl bg-[#D9D9D9]">
                                        <div
                                            class="font-bold text-xs leading-[18px] text-white bg-red-500 p-[10px_10px] rounded-full w-fit absolute top-[10px] left-[10px]">
                                            -{{ $product->discount_percentage }}%
                                        </div>
                                        {{-- GAMBAR PRODUK --}}
                                        <img src="{{ Storage::url($product->thumbnail) }}" alt="image"
                                            class="object-cover w-full h-auto" />
                                    </div>
                                    <div>
                                        {{-- NAMA PRODUK --}}
                                        <h3 class="min-h-[14px] text-lg font-semibold leading-[27px]">
                                            {{ $product->name }}</h3>
                                        {{-- HARGA --}}
                                        <p class="mt-auto mb-8 text-lg font-semibold ">Rp
                                            {{ number_format($product->total, 0, ',', '.') }} <span
                                                class="text-sm font-normal text-red-500 line-through text-ngekos-gray">Rp
                                                {{ number_format($product->price, 0, ',', '.') }}</span></p>
                                        <form
                                            action="{{ route('cart.add', ['productId' => $product->id, 'from' => 'index']) }}"
                                            method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="bg-[#EBF400] text-black text-base font-semibold w-full py-1 px-4 rounded-full hover:bg-[#d86e47] transition-all duration-300">
                                                Tambah
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    @if (session('success'))
        <script>
            Swal.fire({
                title: 'Success!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
    {{-- end diskon --}}

    {{-- Nav --}}
    <div id="BottomNav"
        class="fixed z-50 bottom-0 w-full max-w-[640px] mx-auto border-t border-[#E7E7E7] py-4 px-5 bg-white/70 backdrop-blur">
        <div class="flex items-center justify-evenly ">
            <a href="#" class="nav-items">
                <div class="flex flex-col items-center text-center gap-[7px] text-sm leading-[21px] font-semibold">
                    <img src="assets/images/icons/jelajahi.svg" class="w-6 h-6" alt="icon">
                    <span>Beranda</span>
                </div>
            </a>
            <a href="#" class="nav-items">
                <div class="flex flex-col items-center text-center gap-[7px] text-sm leading-[21px]">
                    <img src="assets/images/icons/cart-black.svg" class="w-6 h-6" alt="icon">
                    <span>Keranjang</span>
                </div>
            </a>
            <a href="#" class="nav-items">
                <div class="flex flex-col items-center text-center gap-[7px] text-sm leading-[21px]">
                    <img src="assets/images/icons/riwayat-black.svg" class="w-6 h-6" alt="icon">
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


    @if (!Auth::check())
        <div id="onboarding" class="fixed inset-0 z-50 flex items-center justify-center bg-black/60">
            <div class="relative max-w-[640px] p-5 bg-white md:rounded-2xl shadow-lg text-center h-full md:h-[90%]">
                <div class="flex items-center justify-between mb-8 mt-[-10px] pt-3">
                    <div class="flex items-center justify-center w-[100px] h-[40px]">
                        <img src="assets/images/logos/takoyaki-babon-logo.svg" alt="">
                    </div>
                    <button onclick="closeOnboarding()" class="flex items-center justify-center mt-[2px]">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <img src="assets/images/thumbnails/onboarding-1.png" alt="Takoyaki Babon"
                    class="w-full h-60 object-cover rounded-lg mb-4">
                <h2 class="text-lg font-bold">Selamat datang di Takoyaki Babon!</h2>
                <p class="mt-2 text-sm text-gray-600">
                    Nikmati kelezatan takoyaki autentik yang lebih dari sekadar gigitan. Pesan sekarang dan rasakan
                    sensasinya!
                </p>
                <div class="mt-4 space-y-3">
                    <a href="/login"
                        class="block w-full py-2 text-white bg-yellow-400 rounded-full font-semibold hover:bg-yellow-500">
                        Masuk
                    </a>
                    <a href="/register"
                        class="block w-full py-2 text-yellow-400 border border-yellow-400 rounded-full font-semibold hover:bg-yellow-400 hover:text-white">
                        Belum ada akun? Daftar dulu
                    </a>
                </div>
            </div>
        </div>
    @endif


@endsection
