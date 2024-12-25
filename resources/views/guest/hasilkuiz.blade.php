@extends('layout.app')

@section('title', 'Hasil Kuiz')

@section('page-css')
<link rel="stylesheet" href="{{ asset('User-depan/css/hasilkuiz.css') }}">
@endsection

@section('content')
<section id="about" class="about_section2 layout_padding">
    <div class="containerhasil">
        <div class="marginkebawah heading_container heading_center">
            <h1 style="text-align: center; margin-bottom: 15px; margin-top: -45px">Selamat!!!</h1>
            <h2 style="text-align: center; margin-bottom: 75px; font-weight: 400;">Anda Mendapatkan <span>Skor</span> Sebanyak</h2>
            <h1><span>{{ $score }}</span> Point</h1>
            <div class="detail-box btn-box" style="margin-top: 75px; margin-bottom: 75px">
                <a href="{{route('home')}}" class="btn1"> Home </a>
            </div>
        </div>
</section>
@endsection

@section('page-js')
<script src="{{ asset('User-depan/js/hasilkuiz.js') }}"></script>
@endsection