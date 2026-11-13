<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /** Daftar produk beserta kategori, dengan pencarian nama. */
    public function index(Request $request)
    {
        $products = Product::with('category')
            ->when($request->q, fn ($query, $q) => $query->where('name', 'like', "%{$q}%"))
            ->when($request->category_id, fn ($query, $id) => $query->where('category_id', $id))
            ->latest()
            ->get();

        $jumlahProduk = $products->count();
        $totalStok    = $products->sum('stock');
        $categories   = Category::orderBy('name')->get();

        return view('products.index', compact('products', 'jumlahProduk', 'totalStok', 'categories'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        Product::create($request->validate($this->rules(), $this->messages()));

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    /** Detail produk berdasarkan ID (404 jika tidak ada). */
    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);

        // hasMany dari sisi kategori: produk lain di kategori yang sama
        $sejenis = $product->category->products()
            ->where('id', '!=', $product->id)
            ->get();

        return view('products.show', compact('product', 'sejenis'));
    }

    public function edit($id)
    {
        $product    = Product::findOrFail($id);
        $categories = Category::orderBy('name')->get();

        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $product->update($request->validate($this->rules(), $this->messages()));

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil dihapus.');
    }

    private function rules(): array
    {
        return [
            'category_id' => 'required|exists:categories,id',
            'name'        => 'required|max:100',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
        ];
    }

    private function messages(): array
    {
        return [
            'category_id.required' => 'Kategori wajib dipilih.',
            'category_id.exists'   => 'Kategori yang dipilih tidak ditemukan.',
            'name.required'        => 'Nama produk wajib diisi.',
            'name.max'             => 'Nama produk maksimal 100 karakter.',
            'price.required'       => 'Harga wajib diisi.',
            'price.numeric'        => 'Harga harus berupa angka.',
            'price.min'            => 'Harga minimal 0.',
            'stock.required'       => 'Stok wajib diisi.',
            'stock.integer'        => 'Stok harus berupa bilangan bulat.',
            'stock.min'            => 'Stok minimal 0.',
        ];
    }
}
