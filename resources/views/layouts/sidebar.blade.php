<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="#" class="brand-link">
    <span class="brand-text font-weight-light">SI Perpus</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        @if(Auth::user()->gambar == '')
          <img class="img-xs rounded-circle"  src="{{asset('images/user/default.png')}}" alt="profile image">
        @else
          <img class="img-xs rounded-circle"  src="{{asset('images/user/'.Auth::user()->gambar)}}" alt="profile image">
        @endif
      </div>
      <div class="info">
        <a href="{{route('user.show', Auth::user()->id)}}" class="d-block">{{Auth::user()->name}}</a>
      </div>
      
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="{{url('/')}}" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        
        <li class="nav-item" >
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>
              Master Data
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('buku.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Buku</p>
                </a>
              </li>
              @if(Auth::user()->level == 'admin')
              <li class="nav-item">
                <a href="{{route('anggota.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Anggota</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('user.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data User</p>
                </a>
              </li>
              @endif
            </ul>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-table"></i>
            <p>
              Transaksi
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('transaksi.index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Transaksi Peminjaman</p>
              </a>
            </li>
            @if(Auth::user()->level == 'admin')
            <li class="nav-item">
              <a href="{{route('transaksihilang')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Transaksi Kehilangan Buku</p>
              </a>
            </li>
            @endif
          </ul>
        </li>
        @if(Auth::user()->level == 'admin')
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-edit"></i>
            <p>
              Laporan
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{url('laporan/trs')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Laporan Transaksi</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('laporan/buku')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Laporan Buku</p>
              </a>
            </li>
          </ul>
        </li>
        @endif
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>