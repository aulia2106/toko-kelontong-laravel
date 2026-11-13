<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProduk = Product::count();
        $totalStok   = Product::sum('stock');
        $nilaiStok   = Product::sum(DB::raw('price * stock'));
        $jumlahKategori = Category::count();

        // hasMany: jumlah produk dan total stok per kategori
        $kategoris = Category::withCount('products')
            ->withSum('products', 'stock')
            ->orderBy('name')
            ->get();

        // belongsTo: produk beserta kategorinya
        $menipis = Product::with('category')
            ->where('stock', '<=', 10)
            ->orderBy('stock')
            ->get();

        return view('dashboard', compact(
            'totalProduk',
            'totalStok',
            'nilaiStok',
            'jumlahKategori',
            'kategoris',
            'menipis'
        ));
    }
}
