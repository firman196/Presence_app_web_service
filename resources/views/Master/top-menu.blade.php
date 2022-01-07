<!-- Navbar -->
<nav id="navbar-main" class="navbar navbar-horizontal navbar-expand-lg navbar-light text-bluedark sticky-top bg-white">
  <div class="container">
    <a class="navbar-brand" href="/">
      <img src="{{ url('assets/img/logo/logo.png') }}" class="mr-2"> Presence App
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse  navbar-custom-collapse collapse" id="navbar-collapse">
      <div class="navbar-collapse-header">
        <div class="row">
          <div class="col-6 collapse-brand">
            <a href="/">
              <img src="{{ url('assets/img/logo/logo.png') }}">
            </a>
          </div>
          <div class="col-6 collapse-close">
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
              <span></span>
              <span></span>
            </button>
          </div>
        </div>
      </div>
      <ul class="navbar-nav mr-auto">
        
      </ul>
      <hr class="d-lg-none" />
      <ul class="navbar-nav align-items-lg-center ml-lg-auto">
        <li class="nav-item">
          <a href="/" class="nav-link">
            <span class="nav-link-inner--text">Home</span>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('login') }}" class="nav-link">
            <span class="nav-link-inner--text">Login</span>
          </a>
        </li>
     
      </ul>
    </div>
  </div>
</nav>