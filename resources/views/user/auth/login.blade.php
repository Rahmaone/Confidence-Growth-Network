@extends('user.auth.layout.app')

@section('page-specific-css')
    <!-- Page-specific CSS -->
    <link rel="stylesheet" href="{{ asset('User-depan/css/style_login.css')}}">

@endsection

@section('content')
    <div class="container containerlogin" id="container">
        <div class="form-container sign-up-container">
            <form action="#" class="form-login">
                <h1>Buat Akun</h1>
                <div class="social-container">
                    <a href="#" class="social btn_sosial"><i class="fa fa-google"></i></a>
                </div>
                <span>Gunakan email anda untuk login</span>
                <input type="text" placeholder="Name" />
                <input type="email" placeholder="Email" />
                <input type="password" placeholder="Password" />
                <button>Sign Up</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form action="#" class="form-login">
                <h1>Login</h1>
                <div class="social-container">
                    <a href="#" class="social btn_sosial"><i class="fa fa-google"></i></a>
                </div>
                <span>masukan akun anda</span>
                <input type="email" placeholder="Email" />
                <input type="password" placeholder="Password" />
                <a href="#" class="btn_sosial">Forgot your password?</a>
                <button>Sign In</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>To keep connected with us please login with your personal info</p>
                    <button class="ghost" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Hello, Friend!</h1>
                    <p>Enter your personal details and start journey with us</p>
                    <button class="ghost" id="signUp">Sign Up</button>
                </div>
            </div>
        </div>
    </div>


@endsection
