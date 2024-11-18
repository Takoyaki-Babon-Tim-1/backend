<?php

namespace App\Http\Controllers;

use App\Mail\AdminPaymentNotification;
use App\Models\AddToCart;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Midtrans\Config;
use Midtrans\Notification;
use Midtrans\Snap;

class PaymentController extends Controller
{
    public function checkout(Request $request)
    {
        // Konfigurasi Midtrans
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
    
        $order_id = 'ORDER-' . time() . '-' . $user->id;
    
        $order = Order::create([
            'user_id' => $user->id,
            'total_price' => $totalPrice,
            'order_id' => $order_id,
        ]);
    
        foreach ($cartItems as $item) {
            $order->products()->attach($item->product_id, ['quantity' => $item->quantity]);
        }
    
        $params = [
            'transaction_details' => [
                'order_id' => $order_id,
                'gross_amount' => $totalPrice,
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email' => $user->email,
            ],
        ];
    
        try {
            $snapToken = Snap::getSnapToken($params);
            Mail::to('sahalntesting@gmail.com')->send(new AdminPaymentNotification($order, $user));
    
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Payment error. Please try again.']);
        }
    
        return view('payment.checkout', compact('snapToken', 'totalPrice'));
    }


    public function callback(Request $request)
    {
        $notification = $request->all();

        // Find the order based on the order_id from the notification
        $order = Order::where('order_id', $notification['order_id'])->first();

        // Check if the order was found
        if ($order) {
            // Update the status based on the transaction_status
            if ($notification['transaction_status'] == 'settlement') {
                $order->status = 'success';
                // AddToCart::where('user_id', $order->user_id)->delete();
            } elseif (in_array($notification['transaction_status'], ['cancel', 'deny', 'expire'])) {
                $order->status = 'failed';
            }

            // Save the updated order status
            $order->save();

            return response()->json(['status' => 'success']);
        }

        // Return a failed response if the order was not found
        return response()->json(['status' => 'order not found'], 404);
    }
}


// private function sendWhatsAppNotification($phone, $message)
// {
//     $curl = curl_init();

//     curl_setopt_array($curl, [
//         CURLOPT_URL => 'https://api.fonnte.com/send',
//         CURLOPT_RETURNTRANSFER => true,
//         CURLOPT_ENCODING => '',
//         CURLOPT_MAXREDIRS => 10,
//         CURLOPT_TIMEOUT => 0,
//         CURLOPT_FOLLOWLOCATION => true,
//         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//         CURLOPT_CUSTOMREQUEST => 'POST',
//         CURLOPT_POSTFIELDS => [
//             'target' => $phone,
//             'message' => $message,
//             'countryCode' => '62',
//         ],
//         CURLOPT_HTTPHEADER => [
//             'Authorization: ' . config('services.fonnte.token')
//         ],
//     ]);

//     $response = curl_exec($curl);

//     if (curl_errno($curl)) {
//         $error_msg = curl_error($curl);
//     }
//     curl_close($curl);

//     return $response;
// }