  {{-- <script src="{{ url('assets/vendor/jquery/jquery.js') }}"></script> --}}
  {{-- <script src="{{ url('assets/js/jquery-3.6.0.js') }}" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="crossorigin="anonymous"></script> --}}
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  {{-- <script src="{{ url('assets/vendor/bootstrap/dist/js/bootstrap.js') }}"></script> --}}
  <script src="{{ url('assets/vendor/bootstrap-2/js/bootstrap.min.js') }}"></script>
  {{-- <script src="{{ url('assets/vendor/bootstrap-table-master/dist/bootstrap-table.js') }}"></script> --}}
  <script src="https://code.iconify.design/2/2.0.3/iconify.min.js"></script>
  {{-- <script
      src="{{ url('assets/vendor/bootstrap-table-master/dist/extensions/key-events/bootstrap-table-key-events.min.js') }}">
  </script> --}}
  {{-- <script
      src="{{ url('assets/vendor/bootstrap-table-master/dist/extensions/filter-control/bootstrap-table-filter-control.min.js') }}">
  </script> --}}
  {{-- <script src="{{ url('assets/vendor/bootstrap-table-master/dist/extensions/mobile/bootstrap-table-mobile.js') }}">
  </script> --}}
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
      integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
      crossorigin=""></script>
  {{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDl3QBj0cGAhABQitHo_0XlVag0D2k_liA&libraries=places"></script> --}}
  <script src="{{ url('assets/leaflet/leaflet-ajax-master/dist/leaflet.ajax.js') }}"></script>
  {{-- <script src="{{ url('assets/leaflet/leaflet-google-places-autocomplete-master/src/js/leaflet-gplaces-autocomplete.js') }}"></script> --}}
  <script src="{{ url('assets/leaflet/Leaflet.PolylineMeasure-master/Leaflet.PolylineMeasure.js') }}"></script>
  <script src="{{ url('assets/js/backend/jquery-easing/1.3/jquery.easing.min.js') }}"></script>
  <script src="{{ url('assets/js/backend/lodash.js/2.4.1/lodash.min.js') }}"></script>
  <script src="{{ url('assets/vendor/leaflet/leaflet-providers-master/leaflet-providers.js') }}"></script>
  <script src="{{ url('assets/leaflet/leaflet.groupedlayercontrol.js') }}"></script>
  <script src="{{ url('assets/leaflet/leaflet.fullscreen/Control.FullScreen.js') }}"></script>
  <script src="{{ url('assets/leaflet/defaultextent/dist/leaflet.defaultextent.js') }}"></script>
  {{-- // <script src="{{ url('assets/leaflet/leaflet-search-master/src/leaflet-search.js') }}"></script> --}}
  {{-- <script src="{{ url('assets/leaflet/leaflet-geojson-vt-master/src/leaflet-geojson-vt.js') }}"></script>
  <script src="{{ url('assets/leaflet/leaflet-geojson-vt-master/libs/geojson-vt.js') }}"></script> --}}
  {{-- <script src="{{ url('assets/leaflet/Leaflet.VectorGrid-master/src/bundle.js')}}"></script> --}}
  <script type="text/javascript"  src="https://unpkg.com/leaflet.vectorgrid@1.2.0"></script>
  {{-- <script src="https://unpkg.com/leaflet.vectorgrid@latest/dist/Leaflet.VectorGrid.bundled.js"></script> --}}
  <script src="{{ url('assets/vendor/leaflet/easy-button/easy-button.js') }}"></script>
  {{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/proj4js/2.6.0/proj4.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/proj4leaflet/1.0.2/proj4leaflet.min.js"></script>
  <script src="{{ url('assets/vendor/leaflet/leaflet-coord-projection-master/coord-projection.js') }}"></script> --}}
  {{-- <script src="{{ url('assets/leaflet/crud/js/Leaflet.draw.full-fledged.min.js') }}"></script> --}}
  {{-- <script src="{{ url('assets/leaflet/crud/js/terraformer.min.js') }}"></script>
  <script src="{{ url('assets/leaflet/crud/js/terraformer-wkt-parser.min.js') }}"></script> --}}
  <script src="{{ url('assets/js/backend/create.js') }}"></script>
  <script src="{{ url('assets/js/map-js.js') }}"></script>
  <script src="{{ url('assets/js/backend/shared/off-canvas.js') }}"></script>
  {{-- <script src="{{ url('assets/css/demo_1/dashboard.js') }}"></script> --}}
  {{-- <script src="https://code.iconify.design/2/2.0.4/iconify.min.js"></script> --}}
  {{-- devexpress --}}
  <script type="text/javascript" src="{{ url('assets/vendor/dx/jszip.min.js') }}"></script>
  <script type="text/javascript" src="{{ url('assets/vendor/dx/dx.all.js') }}"></script>
  <script src="{{ url('assets/vendor/dx/polyfill.min.js') }}"></script>
  <script src="{{ url('assets/vendor/dx/exceljs.min.js') }}"></script>
  <script src="{{ url('assets/vendor/dx/FileSaver.min.js') }}"></script>
  <script src="{{ url('assets/vendor/dx/dx.aspnet.data.js') }}"></script>

  {{-- <script src="{{ 'assets/layer/dataspd.js' }}"></script> --}}
  <script>
        var base_url = window.location.origin + "/project/sigap-fbb/public";
      // var base_url = "http://10.0.0.227";
      //   var base_url = "http://103.146.202.47/gis-demand";
    //   var base_url = "https://sigap-fbb.kominfo.go.id";

      $(function() {
          $('[data-toggle="tooltip"]').tooltip()
      })

      $(document).ready(function () {
            $("#masterdata-tab").on('click', function () {
                $("#masterddatatab").addClass("active");
                $("#layerdatatab").removeClass("active");
            });
            $("#layerdata-tab").on('click', function () {
                $("#masterddatatab").removeClass("active");
                $("#layerdatatab").addClass("active");
            });
        });
  </script>
