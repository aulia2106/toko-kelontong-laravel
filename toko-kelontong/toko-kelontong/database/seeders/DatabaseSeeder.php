<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $kategori = collect([
            'Mi & Makanan Instan',
            'Minuman',
            'Sembako',
            'Bumbu Dapur',
            'Kebersihan',
            'Camilan',
        ])->mapWithKeys(fn ($nama) => [$nama => Category::create(['name' => $nama])]);

        // [kategori, nama produk, harga, stok]
        $produk = [
            ['Mi & Makanan Instan', 'Indomie Goreng 85 g', 3500, 120],
            ['Mi & Makanan Instan', 'Mi Sedaap Soto 75 g', 3300, 8],
            ['Minuman', 'Teh Botol Sosro 450 ml', 5000, 36],
            ['Minuman', 'Kopi Kapal Api Sachet', 1500, 90],
            ['Sembako', 'Beras Pandan Wangi 5 kg', 72000, 14],
            ['Sembako', 'Gula Pasir 1 kg', 17500, 6],
            ['Sembako', 'Minyak Goreng 1 L', 19000, 22],
            ['Sembako', 'Telur Ayam per kg', 29000, 0],
            ['Bumbu Dapur', 'Kecap Manis Bango 220 ml', 12500, 18],
            ['Bumbu Dapur', 'Garam Dapur Halus 250 g', 3000, 40],
            ['Kebersihan', 'Sabun Lifebuoy Batang', 4500, 25],
            ['Kebersihan', 'Deterjen Rinso 800 g', 21000, 9],
            ['Camilan', 'Kerupuk Udang 250 g', 11000, 15],
            ['Camilan', 'Wafer Tango Cokelat', 2500, 4],
        ];

        foreach ($produk as [$namaKategori, $nama, $harga, $stok]) {
            $kategori[$namaKategori]->products()->create([
                'name'  => $nama,
                'price' => $harga,
                'stock' => $stok,
            ]);
        }
    }
}
