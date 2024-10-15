<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="container mx-auto my-10">
        <h1 class="text-3xl font-bold mb-5">Your Cart</h1>
    
        <div class="bg-white shadow-lg rounded-lg p-5">
            <table class="w-full text-left">
                <thead>
                    <tr>
                        <th class="pb-4">Product</th>
                        <th class="pb-4">Price</th>
                        <th class="pb-4">Quantity</th>
                        <th class="pb-4">Total</th>
                        <th class="pb-4"></th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Loop through each product in the cart -->
                    {{-- @foreach ($cartItems as $item) --}}
                    <tr class="border-b">
                        <td class="py-4">Burger</td>
                        <td class="py-4"> IDR 10000</td>
                        <td class="py-4">
                            <div class="flex items-center space-x-2">
                                <!-- Button for decreasing the quantity -->
                                <form action="" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="quantity" value="">
                                    {{-- <input type="hidden" name="quantity" value="{{ $item->quantity - 1 }}"> --}}
                                    <button type="submit" class="bg-gray-300 text-gray-700 rounded-lg px-3 py-1 hover:bg-gray-400">
                                        -
                                    </button>
                                </form>
    
                                <span>tes</span>
                                {{-- <span>{{ $item->quantity }}</span> --}}
    
                                <!-- Button for increasing the quantity -->
                                <form action="" method="POST">
                                {{-- <form action="{{ route('cart.update', $item->id) }}" method="POST"> --}}
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="quantity" value="">
                                    {{-- <input type="hidden" name="quantity" value="{{ $item->quantity + 1 }}"> --}}
                                    <button type="submit" class="bg-gray-300 text-gray-700 rounded-lg px-3 py-1 hover:bg-gray-400">
                                        +
                                    </button>
                                </form>
                            </div>
                        </td>
                        <td class="py-4"> IDR 10000</td>
                        <td class="py-4">
                            <!-- Button for removing the item from the cart -->
                            <form action="" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">Remove</button>
                            </form>
                        </td>
                    </tr>
                    {{-- @endforeach --}}
                </tbody>
            </table>
    
            <!-- Display total price -->
            <div class="flex justify-end mt-5">
                <h2 class="text-2xl font-semibold">Total: IDR</h2>
                {{-- <h2 class="text-2xl font-semibold">Total: {{ number_format($totalPrice, 0, ',', '.') }} IDR</h2> --}}
            </div>
    
            <!-- Checkout button -->
            <div class="flex justify-end mt-5">
                <a href="/checkout" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600">
                    Proceed to Checkout
                </a>
            </div>
        </div>
    </div>
    
</body>
</html>