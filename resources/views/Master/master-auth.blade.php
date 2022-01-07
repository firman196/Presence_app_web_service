<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <title>Presence App UTDI</title>
    <!-- Favicon -->
    <link rel="icon" href="{{ url('assets/img/logo/logo.png') }}" type="image/png">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- Icons -->
    <link rel="stylesheet" href="{{ url('assets/vendor/nucleo/css/nucleo.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ url('assets/vendor/@fortawesome/fontawesome-free/css/all.min.css')}}" type="text/css">
    <!-- Page plugins -->
    <!-- CSS -->
    <link rel="stylesheet" href="{{ url('assets/css/app.min.css')}}" type="text/css">


</head>

<body style="background-color: #f8f8fb">

    @include('Master.top-menu')

    @yield('page-content')

    <!-- Footer -->
    <footer class="py-5 bg-default " id="footer-main">
        <div class="container">
        <div class="row align-items-center justify-content-xl-between">
            <div class="col-xl-6">
            <div class="copyright text-center text-xl-left text-white">
                &copy; 2020 <a href="/" class="font-weight-bold ml-1" target="_blank">Presence App</a>
            </div>
            </div>
            <div class="col-xl-6">
            <ul class="nav nav-footer justify-content-center justify-content-xl-end">
               
                <li class="nav-item">
                    <a href="#" class="nav-link" target="_blank">About Us</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" target="_blank">Contact</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" target="_blank">Privacy Policy</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" target="_blank">Desclaimer</a>
                </li>
               
            </ul>
            </div>
        </div>
        </div>
    </footer>

    <script src="{{ url('assets/vendor/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{ url('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ url('assets/vendor/js-cookie/js.cookie.js')}}"></script>
    <script src="{{ url('assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js')}}"></script>
    <script src="{{ url('assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js')}}"></script>
    <!-- Argon JS -->
    <script src="{{ url('assets/js/app.min.js')}}"></script>

    @yield('page-script')

</body>
  
</html>