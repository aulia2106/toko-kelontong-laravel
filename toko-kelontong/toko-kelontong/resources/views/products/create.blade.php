@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')
    <div>
        <div class="crumb"><a href="{{ route('products.index') }}">Daftar Produk</a> / Baru</div>
        <div class="head">
            <div>
                <h1>Tambah Produk</h1>
                <p>Isi data produk baru dan pilih kategorinya.</p>
            </div>
        </div>
    </div>

    <form class="formcard" action="{{ route('products.store') }}" method="POST">
        @csrf

        @include('products._fields')

        <div class="formacts">
            <button class="btn primary" type="submit">Simpan</button>
            <a class="btn" href="{{ route('products.index') }}">Batal</a>
        </div>
    </form>
@endsection
