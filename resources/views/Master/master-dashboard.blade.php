<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Firman ">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Presence App</title>
    <!-- Favicon -->
    <link rel="icon" href="{{ url('assets/img/brand/favicon.png')}}" type="image/png">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- Icons -->
    <link rel="stylesheet" href="{{ url('assets/vendor/nucleo/css/nucleo.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ url('assets/vendor/@fortawesome/fontawesome-free/css/all.min.css')}}" type="text/css">
    <!-- Page plugins -->
     <!-- datatables plugins -->
    <link rel="stylesheet" href="{{ url('assets/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
   <!-- <link rel="stylesheet" href="{{ url('assets/vendor/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{ url('assets/vendor/datatables.net-select-bs4/css/select.bootstrap4.min.css')}}">
   -->
   
    <!-- toastr -->
    <link rel="stylesheet" href="{{ url('assets/vendor/toastr/toastr.min.css')}}">

    <!-- sweet alert -->
    <link rel="stylesheet" href="{{ url('assets/vendor/sweetalert/sweetalert2.min.css')}}">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ url('assets/css/app.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ url('assets/css/style.css')}}" type="text/css">

    <!-- select2 js -->
    <link rel="stylesheet" href="{{ url('assets/vendor/select2/css/select2.min.css')}}">
</head>

<body>

    @include('Master.side-menu')

    @yield('page-content')

           <!-- Footer -->
      <footer class="footer pt-0">
        <div class="row align-items-center justify-content-lg-between">
          <div class="col-lg-6">
            <div class="copyright text-center  text-lg-left  text-muted">
              &copy; 2021 <a href="http://skripsi.kodekreasi.com/" class="font-weight-bold ml-1" target="_blank">Presence App</a>
            </div>
          </div>
         
        </div>
      </footer>
    </div>
  </div>



  <script src="{{ url('assets/vendor/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{ url('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{ url('assets/vendor/js-cookie/js.cookie.js')}}"></script>
  <script src="{{ url('assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js')}}"></script> 
  <script src="{{ url('assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js')}}"></script>
  <!-- Optional JS -->
  <script src="{{ url('assets/vendor/chart.js/dist/Chart.min.js')}}"></script>
  <script src="{{ url('assets/vendor/chart.js/dist/Chart.extension.js')}}"></script>
  
  <script src="{{ url('assets/vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ url('assets/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
 <!-- 
  <script src="{{ url('assets/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ url('assets/vendor/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
  <script src="{{ url('assets/vendor/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
  <script src="{{ url('assets/vendor/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
  <script src="{{ url('assets/vendor/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
  <script src="{{ url('assets/vendor/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
  <script src="{{ url('assets/vendor/datatables.net-select/js/dataTables.select.min.js') }}"></script>-->
  
  <!-- toastr -->
  <script src="{{ url('assets/vendor/toastr/toastr.min.js') }}"></script>

  <!-- tinymce editor -->
  <script src="{{ url('assets/vendor/tinymce/tinymce.js') }}"></script>

  <!-- Sweetalert -->
  <script src="{{ url('assets/vendor/sweetalert/sweetalert2.min.js') }}"></script>

  <!-- JS -->
  <script src="{{ url('assets/js/app.min.js')}}"></script>
  <script src="{{ url('assets/js/wizard.js')}}"></script>
  <!-- select2 js -->
  <script src="{{ url('assets/vendor/select2/js/select2.min.js')}}"></script>
  <script src="{{ url('assets/js/select2.js')}}"></script>

@yield('page-script')

</body>

</html>