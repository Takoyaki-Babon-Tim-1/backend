<?php

namespace App\Http\Controllers;

use App\Models\AddToCart;
use App\Models\Order;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Notification;
use Midtrans\Snap;

class PaymentController extends Controller
{
    public function checkout(Request $request)
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        $user = auth()->user();
        $cartItems = AddToCart::where('user_id', $user->id)->get();

        $totalPrice = 0;
        foreach ($cartItems as $item) {
            $totalPrice += $item->product->total * $item->quantity;
        }

        // Generate unique order_id
        $order_id = 'ORDER-' . time() . '-' . $user->id;

        $order = Order::create([
            'user_id' => $user->id,
            'total_price' => $totalPrice,
            'order_id' => $order_id,
        ]);

        $params = [
            'transaction_details' => [
                'order_id' => $order_id,  // Use the unique order_id
                'gross_amount' => $totalPrice,
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email' => $user->email,
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        return view('payment.checkout', compact('snapToken', 'totalPrice'));
    }

    public function callback(Request $request)
    {
        $notification = $request->all();

        // Logika untuk memperbarui status pesanan berdasarkan notifikasi
        $order = Order::where('order_id');
        if ($notification['transaction_status'] == 'settlement') {
            $order->status = 'paid';
        } elseif ($notification['transaction_status'] == 'cancel' || $notification['transaction_status'] == 'deny' || $notification['transaction_status'] == 'expire') {
            $order->status = 'failed';
        }
        $order->save();

        return response()->json(['status' => 'success']);
    }
}
