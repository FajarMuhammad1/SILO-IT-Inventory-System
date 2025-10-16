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
    <li class="nav-item active">
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

    <!-- Nav Item - Pages -->
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/scan') }}">
            <i class="fas fa-barcode"></i>
            <span>Scan Barcode</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ url('/inventories') }}">
            <i class="fas fa-database"></i>
            <span>Data Barang</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ url('/audit') }}">
            <i class="fas fa-clipboard-check"></i>
            <span>Audit</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Logout -->
    <li class="nav-item">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="nav-link btn btn-link text-left text-white">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </button>
        </form>
    </li>

</ul>
