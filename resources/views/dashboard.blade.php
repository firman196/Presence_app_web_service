@extends('Master.master-dashboard')
@section('page-content')
    
    <!-- Header -->
    <div class="header bg-default pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Dashboards</a></li>
                </ol>
              </nav>
            </div>
          </div>
          
        </div>
      </div>
    </div>
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col">
          <div class="card p-4">
            <!-- Card header -->
            <div class="card-header border-0 h-80">
              <h3 class="mb-0 text-center"> SELAMAT DATANG DI DASHBOARD PRESENCE APP</h3>
            </div>
            <!-- Light table -->
            <div class="table-responsive p-6">
              Presence app adalah sebuah aplikasi yang digunakan untuk merekap kehadiran mahasiswa di UTDI . Ablikasi ini dibangun sebagai syarat kelulusan Firman Agus Saputro pada program studi informatika di UTDI.
             </div>
            <!-- Card footer -->
          </div>
        </div>
      </div>

@endsection