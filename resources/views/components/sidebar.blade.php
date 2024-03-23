<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('home') }}">Pro-X</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('home') }}">PX</a>
        </div>

        <ul class="sidebar-menu">
            @php
                $admin = Auth::user()->hasRole('admin');
                $manajemen = Auth::user()->hasRole('manajemen');
            @endphp

            @if ($admin || $manajemen)
                @if ($admin)
                    <li class="menu-header">Admin</li>
                    <li class="{{ Request::is('dashboard/admin') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('/dashboard/admin') }}"><i class="fas fa-fire"></i>
                            <span>Dashboard</span></a>
                    </li>
                @elseif ($manajemen)
                    <li class="menu-header">Manajemen</li>
                    <li class="{{ Request::is('dashboard/manajemen') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('/dashboard/manajemen') }}"><i class="fas fa-fire"></i>
                            <span>Dashboard</span></a>
                    </li>
                @endif
                <li class="dropdown">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-database"></i><span>Master
                            Data</span></a>
                    <ul class="dropdown-menu">
                        @if ($admin)
                            <li class="{{ Request::is('dashboard/user*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('/dashboard/user') }}"><i class="far fa-user"></i>
                                    <span>User</span></a>
                            </li>
                            <li class="{{ Request::is('dashboard/penanggung-jawab*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('/dashboard/penanggung-jawab') }}"><i
                                        class="fas fa-user-tie"></i>
                                    <span>Penanggung Jawab</span></a>
                            </li>
                        @endif

                        <li class="{{ Request::is('dashboard/kategori*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('/dashboard/kategori') }}"><i class="fas fa-list"></i>
                                <span>Kategori</span></a>
                        </li>
                        <li class="{{ Request::is('dashboard/barang*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('/dashboard/barang') }}"><i class="fas fa-box"></i>
                                <span>Barang</span></a>
                        </li>
                        <li class="{{ Request::is('dashboard/jenis-transaksi*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('/dashboard/jenis-transaksi') }}"><i
                                    class="fas fa-money-bill-alt"></i>
                                <span>Jenis Transaksi</span></a>
                        </li>
                    </ul>

                <li class="nav-item dropdown">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-wallet"></i>
                        <span>Transaksi</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ Request::is('transaksi') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('/dashboard/transaksi') }}"><i class="fas fa-history"></i>
                                <span>Riwayat</span></a>
                        </li>
                        <li class="{{ Request::is('transaksi.persetujuan') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('/dashboard/transaksi/persetujuan') }}"><i
                                    class="fas fa-check-circle"></i> <span>Persetujuan</span> </a>
                        </li>
                    </ul>
                </li>
            @endif

            {{-- @if (Auth::user()->hasRole('manajemen'))
                <li class="menu-header">Manajemen</li>
                <li class="{{ Request::is('dashboard/manajemen') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('/dashboard/manajemen') }}"><i class="fas fa-fire"></i>
                        <span>Dashboard</span></a>
                </li>
                <li class="dropdown">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-database"></i><span>Master
                            Data</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ Request::is('dashboard/manajemen/kategori*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('/dashboard/manajemen/kategori') }}"><i
                                    class="fas fa-list"></i>
                                <span>Kategori</span></a>
                        </li>
                        <li class="{{ Request::is('dashboard/manajemen/barang*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('/dashboard/manajemen/barang') }}"><i
                                    class="fas fa-box"></i>
                                <span>Barang</span></a>
                        </li>
                        <li class="{{ Request::is('dashboard/manajemen/jenis-transaksi*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('/dashboard/manajemen/jenis-transaksi') }}"><i
                                    class="fas fa-money-bill-alt"></i>
                                <span>Jenis Transaksi</span></a>
                        </li>
                    </ul>

                <li class="nav-item dropdown">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-wallet"></i>
                        <span>Transaksi</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ Request::is('transaksi') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('/dashboard/manajemen/transaksi') }}"><i
                                    class="fas fa-history"></i>
                                <span>Riwayat</span></a>
                        </li>
                        <li class="{{ Request::is('transaksi.persetujuan') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('/dashboard/manajemen/transaksi/persetujuan') }}"><i
                                    class="fas fa-check-circle"></i> <span>Persetujuan</span> </a>
                        </li>
                    </ul>
                </li>
            @endif --}}

            @if (Auth::user()->hasRole('anggota'))
                <li class="menu-header">Anggota</li>
                <li class="{{ Request::is('dashboard/anggota') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('/dashboard/anggota') }}"><i class="fas fa-fire"></i>
                        <span>Dashboard</span></a>
                </li>
                <li class="{{ Request::is('dashboard/anggota/barang') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('/dashboard/anggota/barang') }}"><i class="fas fa-box"></i>
                        <span>Barang</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-file"></i>
                        <span>Pengajuan</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ Request::is('dashboard/anggota/peminjaman*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('/dashboard/anggota/peminjaman') }}">
                                <i class="fas fa-arrow-circle-right"></i>
                                <span>Peminjaman</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('dashboard/anggota/pengembalian*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('/dashboard/anggota/pengembalian') }}">
                                <i class="fas fa-arrow-circle-left"></i>
                                <span>Pengembalian</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="{{ Request::is('dashboard/anggota/riwayat') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('/dashboard/anggota/riwayat') }}"><i class="fas fa-history"></i>
                        <span>Riwayat</span></a>
                </li>
            @endif

        </ul>

        <div class="hide-sidebar-mini mt-4 mb-4 p-3">
            <a href="{{ route('logout') }}" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-sign-out-alt"></i> Log Out
            </a>
        </div>
    </aside>
</div>
