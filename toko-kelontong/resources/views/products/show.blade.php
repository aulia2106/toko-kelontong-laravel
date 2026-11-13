@extends('layouts.app')

@section('title', $product->name)

@section('content')
    <div>
        <div class="crumb"><a href="{{ route('products.index') }}">Daftar Produk</a> / {{ $product->name }}</div>
        <div class="head">
            <div>
                <h1>{{ $product->name }}</h1>
                <p><span class="tag">{{ $product->category->name }}</span></p>
            </div>
            <div class="acts">
                <a class="btn" href="{{ route('products.edit', $product->id) }}">Ubah</a>
                <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Hapus produk ini?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn danger" type="submit">Hapus</button>
                </form>
            </div>
        </div>
    </div>

    <div class="detail">
        <section class="panel">
            <h2>Detail produk</h2>
            <dl class="dl">
                <dt>ID</dt>
                <dd>{{ $product->id }}</dd>

                <dt>Kategori</dt>
                <dd>{{ $product->category->name }}</dd>

                <dt>Harga</dt>
                <dd><span class="price">Rp {{ number_format($product->price, 0, ',', '.') }}</span></dd>

                <dt>Stok</dt>
                <dd class="stockline">
                    {{ $product->stock }}
                    @include('partials.stok', ['stock' => $product->stock])
                </dd>

                <dt>Nilai stok</dt>
                <dd>Rp {{ number_format($product->price * $product->stock, 0, ',', '.') }}</dd>
            </dl>
        </section>

        <section class="panel">
            <h2>Produk lain di kategori ini</h2>
            <ul class="low">
                @forelse ($sejenis as $item)
                    <li>
                        <a href="{{ route('products.show', $item->id) }}">{{ $item->name }}</a>
                        <span class="meta muted">Rp {{ number_format($item->price, 0, ',', '.') }}</span>
                    </li>
                @empty
                    <li class="muted">Belum ada produk lain di kategori {{ $product->category->name }}.</li>
                @endforelse
            </ul>
        </section>
    </div>
@endsection
