<div class="startbar d-print-none">
    {{-- === START BRAND === --}}
    <div class="brand">
        <a href="{{ route('any', 'index') }}" class="logo">
            <span>
                <img src="{{ asset('/images/logo-sm.png') }}" alt="logo-small" class="logo-sm">
            </span>
            <span class="">
                <img src="{{ asset('/images/logo-light.png') }}" alt="logo-large" class="logo-lg logo-light">
                <img src="{{ asset('/images/logo-dark.png') }}" alt="logo-large" class="logo-lg logo-dark">
            </span>
        </a>
    </div>
    {{-- === START BRAND === --}}

    {{-- === STARTBAR-MENU === --}}
    <div class="startbar-menu">
        <div class="startbar-collapse" id="startbarCollapse" data-simplebar>
            <div class="d-flex align-items-start flex-column w-100">
                <!-- Navigation -->
                <ul class="navbar-nav mb-auto w-100">
                    <li class="menu-label mt-2">
                        <span>Main</span>
                    </li>

                    <!--Dashboard-->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('any', 'index') }}">
                            <i class="iconoir-report-columns menu-icon"></i>
                            <span>Dashboard</span>
                            {{-- <span class="badge text-bg-info ms-auto">New</span> --}}
                        </a>
                    </li>
                    <!--Dashboard-->

                    {{-- ========================================= --}}

                    @if (in_array(auth()->user()->level->nama_level, ['Superadmin', 'Administrator']))
                        <li class="menu-label mt-2">
                            <span>Master Data</span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('users*') ? 'active' : '' }}"
                                href="{{ route('users.index') }}">
                                <i class="bi bi-person-gear menu-icon"></i>
                                <span>Data User</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('customers*') ? 'active' : '' }}"
                                href="{{ route('customers.index') }}">
                                <i class="bi bi-people menu-icon"></i>
                                <span>Data Pelanggan</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('services*') ? 'active' : '' }}"
                                href="{{ route('services.index') }}">
                                <i class="bi bi-list-check menu-icon"></i>
                                <span>Jenis Layanan</span>
                            </a>
                        </li>
                    @endif

                    {{-- ========================================= --}}

                    @if (in_array(auth()->user()->level->nama_level, ['Superadmin', 'Administrator', 'Operator']))
                        <li class="menu-label mt-2">
                            <span>Transaksi</span>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link"{{ Request::is('transactions*') ? 'active' : '' }}"
                                href="{{ route('transactions.index') }}">
                                <i class="bi bi-cart-plus menu-icon"></i>
                                <span>Transaksi Laundry</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('pickups*') ? 'active' : '' }}"
                                href="{{ route('pickups.index') }}">
                                <i class="bi bi-bag-check menu-icon"></i>
                                <span>Pengambilan</span>
                            </a>
                        </li>
                    @endif

                    {{-- ========================================= --}}

                    @if (in_array(auth()->user()->level->nama_level, ['Superadmin', 'Administrator', 'Operator', 'Leader']))
                        <li class="menu-label mt-2">
                            <span>Laporan</span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('reports*') ? 'active' : '' }}"
                                href="{{ route('reports.index') }}">
                                <i class="bi bi-bar-chart menu-icon"></i>
                                <span>Laporan Penjualan</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
    {{-- === STARTBAR-MENU === --}}
</div>
<div class="startbar-overlay d-print-none"></div>
