<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
            <i class="fas fa-user-graduate"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Dashboard pelanggan</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('pelanggan.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

        <!-- Nav Item - Paket -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('pelanggan.pakets.index') }}">
                <i class="fas fa-fw fa-box"></i>
                <span>Daftar Paket</span>
            </a>
        </li>
    
        <!-- Nav Item - Pesanan -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('pelanggan.orders.index') }}">
                <i class="fas fa-fw fa-shopping-cart"></i>
                <span>Pesanan Saya</span>
            </a>
        </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
</ul>