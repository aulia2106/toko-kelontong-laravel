{{-- Kondisi stok produk. Pemakaian: @include('partials.stok', ['stock' => $product->stock]) --}}
@if ($stock == 0)
    <span class="pill bad">Habis</span>
@elseif ($stock <= 10)
    <span class="pill warn">Menipis</span>
@else
    <span class="pill ok">Tersedia</span>
@endif
