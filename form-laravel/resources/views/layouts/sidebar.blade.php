<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <a href="#" class="brand-link">
    <span class="brand-text font-weight-light">My Dashboard</span>
  </a>
  <div class="sidebar">
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
        {{-- Dashboard --}}
        <li class="nav-item">
          <a href="{{ route('dashboard') }}" class="nav-link">
            <i class="nav-icon fas fa-home"></i>
            <p>Dashboard</p>
          </a>
        </li>
        {{-- Admin Menu --}}
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-user-cog"></i>
            <p>
              ADMIN
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('admin.pembayaran.form-pembayaran') }}" class="nav-link">
                <i class="nav-icon fas fa-angle-right"></i>
                <p>Pembayaran</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.pengajuan.form-pengajuan') }}" class="nav-link">
                <i class="nav-icon fas fa-angle-right"></i>
                <p>Pengajuan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.proyek.form-proyek') }}" class="nav-link">
                <i class="nav-icon fas fa-angle-right"></i>
                <p>Proyek</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.ulasan.form-ulasan') }}" class="nav-link">
                <i class="nav-icon fas fa-angle-right"></i>
                <p>Ulasan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.portofolio.form-portofolio') }}" class="nav-link">
                <i class="nav-icon fas fa-angle-right"></i>
                <p>Portofolio</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.management.form-management') }}" class="nav-link">
                <i class="nav-icon fas fa-angle-right"></i>
                <p>Manajemen Tugas</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.index') }}" class="nav-link">
                <i class="nav-icon fas fa-angle-right"></i>
                <p>Registrasi</p>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
  </div>
</aside>