@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="head">
        <div>
            <h1>Dashboard</h1>
            <p>Ringkasan produk dan stok toko.</p>
        </div>
        <a class="btn primary" href="{{ route('products.create') }}">Tambah Produk</a>
    </div>

    <section class="tiles" aria-label="Ringkasan">
        <div class="tile hi">
            <span class="lbl">Jumlah produk</span>
            <span class="val">{{ number_format($totalProduk, 0, ',', '.') }}</span>
        </div>
        <div class="tile">
            <span class="lbl">Total stok</span>
            <span class="val">{{ number_format($totalStok, 0, ',', '.') }}</span>
        </div>
        <div class="tile">
            <span class="lbl">Kategori</span>
            <span class="val">{{ $jumlahKategori }}</span>
        </div>
        <div class="tile">
            <span class="lbl">Nilai persediaan</span>
            <span class="val">Rp {{ number_format($nilaiStok, 0, ',', '.') }}</span>
        </div>
    </section>

    @php
        $stokTertinggi = max($kategoris->max('products_sum_stock') ?? 0, 1);
    @endphp

    <div class="cols">
        <section class="panel">
            <h2>Stok per kategori</h2>
            <div class="bars">
                @foreach ($kategoris as $kategori)
                    @php $stokKategori = $kategori->products_sum_stock ?? 0; @endphp
                    <div class="bar">
                        <div class="row">
                            <span>{{ $kategori->name }}</span>
                            <span>{{ $kategori->products_count }} produk &middot; {{ number_format($stokKategori, 0, ',', '.') }} stok</span>
                        </div>
                        <div class="track">
                            <div class="fill" style="width: {{ round($stokKategori / $stokTertinggi * 100) }}%"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <section class="panel">
            <h2>Perlu diisi ulang <span class="muted">(stok &le; 10)</span></h2>
            <ul class="low">
                @forelse ($menipis as $product)
                    <li>
                        <a href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a>
                        <span class="meta">
                            <span class="muted">{{ $product->stock }} sisa</span>
                            @include('partials.stok', ['stock' => $product->stock])
                        </span>
                    </li>
                @empty
                    <li class="muted">Semua produk masih aman.</li>
                @endforelse
            </ul>
        </section>
    </div>
@endsection
