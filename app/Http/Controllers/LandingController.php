<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index(Request $request)
    {
        // Mengambil data category
        $categories = Category::all();

        // Mengambil data slider
        $sliders = Slider::all();

        // Inisialisasi query builder untuk produk
        $productsQuery = Product::with('category');

        // Cek apakah ada parameter category pada request
        if ($request->has('category')) {
            $category = $request->input('category');

            // Filter produk berdasarkan kategori yang diberikan
            $productsQuery->whereHas('category', function ($query) use ($category) {
                $query->where('name', $category);
            });
        }

        // Cek apakah ada parameter search pada request
        if ($request->has('search')) {
            $search = $request->input('search');

            // Filter produk berdasarkan pencarian teks
            $productsQuery->where('name', 'like', "%$search%");
        }
        
        // Cek apakah ada parameter min dan max pada request
        if ($request->has('min') && $request->has('max')) {
            $minPrice = $request->input('min');
            $maxPrice = $request->input('max');

            // Filter produk berdasarkan harga minimum dan maksimum
            $productsQuery->whereBetween('price', [$minPrice, $maxPrice]);
        }

        // Ambil data produk yang sudah difilter
        $products = $productsQuery->get();

        return view('landing', compact('products', 'categories', 'sliders'));
    }
}
