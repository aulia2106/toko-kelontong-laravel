<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Toko Kelontong Pak Wowok')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @stack('styles')
</head>
<body>
    <div class="page">
        @include('partials.navbar')

        <main>
            {{-- Pesan sukses dari redirect()->with('success', '...') --}}
            @if (session('success'))
                <div class="alert" role="status">{{ session('success') }}</div>
            @endif

            @yield('content')
        </main>
    </div>

    @stack('scripts')
</body>
</html>
