@extends('layouts.app')

@section('title', 'Ubah Produk')

@section('content')
    <div>
        <div class="crumb"><a href="{{ route('products.index') }}">Daftar Produk</a> / {{ $product->name }}</div>
        <div class="head">
            <div>
                <h1>Ubah Produk</h1>
                <p>Perbarui data produk, lalu simpan.</p>
            </div>
        </div>
    </div>

    <form class="formcard" action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')

        @include('products._fields')

        <div class="formacts">
            <button class="btn primary" type="submit">Update</button>
            <a class="btn" href="{{ route('products.index') }}">Batal</a>
        </div>
    </form>
@endsection
