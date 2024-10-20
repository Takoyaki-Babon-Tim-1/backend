@extends('front.layouts.app')
@section('content')
    <nav class="flex items-center justify-between px-5 mt-[30px]">
        <a href="index.html" class="flex shrink-0">
            <p class="font-bold">Takoyaki</p>
        </a>
        <div class="flex gap-1 items-center">
            @guest
                <a href="/login">Login</a>
            @endguest
            @auth
                <p class="font-semibold">Hi, {{ Auth::user()->name }}</p>
                <a href="{{ route('cart.index') }}">
                    <div class="relative">
                        <div
                            class="flex items-center justify-center w-10 h-10 rounded-full bg-white shadow-[0_10px_20px_0_#D6D6D6AB] transition-all duration-300 hover:shadow-[0_10px_20px_0_#FF4C1C80]">
                            <img src="https://img.icons8.com/material-outlined/48/shopping-cart--v1.png"
                                class="w-5 h-5 object-contain" alt="icon">
                        </div>

                        <span
                            class="absolute bottom-0 right-0 flex items-center justify-center w-4 h-4 text-xs font-semibold text-white bg-red-600 rounded-full">
                            {{ $cartItemCount }}
                        </span>
                    </div>
                </a>
            @endauth


        </div>

    </nav>
    <div id="SearchForm" class="px-5 mt-[30px]">
        <form action="search.html"
            class="flex items-center rounded-full p-[5px_14px] pr-[5px] gap-[10px] bg-white shadow-[0_12px_30px_0_#D6D6D652] transition-all duration-300 focus-within:ring-1 focus-within:ring-[#FF4C1C]">
            <img src="assets/images/icons/note-favorite.svg" class="w-6 h-6" alt="icon">
            <input type="text" name="search" id="search"
                class="appearance-none outline-none w-full font-semibold placeholder:font-normal placeholder:text-black"
                placeholder="Find our best food recipes">
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
        <div class="swiper w-full mt-3">
            <div class="swiper-wrapper">
                @forelse ($categories as $category)
                    <div class="swiper-slide !w-fit pb-[30px]">
                        <a href="category.html" class="card">
                            <div
                                class="flex flex-col w-fit min-w-[90px] rounded-[31px] p-[10px] pb-5 gap-[10px] text-center bg-white shadow-[0_12px_30px_0_#D6D6D680] transition-all duration-300 hover:shadow-[0_10px_20px_0_#FF4C1C80] hover:bg-[#FF4C1C] hover:text-white">
                                <div class="flex shrink-0 w-[70px] h-[70px] rounded-full bg-white">
                                    <img src="{{ Storage::url($category->icon) }}"
                                        class="object-cover w-full h-full object-top" alt="icon">
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
                <a href="#" class="font-semibold text-sm leading-[21px] text-[#FF4C1C]">Explore All</a>
            </div>
            <div class="swiper w-full mt-3 pb-[100px]">
                <div class="swiper-wrapper">

                    @foreach ($discountedProducts as $product)
                        <div class="swiper-slide w-fit">
                            <a href="#" class="card">
                                <div
                                    class="w-[250px] shrink-0 space-y-[10px] rounded-[30px] border border-[#F1F2F6] p-4 pb-5 transition-all duration-300 hover:border-[#FF4C1C]">
                                    <div
                                        class="flex h-[150px] w-full shrink-0 items-center justify-center overflow-hidden rounded-[30px] bg-[#D9D9D9]">
                                        <div
                                            class="font-bold text-xs leading-[18px] text-white bg-red-700 p-[10px_10px] rounded-full w-fit absolute top-[10px] left-[10px]">
                                            -{{ $product->discount_percentage }}%
                                        </div>
                                        <img src="{{ Storage::url($product->thumbnail) }}" alt="image"
                                            class="h-full w-full object-cover" />
                                    </div>
                                    <div class="space-y-3">
                                        <h3 class="line-clamp-2 min-h-[14px] text-lg font-semibold leading-[27px]">
                                            {{ $product->name }}</h3>
                                        <hr class="border-[#F1F2F6]" />
                                        <p class="text-ngekos-orange text-lg font-semibold">Rp
                                            {{ number_format($product->total, 0, ',', '.') }}  <span
                                                class="text-ngekos-gray text-sm font-normal line-through text-red-500">Rp
                                                {{ number_format($product->price, 0, ',', '.') }}</span></p>
                                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="bg-[#FF4C1C] text-white py-2 px-4 rounded-lg hover:bg-[#ff241c] transition-all duration-300">
                                                Add to Cart
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
    {{-- end diskon --}}



    {{-- Nav --}}
    <div id="BottomNav"
        class="fixed z-50 bottom-0 w-full max-w-[640px] mx-auto border-t border-[#E7E7E7] py-4 px-5 bg-white/70 backdrop-blur">
        <div class="flex items-center justify-evenly ">
            <a href="#" class="nav-items">
                <div class="flex flex-col items-center text-center gap-[7px] text-sm leading-[21px] font-semibold">
                    <img src="assets/images/icons/note-favorite-orange.svg" class="w-6 h-6" alt="icon">
                    <span>Browse</span>
                </div>
            </a>
            <a href="#" class="nav-items">
                <div class="flex flex-col items-center text-center gap-[7px] text-sm leading-[21px]">
                    <img src="assets/images/icons/crown-grey.svg" class="w-6 h-6" alt="icon">
                    <span>Featured</span>
                </div>
            </a>
            <a href="#" class="nav-items">
                <div class="flex flex-col items-center text-center gap-[7px] text-sm leading-[21px]">
                    <img src="assets/images/icons/receipt-item-grey.svg" class="w-6 h-6" alt="icon">
                    <span>Pricing</span>
                </div>
            </a>
            <a href="#" class="nav-items">
                <div class="flex flex-col items-center text-center gap-[7px] text-sm leading-[21px]">
                    <img src="assets/images/icons/setting-2-grey.svg" class="w-6 h-6" alt="icon">
                    <span>Settings</span>
                </div>
            </a>
        </div>
    </div>
@endsection
