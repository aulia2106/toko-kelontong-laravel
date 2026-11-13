@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')
    <div class="head">
        <div>
            <h1>Daftar Produk</h1>
            <p>Semua produk beserta kategorinya.</p>
        </div>
        <a class="btn primary" href="{{ route('products.create') }}">Tambah Produk</a>
    </div>

    {{-- Pencarian berdasarkan nama (method GET, tidak perlu @csrf) --}}
    <form class="tools" action="{{ route('products.index') }}" method="GET" role="search">
        <div class="field">
            <input type="search" name="q" value="{{ request('q') }}" placeholder="Cari nama produk, misalnya gula" aria-label="Cari nama produk">
        </div>
        <div class="field cat">
            <select name="category_id" aria-label="Kategori">
                <option value="">Semua kategori</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <button class="btn" type="submit">Cari</button>
        @if (request('q') || request('category_id'))
            <a class="btn" href="{{ route('products.index') }}">Reset</a>
        @endif
    </form>

    <p class="summary">
        Menampilkan <b>{{ $jumlahProduk }}</b> produk &middot; total stok <b>{{ number_format($totalStok, 0, ',', '.') }}</b>
    </p>

    <div class="tablewrap">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Produk</th>
                    <th>Kategori</th>
                    <th class="r">Harga</th>
                    <th class="r">Stok</th>
                    <th class="r">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <tr>
                        <td class="muted">{{ $loop->iteration }}</td>
                        <td><a class="nm" href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a></td>
                        <td><span class="tag">{{ $product->category->name }}</span></td>
                        <td class="r">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                        <td class="r">
                            {{ $product->stock }}
                            @include('partials.stok', ['stock' => $product->stock])
                        </td>
                        <td>
                            <div class="acts">
                                <a class="btn sm" href="{{ route('products.show', $product->id) }}">Lihat</a>
                                <a class="btn sm" href="{{ route('products.edit', $product->id) }}">Ubah</a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Hapus produk ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn sm danger" type="submit">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr class="empty"><td colspan="6">Belum ada produk yang cocok.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
