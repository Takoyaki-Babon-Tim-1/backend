@extends('front.layouts.app')
@section('content')
    <nav class="flex items-center justify-between px-5 mt-[30px]">
        <a href="index.html" class="flex shrink-0">
            <p class="font-bold">Takoyaki Babon</p>
        </a>
        <div class="flex items-center gap-1">
            @guest
                <a href="/login">Masuk |</a>
                <a href="/register">Daftar</a>
            @endguest
            @auth
                <a href="{{ route('cart.index') }}">
                    <div class="relative">
                        <div
                            class="flex items-center justify-center w-10 h-10 rounded-full bg-white shadow-[0_10px_20px_0_#D6D6D6AB] transition-all duration-300 hover:shadow-[0_10px_20px_0_#DFDC0080]">
                            <img src="https://img.icons8.com/material-outlined/48/shopping-cart--v1.png"
                                class="object-contain w-5 h-5" alt="icon">
                        </div>

                        @if ($cartItemCount > 0)
                            <span
                                class="absolute bottom-0 right-0 flex items-center justify-center w-4 h-4 text-xs font-semibold text-white bg-[#DFDC00] rounded-full">
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
            class="flex items-center rounded-full p-[5px_14px] pr-[5px] gap-[10px] bg-white shadow-[0_12px_30px_0_#D6D6D652] transition-all duration-300 focus-within:ring-1 focus-within:ring-[#DFDC00]">
            <img src="assets/images/icons/note-favorite.svg" class="w-6 h-6" alt="icon">
            <input type="text" name="search" id="search"
                class="w-full font-semibold outline-none appearance-none placeholder:font-normal placeholder:text-black"
                placeholder="Mau makan apa hari ini?">
            <button type="submit" class=" flex shrink-0 w-[42px] h-[42px]">
                <img src="assets/images/icons/search.svg" alt="icon">
            </button>
        </form>
    </div>

    {{-- Caategory --}}
    <section id="Categories" class="mt-[30px]">
        <div class="flex items-center justify-between px-5">
            <h2 class="font-bold">Kategori</h2>
        </div>
        <div class="w-full mt-3 swiper">
            <div class="swiper-wrapper">
                @forelse ($categories as $category)
                    <div class="swiper-slide !w-fit pb-[30px]">
                        <a href="category.html" class="card">
                            <div
                                class="flex flex-col w-fit min-w-[90px] rounded-xl p-[10px] pb-5 gap-[10px] text-center bg-white shadow-[0_12px_30px_0_#D6D6D680] transition-all duration-300 hover:shadow-[0_10px_20px_0_#F57C51] hover:bg-[#F57C51] hover:text-white">
                                <div class="flex shrink-0 w-[70px] h-[70px] rounded-full bg-white">
                                    <img src="{{ Storage::url($category->icon) }}"
                                        class="object-cover object-top w-full h-full" alt="icon">
                                </div>
                                <h3 class="font-semibold text-sm leading-[21px]">{{ $category->name }}</h3>
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
            <div class="flex items-center justify-between px-5">
                <h2 class="font-bold">Produk Diskon</h2>
                <a href="#" class="font-semibold text-sm leading-[21px] text-[#F57C51]">Lihat Semua</a>
            </div>
            <div class="swiper w-full mt-3 pb-[100px]">
                <div class="swiper-wrapper">

                    @foreach ($discountedProducts as $product)
                        <div class="swiper-slide w-fit">
                            <a href="{{ route('front.detail', ['product' => $product->slug]) }}" class="card">
                                <div
                                    class="w-[250px] shrink-0 space-y-[10px] rounded-[30px] border border-[#F1F2F6] p-4 pb-5 transition-all duration-300 hover:border-[#F57C51]">
                                    <div
                                        class="flex h-[150px] w-full shrink-0 items-center justify-center overflow-hidden rounded-[30px] bg-[#D9D9D9]">
                                        <div
                                            class="font-bold text-xs leading-[18px] text-white bg-red-500 p-[10px_10px] rounded-full w-fit absolute top-[10px] left-[10px]">
                                            -{{ $product->discount_percentage }}%
                                        </div>
                                        <img src="{{ Storage::url($product->thumbnail) }}" alt="image"
                                            class="object-cover w-full h-full" />
                                    </div>
                                    <div class="space-y-3">
                                        <h3 class="line-clamp-2 min-h-[14px] text-lg font-semibold leading-[27px]">
                                            {{ $product->name }}</h3>
                                        <hr class="border-[#F1F2F6]" />
                                        <p class="text-lg font-semibold text-ngekos-orange">Rp
                                            {{ number_format($product->total, 0, ',', '.') }} <span
                                                class="text-sm font-normal text-red-500 line-through text-ngekos-gray">Rp
                                                {{ number_format($product->price, 0, ',', '.') }}</span></p>
                                        <form
                                            action="{{ route('cart.add', ['productId' => $product->id, 'from' => 'index']) }}"
                                            method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="bg-[#F57C51] text-white py-2 px-4 rounded-lg hover:bg-[#d86e47] transition-all duration-300">
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
                    <img src="assets/images/icons/note-favorite-orange.svg" class="w-6 h-6" alt="icon">
                    <span>Jelajahi</span>
                </div>
            </a>
            <a href="#" class="nav-items">
                <div class="flex flex-col items-center text-center gap-[7px] text-sm leading-[21px]">
                    <img src="assets/images/icons/crown-grey.svg" class="w-6 h-6" alt="icon">
                    <span>Keranjang</span>
                </div>
            </a>
            <a href="#" class="nav-items">
                <div class="flex flex-col items-center text-center gap-[7px] text-sm leading-[21px]">
                    <img src="assets/images/icons/receipt-item-grey.svg" class="w-6 h-6" alt="icon">
                    <span>Aktivitas</span>
                </div>
            </a>
            <a href="{{ route('customer.profile') }}" class="nav-items">
                <div class="flex flex-col items-center text-center gap-[7px] text-sm leading-[21px]">
                    <img src="assets/images/icons/setting-2-grey.svg" class="w-6 h-6" alt="icon">
                    <span>Profil</span>
                </div>
            </a>
        </div>
    </div>


    <div id="onboarding" class="fixed inset-0 z-50 flex items-center justify-center bg-black/60">
        <div class="relative max-w-[640px] p-5 bg-white md:rounded-2xl shadow-lg text-center h-full md:h-[90%]">
            <div class="flex items-center justify-between mb-8 mt-[-10px] pt-3">
                <div class="flex items-center justify-center w-[100px] h-[40px]">
                    <img src="assets/images/logos/logo-babon.png" alt="">
                </div>
                <button onclick="closeOnboarding()"
                    class="flex items-center justify-center mt-[2px]">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <img src="assets/images/thumbnails/onboarding-1.png" alt="Takoyaki Babon"
                class="w-full h-60 object-cover rounded-lg mb-4">
            <h2 class="text-lg font-bold">Selamat datang di Takoyaki Babon!</h2>
            <p class="mt-2 text-sm text-gray-600">
                Nikmati kelezatan takoyaki autentik yang lebih dari sekadar gigitan. Pesan sekarang dan rasakan sensasinya!
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


@endsection
