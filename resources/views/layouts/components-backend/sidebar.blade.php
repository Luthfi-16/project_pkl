<aside class="left-sidebar with-vertical">
  <div><!-- ---------------------------------- -->
    <!-- Start Vertical Layout Sidebar -->
    <!-- ---------------------------------- -->
    <div class="brand-logo d-flex align-items-center justify-content-between">
      <a href="{{ url('admin')}}" class="text-nowrap logo-img">
        <h2 style="color: rgb(0, 0, 0)"><b>KD<span style="color: rgb(5, 146, 227)">M</span></b></h2>
      </a>
      <a href="javascript:void(0)" class="sidebartoggler ms-auto text-decoration-none fs-5 d-block d-xl-none">
        <i class="ti ti-x"></i>
      </a>
    </div>

    <nav class="sidebar-nav scroll-sidebar" data-simplebar>
      <ul id="sidebarnav">
        <!-- ---------------------------------- -->
        <!-- Home -->
        <!-- ---------------------------------- -->
        <li class="nav-small-cap">
          <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
          <span class="hide-menu">Beranda</span>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{url('admin')}}" aria-expanded="false">
            <span>
              <i class="ti ti-aperture"></i>
            </span>
            <span class="hide-menu">Dasbor</span>
          </a>
        </li>
        <!-- ---------------------------------- -->
        <!-- Dashboard -->
        <!-- ---------------------------------- -->
        <li class="nav-small-cap">
          <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
          <span class="hide-menu">Halaman</span>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{ route('backend.siswa.index') }}" aria-expanded="false">
            <span>
              <i class="ti ti-user-circle"></i>
            </span>
            <span class="hide-menu">Akun</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{ route('backend.transaksi.index') }}" aria-expanded="false">
            <span>
              <i class="ti ti-currency-dollar"></i>
            </span>
            <span class="hide-menu">Kelola Uang Kas</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{ route('backend.pembayaran.index') }}" aria-expanded="false">
            <span>
              <i class="ti ti-app-window"></i>
            </span>
            <span class="hide-menu">Pembayaran</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{ route('backend.kas.index') }}" aria-expanded="false">
            <span>
              <i class="ti ti-cards"></i>
            </span>
            <span class="hide-menu">Catatan Kas</span>
          </a>
        </li>
                <li class="sidebar-item">
          <a class="sidebar-link" href="{{ url('admin/export') }}" aria-expanded="false">
            <span>
              <i class="ti ti-file-description"></i>
            </span>
            <span class="hide-menu">Laporan</span>
          </a>
        </li>
      </ul>
    </nav>

    <div class="fixed-profile p-3 mx-4 mb-2 bg-secondary-subtle rounded mt-3">
      <div class="hstack gap-3">
        <div class="john-img">
          <img src="{{ asset('assets/backend/images/profile/user-1.jpg') }}" class="rounded-circle" width="40" height="40" alt="modernize-img" />
        </div>
        <div class="john-title" >
          <h6 class="mb-0 fs-4 fw-semibold">{{ Auth::user()->name }}</h6>
          <span class="fs-2">{{ Auth::user()->isAdmin == 1 ? 'Bendahara' : ''}}</span>
        </div>
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); 
        document.getElementById('logout-form').submit();" class="border-0 bg-transparent text-primary ms-auto" tabindex="0" type="button" aria-label="logout" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="logout">
          <i class="ti ti-power fs-6"></i>
        </a>

        <form action="{{ route('logout') }}" method="post" id="logout-form">
          @csrf
        </form>
      </div>
    </div>

    <!-- ---------------------------------- -->
    <!-- Start Vertical Layout Sidebar -->
    <!-- ---------------------------------- -->
  </div>
</aside>