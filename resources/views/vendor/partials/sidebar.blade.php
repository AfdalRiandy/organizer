<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
            <i class="fas fa-user-graduate"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Dashboard vendor</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('vendor.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

        <!-- Nav Item - Jasa -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('vendor.jasas.index') }}">
                <i class="fas fa-fw fa-wrench"></i>
                <span>Jasa Vendor</span>
            </a>
        </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
</ul>