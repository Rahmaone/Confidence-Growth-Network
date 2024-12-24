<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title')</title>
    @yield('page-css') <!-- Hanya memuat CSS khusus halaman -->
</head>

<body>
    <main>
        @yield('content') <!-- Konten halaman -->
    </main>
    @yield('page-js') <!-- Hanya memuat JavaScript khusus halaman -->
</body>

</html>