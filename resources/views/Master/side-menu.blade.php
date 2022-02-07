  <!-- Sidenav -->
  <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header  d-flex  align-items-center">
        <a class="navbar-brand" href="javascript:void(0)">
          <img src="{{ url('assets/img/logo/logo3.png') }}" class="navbar-brand-img" alt="...">
        </a>
        <div class=" ml-auto ">
          <!-- Sidenav toggler -->
          <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
            <div class="sidenav-toggler-inner">
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
            </div>
          </div>
        </div>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          @if(Auth::guard('admin')->check())
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/') }}">
                <i class="ni ni-chart-pie-35 text-red"></i>
                <span class="nav-link-text">Dashboard</span>
              </a>
            </li>
          
            <li class="nav-item">
              <a class="nav-link {{ Route::is('mahasiswa.index') || Route::is('dosens.index') ? 'active' : '' }}" href="#navbar-dashboards" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-dashboards">
                <i class="ni ni-archive-2 text-red"></i>
                <span class="nav-link-text">Master Data</span>
              </a>
              <div class="collapse show" id="navbar-dashboards">
                <ul class="nav nav-sm flex-column">
                  <li class="nav-item">
                    <a href="{{ route('prodi.index') }}" class="nav-link">
                      <span class="sidenav-mini-icon"> P </span>
                      <span class="sidenav-normal"> Prodi </span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('hari.index') }}" class="nav-link">
                      <span class="sidenav-mini-icon"> H </span>
                      <span class="sidenav-normal"> Hari </span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('kelas.index') }}" class="nav-link">
                      <span class="sidenav-mini-icon"> K </span>
                      <span class="sidenav-normal"> Kelas </span>
                    </a>
                  </li>
                 
                  <li class="nav-item">
                    <a href="{{ route('ruangan.index') }}" class="nav-link">
                      <span class="sidenav-mini-icon"> R </span>
                      <span class="sidenav-normal"> Ruangan </span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('matakuliah.index') }}" class="nav-link">
                      <span class="sidenav-mini-icon"> M </span>
                      <span class="sidenav-normal"> Matakuliah </span>
                    </a>
                  </li>
                 <!--
                  <li class="nav-item">
                    <a href="{{ route('jenis-izin.index') }}" class="nav-link">
                      <span class="sidenav-mini-icon"> J </span>
                      <span class="sidenav-normal"> Jenis Izin </span>
                    </a>
                  </li>-->
                  <li class="nav-item">
                    <a href="{{ route('krs.index') }}" class="nav-link">
                      <span class="sidenav-mini-icon"> K </span>
                      <span class="sidenav-normal"> KRS </span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
          </ul>

          <ul class="navbar-nav mb-md-3">
            <li class="nav-item">
              <a href="{{ route('dosens.index') }}" class="nav-link {{ Route::is('dosens.index') ? 'active' : '' }}">
                <i class="ni ni-circle-08 text-red"></i>
                <span class="sidenav-normal"> Dosen </span>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('mahasiswa.index') }}" class="nav-link  {{ Route::is('mahasiswa.index') ? 'active' : '' }}">
                <i class="ni ni-hat-3 text-red"></i>
                <span class="sidenav-normal"> Mahasiswa </span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ Route::is('beacon.index') ? 'active' : '' }}" href="{{ route('beacon.index') }}">
                <i class="ni ni-button-power text-red"></i>
                <span class="nav-link-text">Data Beacon</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ Route::is('admin.index') ? 'active' : '' }}" href="{{ route('admin.index') }}">
                <i class="ni ni-single-02 text-red"></i>
                <span class="nav-link-text">Data Admin</span>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('jadwal.index') }}" class="nav-link  {{ Route::is('jadwal.index') ? 'active' : '' }}">
                <i class="ni ni-calendar-grid-58 text-red"></i>
                <span class="sidenav-normal"> Jadwal </span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ Route::is('presensi.index') ? 'active' : '' }}" href="{{ route('presensi.index') }}">
                <i class="ni ni-badge text-red"></i>
                <span class="nav-link-text">Data Presensi</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ Route::is('beritaacara.index') ? 'active' : '' }}" href="{{ route('beritaacara.index') }}">
                <i class="ni ni-book-bookmark text-red"></i>
                <span class="nav-link-text">Berita Acara</span>
              </a>
            </li>
          </ul>
          @elseif(Auth::guard('dosen')->check())
          <hr class="my-3">
          <!-- Heading -->
          <h6 class="navbar-heading p-0 text-muted">
            <span class="docs-normal">Dosen</span>
            <span class="docs-mini">D</span>
          </h6>
          <ul class="navbar-nav mb-md-3">
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/dosen') }}">
                <i class="ni ni-chart-pie-35 text-red"></i>
                <span class="nav-link-text">Dashboard</span>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('dosen.jadwal.index') }}" class="nav-link {{ Route::is('dosen.jadwal.index') ? 'active' : '' }}">
               <i class="ni ni-calendar-grid-58 text-red"></i>
                <span class="sidenav-normal"> Jadwal Saya </span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ Route::is('dosen.presensi.index') ? 'active' : '' }}" href="{{ route('dosen.presensi.index') }}">
                <i class="ni ni-badge text-red"></i>
                <span class="nav-link-text">Data Presensi</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ Route::is('dosen.beritaacara.index') ? 'active' : '' }}" href="{{ route('dosen.beritaacara.index') }}">
                <i class="ni ni-book-bookmark text-red"></i>
                <span class="nav-link-text">Berita Acara</span>
              </a>
            </li>
          </ul>
         @endif
        </div>
      </div>
    </div>
  </nav>
  <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- Topnav -->
    <nav class="navbar navbar-top navbar-expand navbar-dark bg-default border-bottom">
      <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
         
          <!-- Navbar links -->
          <ul class="navbar-nav align-items-center  ml-md-auto ">
            <li class="nav-item d-xl-none">
              <!-- Sidenav toggler -->
              <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </div>
            </li>
            <li class="nav-item d-sm-none">
              <a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
                <i class="ni ni-zoom-split-in"></i>
              </a>
            </li>
          </ul>
          <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
            <li class="nav-item dropdown">
              <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="media align-items-center">
                  <span class="avatar avatar-sm rounded-circle">
                    @if(Auth::guard('admin')->check())
                      <img alt="Image placeholder" src="{{ config('services.image.baseUrl').config('services.image.path').'/'.Auth::guard('admin')->user()->foto }}">
                    @elseif(Auth::guard('dosen')->check())
                      <img alt="Image placeholder" src="{{ config('services.image.baseUrl').config('services.image.path').'/'.Auth::guard('dosen')->user()->foto }}">
                    @endif
                  </span>
                  <div class="media-body  ml-2  d-none d-lg-block">
                    @if(Auth::guard('admin')->check())
                      <span class="mb-0 text-sm  font-weight-bold">{{ Auth::guard('admin')->user()->nama }}</span>
                    @elseif(Auth::guard('dosen')->check())
                      <span class="mb-0 text-sm  font-weight-bold">{{ Auth::guard('dosen')->user()->nama }}</span>
                    @endif
                    
                  </div>
                </div>
              </a>
              <div class="dropdown-menu  dropdown-menu-right ">
                <div class="dropdown-header noti-title">
                  <h6 class="text-overflow m-0">Good Bye!</h6>
                </div>
              
                <div class="dropdown-divider"></div>
                @if(Auth::guard('admin')->check())
                  <a href="{{ route('admin.index.password') }}" class="dropdown-item">
                    <i class="ni ni-key-25"></i>
                    <span>Reset Password</span>
                  </a>
                @elseif(Auth::guard('dosen')->check())
                  <a href="{{ route('dosen.index.password') }}" class="dropdown-item">
                    <i class="ni ni-key-25"></i>
                    <span>Reset Password</span>
                  </a>
                @endif
                
                <form action="{{ route('logout') }}" method="POST">
                  @csrf
                  <button type="submit" class="dropdown-item">
                    <i class="ni ni-user-run"></i>
                    <span>Logout</span>
                  </button>
                </form>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>
      <!-- Header -->