@extends('layout.app')

@section('content')
<div class="heading_container heading_center layout_padding" style="margin-bottom:-14vh;">
  <h1>Event <span>Kami</span></h1>
</div>

<!-- Event Section Starts -->
<section id="events" class="event_section layout_padding">
  <div class="container">
    <div class="row">
      @if($events->isEmpty())
        <div class="col-12 text-center">
          <h2>Belum ada event yang tersedia</h2>
        </div>
      @else
        @foreach($events as $event)
          <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100">
              <div class="img-box">
                <img
                  src="{{ $event->gambar ? asset('storage/' . $event->gambar) : asset('User-depan/images/default-event.jpg') }}"
                  alt="{{ $event->nama }}"
                  class="card-img-top"
                  style="height: 200px; object-fit: cover;"
                >
              </div>
              <div class="detail-box">
                <h2>{{ $event->nama }}</h2>
                <p><strong>Mentor:</strong> {{ $event->mentor }}</p>
                <p><strong>Lokasi:</strong> {{ $event->lokasi }}</p>
                <p>
                  <strong>Durasi:</strong>
                  {{ \Carbon\Carbon::parse($event->waktu_mulai)->format('d M Y, H:i') }} 
                  - 
                  {{ \Carbon\Carbon::parse($event->waktu_selesai)->format('d M Y, H:i') }}
                </p>
              </div>
            </div>
          </div>
        @endforeach
      @endif
    </div>
  </div>
</section>
<!-- Event Section Ends -->

@endsection