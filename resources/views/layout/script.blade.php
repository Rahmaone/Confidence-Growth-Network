<!-- jQery -->
<script type="text/javascript" src="{{ asset('User-depan/js/jquery-3.4.1.min.js')}}"></script>
<!-- popper js -->
<script
  src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
  integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
  crossorigin="anonymous"
></script>
<!-- bootstrap js -->
<script type="text/javascript" src="{{ asset('User-depan/js/bootstrap.js') }}"></script>
<!-- owl slider -->
<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
></script>
<!-- custom js -->
<script type="text/javascript" src="{{ asset('User-depan/js/custom.js')}}"></script>
<!-- Google Map -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap"></script>
<!-- End Google Map -->
{{-- Page Specific Script --}}
@yield('page-specific-scripts')
