<header class="top">
    <a class="brand" href="{{ route('dashboard') }}">
        <span class="mark" aria-hidden="true">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 9l1.5-5h15L21 9"/>
                <path d="M3 9a3 3 0 0 0 6 0 3 3 0 0 0 6 0 3 3 0 0 0 6 0"/>
                <path d="M5 12v8h14v-8"/>
                <path d="M10 20v-4h4v4"/>
            </svg>
        </span>
        <span class="t"><b>Toko Kelontong Pak Wowok</b><span>Manajemen Produk</span></span>
    </a>

    <nav aria-label="Menu utama">
        <a href="{{ route('dashboard') }}" @if (request()->routeIs('dashboard')) aria-current="page" @endif>Dashboard</a>
        <a href="{{ route('products.index') }}" @if (request()->routeIs('products.index', 'products.show', 'products.edit')) aria-current="page" @endif>Daftar Produk</a>
        <a href="{{ route('products.create') }}" @if (request()->routeIs('products.create')) aria-current="page" @endif>Tambah Produk</a>
    </nav>
</header>
