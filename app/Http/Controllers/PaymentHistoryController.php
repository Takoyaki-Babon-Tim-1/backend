<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentHistoryController extends Controller
{
    /**
     * Tampilkan halaman riwayat pembayaran.
     */
    public function index()
    {
    
        return view('payment.history'); // Mengarahkan ke file view di resources/views/payment/history.blade.php
    }
}