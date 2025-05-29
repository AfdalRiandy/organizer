<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
            <i class="fas fa-user"></i>
        </div>
        <div class="sidebar-brand-text mx-3">owner</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('owner.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

        <!-- Nav Item - User Management -->
        <li class="nav-item {{ request()->routeIs('owner.users.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('owner.users.index') }}">
                <i class="fas fa-fw fa-users"></i>
                <span>User Management</span></a>
        </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
</ul>