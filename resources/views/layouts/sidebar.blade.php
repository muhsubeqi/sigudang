<nav id="sidebar" aria-label="Main Navigation">
    <!-- Side Header -->
    <div class="content-header">
        <!-- Logo -->
        <a class="font-semibold text-dual" href="/">
            <span class="smini-visible">
                <i class="fa fa-g text-primary fw-bold"></i>
            </span>
            <span class="smini-hide fs-5 tracking-wider"> SI<span class="fw-normal"><i
                        class="fa fa-g text-primary fw-bold"></i>UDANG</span></span>
        </a>
        <!-- END Logo -->

        <!-- Extra -->
        <div>
            <!-- Dark Mode -->
            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
            <a class="btn btn-sm btn-alt-secondary" data-toggle="layout" data-action="dark_mode_toggle"
                href="javascript:void(0)">
                <i class="far fa-moon"></i>
            </a>
            <!-- END Dark Mode -->

            <!-- Close Sidebar, Visible only on mobile screens -->
            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
            <a class="d-lg-none btn btn-sm btn-alt-secondary ms-1" data-toggle="layout" data-action="sidebar_close"
                href="javascript:void(0)">
                <i class="fa fa-fw fa-times"></i>
            </a>
            <!-- END Close Sidebar -->
        </div>
        <!-- END Extra -->
    </div>
    <!-- END Side Header -->

    <!-- Sidebar Scrolling -->
    <div class="js-sidebar-scroll">
        <!-- Side Navigation -->
        <div class="content-side">
            <ul class="nav-main">
                <li class="nav-main-item">
                    <a class="nav-main-link {{ request()->routeIs('dashboard.*') ? ' active' : '' }}"
                        href="{{ route('dashboard.index') }}">
                        <i class="nav-main-link-icon fas fa-tachometer-alt"></i>
                        <span class="nav-main-link-name">Dashboard</span>
                    </a>
                </li>
                <li class="nav-main-heading">Master</li>
                <li class="nav-main-item {{ request()->routeIs('item.*', 'type.*', 'unit.*') ? ' open' : '' }}">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                        aria-expanded="true" href="#">
                        <i class="nav-main-link-icon fas fa-laptop"></i>
                        <span class="nav-main-link-name">Barang</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link {{ request()->routeIs('item.*') ? ' active' : '' }}"
                                href="{{ route('item.index') }}">
                                <span class="nav-main-link-name">Data Barang</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link {{ request()->routeIs('type.*') ? ' active' : '' }}"
                                href="{{ route('type.index') }}">
                                <span class="nav-main-link-name">Jenis Barang</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link {{ request()->routeIs('unit.*') ? ' active' : '' }}"
                                href="{{ route('unit.index') }}">
                                <span class="nav-main-link-name">Satuan</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-main-heading">Transaksi</li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="{{ route('item-transaction.index', ['status' => 'in']) }}">
                        <i class="nav-main-link-icon fas fa-folder-closed"></i>
                        <span class="nav-main-link-name">Barang Masuk</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="{{ route('item-transaction.index', ['status' => 'out']) }}">
                        <i class="nav-main-link-icon fas fa-folder-open"></i>
                        <span class="nav-main-link-name">Barang Keluar</span>
                    </a>
                </li>
                <li class="nav-main-heading">Laporan</li>
                <li class="nav-main-item">
                    <a class="nav-main-link {{ request()->routeIs('report.stock.index') ? ' active' : '' }}"
                        href="{{ route('report.stock.index') }}">
                        <i class="nav-main-link-icon fas fa-file-excel"></i>
                        <span class="nav-main-link-name">Laporan Stok</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="{{ route('report.item-transaction.index', ['status' => 'in']) }}">
                        <i class="nav-main-link-icon fas fa-file-download"></i>
                        <span class="nav-main-link-name">Laporan Barang Masuk</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="{{ route('report.item-transaction.index', ['status' => 'out']) }}">
                        <i class="nav-main-link-icon fas fa-file-upload"></i>
                        <span class="nav-main-link-name">Laporan Barang Keluar</span>
                    </a>
                </li>
                <li class="nav-main-heading">Pengaturan</li>
                <li class="nav-main-item">
                    <a class="nav-main-link{{ request()->routeIs('user.*') ? ' active' : '' }}"
                        href="{{ route('user.index') }}">
                        <i class="nav-main-link-icon fas fa-users"></i>
                        <span class="nav-main-link-name">Pengguna</span>
                    </a>
                </li>
                <li class="nav-main-item {{ request()->routeIs('permission.*', 'role.*') ? ' open' : '' }}">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                        aria-expanded="true" href="#">
                        <i class="nav-main-link-icon fas fa-lock"></i>
                        <span class="nav-main-link-name">Role Permission</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link{{ request()->routeIs('permission.*') ? ' active' : '' }}"
                                href="{{ route('permission.index') }}">
                                <span class="nav-main-link-name">Permission</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link{{ request()->routeIs('role.*') ? ' active' : '' }}"
                                href="{{ route('role.index') }}">
                                <span class="nav-main-link-name">Role</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- END Side Navigation -->
    </div>
    <!-- END Sidebar Scrolling -->
</nav>