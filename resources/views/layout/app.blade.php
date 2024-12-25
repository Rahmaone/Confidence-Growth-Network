<!DOCTYPE html>
<html>

<head>
    @include('layout.head')
    @yield('page-css') <!-- Untuk CSS khusus halaman -->
</head>

<body>
    @if (!isset($hideLayout) || !$hideLayout)
    <header class="header_section">
        <div class="container-fluid">
            @include('layout.navbar')
        </div>
    </header>
    @endif

    <!-- This is where the page-specific content will go -->
    <main>
        @yield('content')
    </main>

    @if (!isset($hideLayout) || !$hideLayout)
    <footer>
        @include('layout.footer')
    </footer>
    @endif

    @include('layout.script')
    @yield('page-js')
</body>

</html>