<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .button {
            padding: 0.5rem 1rem;
            background-color: #3490dc;
            color: white;
            border-radius: 0.375rem;
            cursor: pointer;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Your Cart</h2>
        @if (session('cart') && count(session('cart')) > 0)
            <table class="table-auto w-full">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalQuantity = 0;
                        $totalPrice = 0;
                    @endphp
                    @foreach (session('cart') as $id => $item)
                        @php
                            $totalQuantity += $item['quantity'];
                            
                            $totalPrice += $item['total_price'];
                        @endphp
                        <tr>
                            <td>{{ $item['name'] }}</td>
                            <td>
                                <form action="{{ route('cart.update', $id) }}" method="POST" class="inline-block">
                                    @csrf
                                    <button type="submit" name="action" value="decrease" class="button bg-gray-300 text-black">-</button>
                                </form>
                                {{ $item['quantity'] }}
                                <form action="{{ route('cart.update', $id) }}" method="POST" class="inline-block">
                                    @csrf
                                    <button type="submit" name="action" value="increase" class="button">+</button>
                                </form>
                            </td>
                            <td>Rp {{ number_format($item['total_price'], 0, ',', '.') }}</td>
                            <td>
                                <form action="{{ route('cart.remove', $id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="button bg-red-500 text-white">Remove</button>
                                </form>
                            </td>
                            
                        </tr>

                        
                    @endforeach
                </tbody>
                
            </table>

            <div class="mt-4">
                <h3>Total Quantity: {{ $totalQuantity }}</h3>
                <h3>Total Price: Rp {{ number_format($totalPrice, 0, ',', '.') }}</h3>
            </div>

            <div class="mt-4">
                <form action="" method="POST">
                    @csrf
                    <button type="submit" class="button bg-green-500">Checkout</button>
                </form>
            </div>
        @else
            <p>Your cart is empty!</p>
        @endif
    </div>
</body>
</html>
