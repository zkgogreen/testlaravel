  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
  {{-- <script src="{{ url('assets/vendor/jquery/jquery.min.js') }}"></script> --}}
  <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
  <script src="{{ url('assets/js/jquery-3.6.0.js') }}"></script>
  <script src="{{ url('assets/vendor/bootstrap-2/js/bootstrap.min.js') }}"></script>
  <script src="{{ url('assets/js/isotope.min.js') }}"></script>
  <script src="{{ url('assets/js/owl-carousel.js') }}"></script>
  {{-- <script src="{{ url('assets/js/wow.js') }}"></script> --}}
  <script src="{{ url('assets/js/tabs.js') }}"></script>
  <script src="{{ url('assets/js/popup.js') }}"></script>
  <script src="{{ url('assets/js/custom.js') }}"></script>
  <script src="{{ url('assets/vendor/leaflet/leaflet/leaflet-src.js') }}"></script>
  <script src="{{ url('assets/vendor/leaflet/leaflet-providers-master/leaflet-providers.js') }}"></script>
  <script src="{{ url('assets/vendor/leaflet/easy-button/easy-button.js') }}"></script>
  <script src="{{ url('assets/vendor/leaflet/Leaflet.defaultextent-master/dist/leaflet.defaultextent.js') }}"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/proj4js/2.6.0/proj4.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/proj4leaflet/1.0.2/proj4leaflet.min.js">
</script>
  <script src="{{ url('assets/vendor/leaflet/leaflet-coord-projection-master/coord-projection.js') }}"></script>
  {{-- <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script> --}}
  <script src="{{ url('assets/js/map-js.js') }}"></script>
  <script src="{{ url('assets/vendor/draggable-dialog-modal/dist/jquery-simple-dialog.js') }}"></script>

  <script>
        // var base_url = window.location.origin + "/project/sigap-fbb/public";
    var base_url = "https://sigap-fbb.kominfo.go.id";
    
    function bannerSwitcher() {
      next = $('.sec-1-input').filter(':checked').next('.sec-1-input');
      if (next.length) next.prop('checked', true);
      else $('.sec-1-input').first().prop('checked', true);
    }

    var bannerTimer = setInterval(bannerSwitcher, 5000);

    $('nav .controls label').click(function() {
      clearInterval(bannerTimer);
      bannerTimer = setInterval(bannerSwitcher, 5000)
    });
  </script>