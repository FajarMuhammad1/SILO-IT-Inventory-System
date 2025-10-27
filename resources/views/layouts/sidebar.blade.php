<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-tools"></i>
        </div>
        <div class="sidebar-brand-text mx-3">IT Support</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Inventory
    </div>

    <li class="nav-item {{ request()->is('inventories/scan') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('inventories.scan') }}">
        <i class="fas fa-barcode"></i>
        <span>Scan Barcode</span>
    </a>
</li>


    <!-- Nav Item - Data Barang -->
    <li class="nav-item {{ request()->is('inventories*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/inventories') }}">
            <i class="fas fa-database"></i>
            <span>Data Barang</span>
        </a>
    </li>

    <!-- Nav Item - Audit -->
    <li class="nav-item {{ request()->is('audit') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/audit') }}">
            <i class="fas fa-clipboard-check"></i>
            <span>Audit</span>
        </a>
    </li>

    <!-- Nav Item - Activity Log -->
    <li class="nav-item {{ request()->is('activity-logs*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('activity-logs.index') }}">
            <i class="fas fa-list"></i>
            <span>Activity Log</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Logout -->
    <li class="nav-item">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="nav-link btn btn-link text-start text-white">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </button>
        </form>
    </li>

</ul>

<!-- Tambahan style agar hover & active terlihat lebih elegan -->
<style>
    .sidebar .nav-item.active > .nav-link {
        background-color: rgba(255, 255, 255, 0.2);
        font-weight: 600;
        color: #fff;
    }
    .sidebar .nav-link:hover {
        background-color: rgba(255, 255, 255, 0.15);
        color: #fff;
        transition: 0.3s ease;
    }
    .sidebar .nav-link i {
        width: 20px;
        text-align: center;
        margin-right: 8px;
    }
</style>
