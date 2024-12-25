@extends('layout.minimal')

@section('title', 'kuiz')

@section('page-css')
<link rel="stylesheet" href="{{ asset('User-depan/css/kuiz.css') }}">
<link rel="stylesheet" href="{{ asset('User-depan/css/basickuiz.css') }}">
@endsection

@section('content')
<div class="container">
    <div id="loader" class="loader"></div>
    <div id="kuiz" class="justify-center flex-column hidden">
        <div id="hud">
            <div id="hud-item">
                <p id="progressText" class="hud-prefix">Question</p>
                <div id="progressBar">
                    <div id="progressBarFull"></div>
                </div>
            </div>
            <div id="hud-item">
                <p class="hud-prefix">Time Remaining</p>
                <h1 class="hud-main-text" id="timer">30</h1>
            </div>
            <div id="hud-item">
                <p class="hud-prefix">Score</p>
                <h1 class="hud-main-text" id="score">0</h1>
            </div>
        </div>
        <h2 id="question">What is the answer to this questions?</h2>
        <div class="choice-container">
            <p class="choice-prefix">A</p>
            <p class="choice-text" data-number="1">Choice 1</p>
        </div>
        <div class="choice-container">
            <p class="choice-prefix">B</p>
            <p class="choice-text" data-number="2">Choice 2</p>
        </div>
        <div class="choice-container">
            <p class="choice-prefix">C</p>
            <p class="choice-text" data-number="3">Choice 3</p>
        </div>
        <div class="choice-container">
            <p class="choice-prefix">D</p>
            <p class="choice-text" data-number="4">Choice 4</p>
        </div>
    </div>
</div>
@endsection

@section('page-js')
<script src="{{ asset('User-depan/js/kuiz.js') }}"></script>
@endsection