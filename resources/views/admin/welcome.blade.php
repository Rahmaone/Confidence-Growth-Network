@extends('layouts.app')

@section('content')
    <script>
        window.location.href = "{{ url('/home') }}";
    </script>
@endsection