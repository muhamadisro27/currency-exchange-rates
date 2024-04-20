<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
        <img src="{{ asset('img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
         with font-awesome or any other icon font library -->
                @if (auth()->user()->can('view-dashboard'))
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                @endif
                @if (auth()->user()->can('view-user'))
                    <li class="nav-item">
                        <a href="{{ route('user') }}" class="nav-link {{ request()->is('user') || request()->is('user/*')  ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                User
                            </p>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
