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
                            class="flex items-center justify-center w-10 h-10 rounded-full bg-white  transition-all duration-300 hover:shadow-[0_10px_20px_0_#EBF40080]">
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


    <section id="NonDiskon " class="mt-[30px]">
        <div class="flex items-center justify-between px-5 my-4">
            <h2 class="font-semibold">Kategori Takoyaki</h2>
        </div>
        <div class=" w-full mt-3 pb-[100px] px-5 my-4">
            <div>
                <div>
                    <a href="" class="card ">
                        <div
                            class="flex flex-row justify-between w-full gap-2 pb-5 transition-all duration-300 border-b-2 rounded-xl ">
                            <div class="w-6/12">
                                <h3 class="min-h-[14px] text-lg font-semibold leading-[27px] truncate">
                                    Takoyaki Babon
                                </h3>
                                <p class="mt-auto mb-8 text-lg font-semibold">
                                    Rp 17.000
                                </p>
                            </div>
                            <div class="flex flex-col items-end justify-end w-auto">
                                <div class="w-full max-w-[150px]  max-h-[150px] ">
                                    <img src="/assets/images/thumbnails/thumbnail-1.png" alt="image"
                                        class="object-contain w-full max-w-[150px] h-auto max-h-[150px] rounded-xl" />
                                </div>
                                <div class="flex justify-center w-full -mt-8">
                                    <form action="" method="POST">
                                        {{-- @csrf --}}
                                        <button type="submit"
                                            class="bg-[#EBF400] text-black text-base font-semibold w-full max-w-[180px] py-1 px-4 rounded-full hover:bg-[#d86e47] transition-all duration-300">
                                            Tambah
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                </div>
                </a>
            </div>
        </div>
        </div>
    </section>
