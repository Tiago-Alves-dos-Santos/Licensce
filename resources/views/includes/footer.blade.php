{{-- meu script --}}
@if (session()->has('alert'))
  @php
    $data = htmlspecialchars_decode(session('alert.data'));
  @endphp
  <script>
    showAlert("{{session('alert.titulo')}}", "<?= $data ?>", "{{session('alert.tipo')}}")
  </script>
  @php
    session()->forget('alert');
  @endphp
@endif
<!-- plugins:js -->
<script src="{{ asset('vendors/js/vendor.bundle.base.js') }}"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="{{ asset('js/plugins/off-canvas.js') }}"></script>
<script src="{{ asset('js/plugins/hoverable-collapse.js') }}"></script>
<script src="{{ asset('js/plugins/misc.js') }}"></script>
<script src="{{ asset('js/plugins/settings.js') }}"></script>
<script src="{{ asset('js/plugins/todolist.js') }}"></script>
<!-- endinject -->
<!-- Custom js for this page -->
<!-- End custom js for this page -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
