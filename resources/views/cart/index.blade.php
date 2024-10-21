@extends('front.layouts.app')
@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col md:flex-row md:justify-between md:items-center">
            <h1 class="text-2xl font-bold my-4">Shopping Cart</h1>

        </div>
        <div class="mt-8">

            @forelse ($cartItems as $item)
                <div class="flex flex-col md:flex-row border-b border-gray-400 py-4">
                    <div class="flex-shrink-0">
                        <img src="{{ Storage::url($item->product->thumbnail) }}" alt="Product image"
                            class="w-32 h-32 object-contain">
                    </div>
                    <div class="mt-4  md:ml-6">
                        <h2 class="text-lg font-bold">{{ $item->product->name }}</h2>
                        {{-- <p class="mt-2 text-gray-600">Product Description</p> --}}
                        <div class="mt-4 flex items-center">
                            <span class="mr-2 text-gray-600">Quantity:</span>
                            <div class="flex items-center">
                                {{-- Reduce quantity form --}}
                                <form
                                    action="{{ $item->quantity > 1 ? route('cart.update', $item->id) : route('cart.remove', $item->id) }}"
                                    method="POST">
                                    @csrf
                                    @if ($item->quantity > 1)
                                        @method('PATCH')
                                        <input type="hidden" name="quantity" value="{{ $item->quantity - 1 }}">
                                        <button class="bg-gray-200 rounded-l-lg px-2 py-1">-</button>
                                    @else
                                        @method('DELETE')
                                        <button class="bg-gray-200 rounded-l-lg px-2 py-1">-</button>
                                    @endif
                                </form>

                                {{-- Display current quantity --}}
                                <span class="mx-2 text-gray-600">{{ $item->quantity }}</span>

                                {{-- Increase quantity form --}}
                                <form action="{{ route('cart.update', $item->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="quantity" value="{{ $item->quantity + 1 }}">
                                    <button class="bg-gray-200 rounded-r-lg px-2 py-1">+</button>
                                </form>
                            </div>

                            @php
                                $total_products = $item->product->total * $item->quantity;
                            @endphp
                            {{-- Product Price --}}
                            <span class="ml-auto font-bold">Rp {{ number_format($total_products, 0, ',', '.') }}</span>
                        </div>
                        <div class="mt-4">
                            <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="bg-red-500 text-white px-4 py-2 rounded">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <p>Tidak ada produk yang ditambahkan</p>
            @endforelse



        </div>
        <div class="flex flex-col items-end mt-8">
            <div class="flex justify-between w-full md:w-auto items-center">
                <span class="text-gray-600 mr-4">Subtotal:</span>
                
                <span class="text-xl font-bold">Rp {{ number_format($totalPrice, 0, ',', '.') }}</span>
            </div>
            <a href="{{route('payment.checkout')}}" class="mt-4 bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">Lanjutkan Pembayaran</a>
        </div>

    </div>
@endsection
