<!DOCTYPE html>
<html lang="en">
  @include('includes.header')
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="row w-100 m-0">
          <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
            <div class="card col-lg-4 mx-auto">
              <div class="card-body px-5 py-5">
                <h3 class="card-title text-left mb-3">Seja bem vindo!</h3>
                <form method="POST" action="{{route('control.login.login')}}">
                  @csrf
                  <div class="form-group">
                    <label>Login *</label>
                    <input type="text" class="form-control p_input @error('login') is-invalid @enderror" name="login" value="{{old('login')}}">
                    @error('login')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label>Senha *</label>
                    <input type="text" class="form-control p_input @error('senha') is-invalid @enderror" name="senha">
                    @error('senha')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                    @enderror
                  </div>
                  <div class="form-group d-flex align-items-center justify-content-between">
                    <div class="form-check form-check-flat form-check-primary">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="lembrar_me"> Lembrar-me </label>
                    </div>
                    <a href="#" class="forgot-pass">Esqueci a senha!</a>
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-block enter-btn">Login</button>
                  </div>
                  {{-- Facebook e google login api --}}
                  {{-- <div class="d-flex">
                    <button class="btn btn-facebook mr-2 col">
                      <i class="mdi mdi-facebook"></i> Facebook </button>
                    <button class="btn btn-google col">
                      <i class="mdi mdi-google-plus"></i> Google plus </button>
                  </div> --}}
                  {{-- <p class="sign-up">Don't have an Account?<a href="#"> Sign Up</a></p> --}}
                </form>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
        </div>
        <!-- row ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{asset('vendors/js/vendor.bundle.base.js"')}}"></script>
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

    @if (session()->has('alert'))
      <script>
        showAlert("{{session('alert.titulo')}}", "{{session('alert.data')}}", "{{session('alert.tipo')}}")
      </script>
      @php
        session()->forget('alert');
      @endphp
    @endif
  </body>
</html>