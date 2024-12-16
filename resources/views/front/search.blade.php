@extends('front.layouts.app')

@section('content')
    <nav class="flex items-center justify-between px-5 mt-[30px]">
        <a href="/" class="flex shrink-0">
            <img src="{{ asset('assets/images/logos/takoyaki-babon-logo.svg') }}" alt="icon" class="w-32">
        </a>
        <div class="flex items-center gap-1">
            @guest
                <a href="/login" class="text-sm font-semibold">Masuk |</a>
                <a href="/register" class="text-sm font-semibold">Daftar</a>
            @endguest
            @auth
                <a href="{{ route('cart.index') }}">
                    <div class="relative">
                        <div
                            class="flex items-center justify-center w-10 h-10 rounded-full bg-white transition-all duration-300 hover:shadow-[0_10px_20px_0_#EBF40080]">
                            <img src="/assets/images/icons/cart-hitam.svg" class="object-contain w-5 h-5" alt="icon">
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
        <form action="{{ route('front.search') }}" method="GET"
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
    <div class="px-5 mt-[30px]">
        <h2 class="font-semibold">Hasil Pencarian untuk: "{{ request('search') }}"</h2>

        @if ($products->isEmpty())
            <p>Tidak ada produk yang ditemukan.</p>
        @else
            <div class="w-full px-5 mt-3 ">
                <div>
                    @forelse ($products as $product)
                        <div class="mt-4">
                            <a href="{{ route('front.detail', $product->slug) }}" class="card">
                                <div class="flex flex-row justify-between w-full gap-2 pb-5 transition-all duration-300 border-b-2 rounded-xl"
                                    @if ($loop->last) style="border-bottom: none;" @endif>
                                    <div class="w-6/12">
                                        <h3 class="min-h-[14px] text-lg font-semibold leading-[27px] truncate">
                                            {{ $product->name }}
                                        </h3>
                                        <p class="mt-auto mb-8 text-lg font-semibold">
                                            Rp {{ number_format($product->price, 0, ',', '.') }}
                                        </p>
                                    </div>
                                    <div class="flex flex-col items-end justify-end w-auto">
                                        <div class="w-full max-w-[150px] max-h-[150px]">
                                            <!-- Image container -->
                                            <div class="w-full max-w-[240px]  max-h-[150px]">
                                                <img src="{{ Storage::url($product->thumbnail) }}" alt="image"
                                                    class="object-contain w-full max-w-[240px] h-auto   max-h-[150px] rounded-xl" />
                                            </div>
                                        </div>
                                        <div class="flex justify-center w-full -mt-8">
                                            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                                @csrf
                                                <button type="submit"
                                                    class="bg-[#EBF400] text-black text-base font-semibold w-full max-w-[180px] py-1 px-4 rounded-full hover:bg-[#d86e47] transition-all duration-300">
                                                    Tambah
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @empty
                        <p class="text-center text-gray-500">Tidak ada produk dalam kategori ini.</p>
                    @endforelse
                </div>
            </div>
        @endif
    </div>
@endsection
