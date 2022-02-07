@extends('Master.master-dashboard')
@section('page-content')
<!-- Header -->
<div class="header bg-default">
    <div class="container-fluid">
      <div class="header-body">
        <div class="row align-items-center py-4">
          <div class="col-lg-6 col-7">
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
              <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
                <li class="breadcrumb-item active">{{ $breadcrumb }}</li>
              </ol>
            </nav>
          </div>
          <div class="col-lg-6 col-5 text-right">
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Main content -->
  <div class="main-content">
 
    <!-- Page content -->
    <div class="row justify-content-center">
     
      <div class="col-md-12 col-xl-7 col-sm-12 ">
        <div class="form-login" >
          <div class="card bg-white border-0 mb-0">
            
            <div class="card-body">
            <h3 class="text-center mt-2 mb-1">{{ $title }}</h3>
              <div class="btn-wrapper text-center ">
                <div class="text-muted text-center "><small>{{ $subTitle }}</small></div>
              </div>
              @if( Session::get('status') == 'success')
                <div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
              @elseif(Session::get('status')== 'error')
                <div class="alert alert-danger" role="alert">{{Session::get('message')}}</div>
              @endif
              @if(Auth::guard('admin')->check())
                <form method="POST" action="{{ route('admin.update.password') }}">
              @else
                <form method="POST" action="{{ route('dosen.update.password') }}">
              @endif

                @method('patch')
                @csrf
                <div class="form-group row mt-5">
                    <div class="col-md-12 col-sm-12 mb-4">
                        <div class="input-group input-group-merge">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                          </div>
                         
                          <input id="current-password" type="password" placeholder="masukkan password lama" class="form-control" name="current_password">
                          
                        </div>
                        @if ($errors->has('current_password'))
                            <span class="help-block text-red">
                                <strong><small>{{ $errors->first('current_password') }}</small></strong>
                            </span>
                        @endif
                        </span>
                  </div>
                  <div class="col-md-12 col-sm-12 mb-4">
                    <div class="input-group input-group-merge">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                      </div>
                      
                      <input id="password" type="password" placeholder="masukkan password baru" class="form-control" name="password">
                    </div>
                    @if ($errors->has('password'))
                        <span class="help-block text-red">
                            <strong><small>{{ $errors->first('password') }}</small></strong>
                        </span>
                    @endif
                    </span>
                  </div>
                  <div class="col-md-12 col-sm-12">
                    <div class="input-group input-group-merge">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                      </div>
                      <input id="password_confirmation" type="password" placeholder="konfirmasi password baru" class="form-control" name="password_confirmation">
                    </div>
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block text-red">
                            <strong><small>{{ $errors->first('password_confirmation') }}</small></strong>
                        </span>
                    @endif
                    </span>
                  </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary my-4 w-100">
                        {{ __('Simpan') }}
                    </button>
                </div>
              </form>
            </div>
          </div>
          
        </div>
      </div>
    </div>
   
  </div>
@endsection