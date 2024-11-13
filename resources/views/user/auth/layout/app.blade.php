<!DOCTYPE html>
<html>

<head>
    @include('user.auth.layout.head')

    @yield('page-specific-css')
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
    <script src="{{ asset('User-depan/js/script_login.js')}}"></script>
</body>
</html>
