{{-- Kolom form yang dipakai bersama oleh create dan edit. Variabel $product hanya ada di halaman edit. --}}
<div class="f @error('name') err @enderror">
    <label for="name">Nama produk</label>
    <input id="name" type="text" name="name" value="{{ old('name', $product->name ?? '') }}" placeholder="Contoh: Gula Pasir 1 kg">
    @error('name')
        <small class="e">{{ $message }}</small>
    @enderror
</div>

<div class="f @error('category_id') err @enderror">
    <label for="category_id">Kategori</label>
    <select id="category_id" name="category_id">
        <option value="">Pilih kategori</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id ?? '') == $category->id)>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
    @error('category_id')
        <small class="e">{{ $message }}</small>
    @enderror
</div>

<div class="two">
    <div class="f @error('price') err @enderror">
        <label for="price">Harga (Rp)</label>
        <input id="price" type="number" name="price" min="0" step="100" value="{{ old('price', $product->price ?? '') }}" placeholder="0">
        @error('price')
            <small class="e">{{ $message }}</small>
        @enderror
    </div>

    <div class="f @error('stock') err @enderror">
        <label for="stock">Stok</label>
        <input id="stock" type="number" name="stock" min="0" step="1" value="{{ old('stock', $product->stock ?? '') }}" placeholder="0">
        @error('stock')
            <small class="e">{{ $message }}</small>
        @enderror
    </div>
</div>
