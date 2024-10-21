<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    // Menampilkan semua review untuk produk tertentu (sudah ada)
    public function index($productId)
    {
        $product = Product::with('reviews.user')->findOrFail($productId);
        return view('product.show', compact('product'));
    }

    // Menambahkan review baru
    public function store(Request $request, $productId)
    {
        // Validasi input review
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string|max:500',
        ]);

        // Buat review baru
        Review::create([
            'user_id' => Auth::id(),
            'product_id' => $productId,
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        // Redirect ke halaman detail produk setelah review berhasil ditambahkan
        return redirect()->route('front.detail', Product::findOrFail($productId)->slug)
            ->with('success', 'Review berhasil ditambahkan');
    }

    // Mengupdate review (opsional, jika diperlukan)
    public function update(Request $request, $id)
    {
        $review = Review::findOrFail($id);

        // Hanya pengguna yang membuat review dapat mengupdate
        if ($review->user_id !== Auth::id()) {
            return response()->json(['error' => 'Tidak diizinkan'], 403);
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string|max:500',
        ]);

        $review->update([
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        return redirect()->back()->with('success', 'Review berhasil diupdate');
    }

    // Menghapus review (opsional)
    public function destroy($id)
    {
        $review = Review::findOrFail($id);

        // Hanya pengguna yang membuat review dapat menghapus
        if ($review->user_id !== Auth::id()) {
            return response()->json(['error' => 'Tidak diizinkan'], 403);
        }

        $review->delete();

        return redirect()->back()->with('success', 'Review berhasil dihapus');
    }

    
}
