@extends('Master.master-auth')

@section('page-content')
 <!-- Main content -->
 <div class="main-content">
    <!-- Header -->
    <div class="header py-7 py-lg-8 pt-lg-9">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8 px-5">
              <img src="{{ url('assets/img/logo/logo2.png') }}" class="col-md-5">
            </div>
          </div>
        </div>
      </div>
     
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div class="card bg-secondary border-0 mb-0">
            <div class="card-header bg-transparent pb-5">
              <h3 class="text-center mt-2 mb-3">Selamat Datang</h3>
              <div class="btn-wrapper text-center">
                <div class="text-muted text-center "><small>Silakan Login untuk melanjutkan ke dashboard admin</small></div>
              </div>
            </div>
            <div class="card-body px-lg-5 py-lg-5">
              <div class="text-center text-muted mb-4">
                <small>sign in</small>
              </div>
              <form method="POST" action="">
                @csrf
                
                <div class="form-group mb-3">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                    </div>
                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                    @if ($errors->has('username'))
                        <span class="help-block text-red">
                            <strong><small>{{ $errors->first('username') }}</small></strong>
                        </span>
                    @endif
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input id="password" type="password" class="password form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    <div class="eyeShow input-group-append">
                      <span class="input-group-text"> <a href="#" class="hide-password text-default"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                    </div>
                    <div class="eyeHide input-group-append">
                      <span class="input-group-text"> <a href="#" class="show-password text-default"><i class="fa fa-eye-slash" aria-hidden="true"></i></a></span>
                    </div>
                    @if ($errors->has('password'))
                        <span class="help-block text-red">
                            <strong><small>{{ $errors->first('password') }}</small></strong>
                        </span>
                    @endif
                    
                  </div>
                </div>
                
                <div class="custom-control custom-control-alternative custom-checkbox">
                   
                  <input class="custom-control-input" type="checkbox" name="remember"  id="remember" {{ old('remember') ? 'checked' : '' }}>
                  <label class="custom-control-label" for=" customCheckLogin">
                    <span class="text-muted" for="remember">{{ __('Remember Me') }}</span>
                  </label>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary my-4  w-100">
                        {{ __('Login') }}
                    </button>
                </div>
              </form>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-6">
                @if (Route::has('password.request'))
                    <a class="text-light" href="#">
                        <small>{{ __('Forgot Your Password?') }}</small>
                    </a>
                @endif
            </div>
           
          </div>
        </div>
      </div>
    </div>
  </div>


@endsection


@section('page-script')
<script>
  $(document).ready(function(){
      
      $('.eyeShow').hide();
      $('.hide-password').on('click',function(){
        $('.password').attr('type','password');
        $('.eyeShow').hide();
        $('.eyeHide').show();
      })

      $('.show-password').on('click',function(){
        $('.password').attr('type','text');
        $('.eyeShow').show();
        $('.eyeHide').hide();
      })

     
 
    });
</script>
@endsection