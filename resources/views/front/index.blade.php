<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="font-poppins text-[rgb(3,3,3)] bg-[#F6F5FA] pb-[100px] px-4 sm:px-0">

    <!-- Navbar Section -->
    <nav class="flex items-center justify-between p-5 bg-white shadow-md">
        <div class="logo">
            <!-- Your Logo -->
            <a href="/" class="text-lg font-bold">E-commerce</a>
        </div>
        <div class="flex items-center gap-4">
            @guest
                <a href="/login">Login</a>
            @endguest
            @auth
                <p class="font-semibold">Hi, {{ Auth::user()->name }}</p>
                <!-- Tombol Cart -->
                <a href="{{ route('cart.index') }}"
                    class="relative bg-[#F1A635] text-white py-2 px-4 rounded-lg hover:bg-[#b27a28] transition-all duration-300">
                    Cart
                    <span
                        class="absolute top-0 right-0 translate-x-2 -translate-y-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm">
                        {{ $cartItemCount }}
                    </span>
                </a>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="relative bg-[#6635F1] text-white py-2 px-4 rounded-lg hover:bg-[#4c28b2] transition-all duration-300">
                        Logout
                    </button>
                </form>
            @endauth

        </div>
    </nav>

    <!-- Produk yang Tersedia (Available) -->
    <section id="available-products" class="container max-w-[1130px] mx-auto flex flex-col gap-4 mt-[50px]">
        <h2 class="font-bold text-xl">Menu</h2>
        <div class="grid grid-cols-1 sm:grid-cols-4 gap-5">
            @forelse ($products->where('is_available', true) as $product)
                <a href="details.html" class="card">
                    <div
                        class="p-5 rounded-[20px] bg-white flex flex-col gap-5 hover:ring-2 hover:ring-[#6635F1] transition-all duration-300">
                        <div class="w-full h-[140px] rounded-[20px] overflow-hidden relative">
                            @if ($product->discount)
                                @php
                                    $persentase = round(($product->discount / $product->price) * 100);
                                @endphp
                                <div
                                    class="font-bold text-xs leading-[18px] text-white bg-red-700 p-[5px_10px] rounded-full w-fit absolute top-[10px] left-[10px]">
                                    -{{ $persentase }}%
                                </div>
                            @endif

                            <img src="{{ Storage::url($product->thumbnail) }}" class="w-full h-full object-cover"
                                alt="thumbnail">
                        </div>
                        <div class="flex flex-col gap-[10px]">
                            <p class="title font-semibold text-lg min-h-[56px] line-clamp-2 hover:line-clamp-none">
                                {{ $product->name }}</p>

                            @if ($product->discount)
                                <div class="flex items-center gap-[6px]">
                                    <p class="font-semibold text-l">Harga: Rp
                                        {{ number_format($product->total, 0, ',', '.') }} </p>
                                    <p class="font-semibold text-sm line-through text-red-500">Rp
                                        {{ number_format($product->price, 0, ',', '.') }}</p>
                                </div>
                            @else
                                <p class="font-semibold text-l">Harga: Rp
                                    {{ number_format($product->total, 0, ',', '.') }}</p>
                            @endif
                        </div>

                        <!-- Tombol Add to Cart -->
                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="bg-[#6635F1] text-white py-2 px-4 rounded-lg hover:bg-[#4c28b2] transition-all duration-300">
                                Add to Cart
                            </button>
                        </form>

                    </div>
                </a>
            @empty
                <p>No products available.</p>
            @endforelse
        </div>
    </section>

    <!-- Produk yang Tidak Tersedia (Unavailable) -->
    <section id="unavailable-products" class="container max-w-[1130px] mx-auto flex flex-col gap-4 mt-[50px]">
        <div class="grid grid-cols-1 sm:grid-cols-4 gap-5">
            @forelse ($products->where('is_available', false) as $product)
                <div class="card">
                    <div
                        class="p-5 rounded-[20px] bg-white flex flex-col gap-5 transition-all duration-300 relative cursor-not-allowed">
                        <div class="w-full h-[140px] rounded-[20px] overflow-hidden relative">
                            <img src="{{ Storage::url($product->thumbnail) }}" class="w-full h-full object-cover"
                                alt="thumbnail">

                            <div
                                class="font-bold text-xs leading-[18px] text-white bg-gray-700 p-[5px_10px] rounded-full w-fit absolute top-[10px] left-[10px]">
                                Tidak Tersedia
                            </div>
                        </div>
                        <div class="flex flex-col gap-[10px]">
                            <p class="title font-semibold text-lg min-h-[56px] line-clamp-2">{{ $product->name }}</p>

                            @if ($product->discount)
                                @php
                                    $finalPrice = $product->price - $product->discount;
                                @endphp
                                <div class="flex items-center gap-[6px]">
                                    <p class="font-semibold text-l">Harga: Rp
                                        {{ number_format($finalPrice, 0, ',', '.') }} </p>
                                    <p class="font-semibold text-sm line-through text-red-500">Rp
                                        {{ number_format($product->price, 0, ',', '.') }}</p>
                                </div>
                            @else
                                <p class="font-semibold text-l">Harga: Rp
                                    {{ number_format($product->price, 0, ',', '.') }}</p>
                            @endif
                        </div>

                        <!-- Tombol Disabled -->
                        <button type="button" disabled
                            class="bg-gray-400 text-white py-2 px-4 rounded-lg cursor-not-allowed">
                            Add to Cart (Unavailable)
                        </button>
                    </div>
                </div>
            @empty
            @endforelse
        </div>
    </section>



    @php
        $discountedProducts = $products->filter(function ($product) {
            return $product->discount > 0;
        });
    @endphp

    @if ($discountedProducts->isNotEmpty())
        <section id="featured" class="container max-w-[1130px] mx-auto flex flex-col gap-4 mt-[50px]">
            <h2 class="font-bold text-xl">Menu Diskon</h2>
            <div class="grid grid-cols-1 sm:grid-cols-4 gap-5">
                @foreach ($discountedProducts as $product)
                    <a href="details.html" class="card">
                        <div
                            class="p-5 rounded-[20px] bg-white flex flex-col gap-5 hover:ring-2 hover:ring-[#6635F1] transition-all duration-300">
                            <div class="w-full h-[140px] rounded-[20px] overflow-hidden relative">

                                @php
                                    $persentase = round(($product->discount / $product->price) * 100);
                                @endphp
                                <div
                                    class="font-bold text-xs leading-[18px] text-white bg-red-700 p-[5px_10px] rounded-full w-fit absolute top-[10px] left-[10px]">
                                    -{{ $persentase }}%
                                </div>

                                <img src="{{ Storage::url($product->thumbnail) }}" class="w-full h-full object-cover"
                                    alt="thumbnail">
                            </div>
                            <div class="flex flex-col gap-[10px]">
                                <p class="title font-semibold text-lg min-h-[56px] line-clamp-2 hover:line-clamp-none">
                                    {{ $product->name }}</p>

                                @php
                                    $finalPrice = $product->price - $product->discount;
                                @endphp
                                <div class="flex items-center gap-[6px]">
                                    <p class="font-semibold text-l">Harga: Rp
                                        {{ number_format($finalPrice, 0, ',', '.') }} </p>
                                    <p class="font-semibold text-sm line-through text-red-500">Rp
                                        {{ number_format($product->price, 0, ',', '.') }}</p>
                                </div>
                            </div>
                            <!-- Tombol Add to Cart -->
                            <form action="" method="POST">
                                @csrf
                                <button type="submit"
                                    class="bg-[#6635F1] text-white py-2 px-4 rounded-lg hover:bg-[#4c28b2] transition-all duration-300">
                                    Add to Cart
                                </button>
                            </form>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    @endif



</body>

</html>
