@extends('user.auth.layout.app')

@section('page-specific-css')
    <!-- Page-specific CSS -->
    <link rel="stylesheet" href="{{ asset('User-depan/css/style_login.css')}}">

@endsection

@section('content')
    <div class="container containerlogin" id="container">
        <div class="form-container sign-up-container">
            <form method="POST" action="{{ route('register') }}" class="form-login">
                @csrf
                <h1>Buat Akun</h1>
                <div class="social-container">
                    <a href="#" class="social btn_sosial"><i class="fa fa-google"></i></a>
                </div>
                <span>Gunakan email anda untuk register</span>
                <input type="text" name="name" id="register-name" value="{{ old('name') }}" placeholder="Name"/>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <input type="email" name="email" id="register-email" placeholder="Email"/>
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <input type="password" name="password" id="register-password" placeholder="Password"/>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <button type="submit">Register</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form method="POST" action="{{ route('login') }}" class="form-login">
                @csrf
                <h1>Login</h1>
                <div class="social-container">
                    <a href="#" class="social btn_sosial"><i class="fa fa-google"></i></a>
                </div>
                <span>Masukan akun anda</span>
                <input type="email" name="email" id="login-email" placeholder="Email" />
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <input type="password" name="password" id="login-password" placeholder="Password" />
                @error('password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <a href="#" class="btn_sosial">Forgot your password?</a>
                <button type="submit">Log In</button>
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
