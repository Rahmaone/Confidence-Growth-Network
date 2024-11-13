<!DOCTYPE html>
<html>

<head>
    @include('layout.head')
</head>

<body>
    <header class="header_section">
        <div class="container-fluid">
        @include('layout.navbar')
        </div>
    </header>


    <!-- This is where the page-specific content will go -->
    <main>
        @yield('content')
    </main>

    <footer>
        @include('layout.footer')
    </footer>

    @include('layout.script')
</body>
</html>
