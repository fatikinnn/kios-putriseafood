<style>
    .nav-sidebar .nav-item:hover {
    background-color: #1f2d3d;
    transition: background-color 0.3s ease;
}

.nav-sidebar .nav-item .nav-link {
    transition: padding-left 0.3s ease;
}

.nav-sidebar .nav-item:hover .nav-link {
    padding-left: 15px;
}

.nav-sidebar .nav-item .nav-icon {
    transition: transform 0.3s ease;
}

.nav-sidebar .nav-item:hover .nav-icon {
    transform: scale(1.1);
}

</style>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a class="brand-link">
        <img src="{{ url($setting->path_logo) }}" alt="{{ $setting->nama_perusahaan }} Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light logo-side">{{ $setting->nama_perusahaan }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
            <div class="image">
                <img src="{{ asset(auth()->user()->foto ?? '/lte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2 img-profil" alt="{{ auth()->user()->name }}'s profile picture" style="width: 40px; height: 40px; object-fit: cover;">
            </div>
            <div class="info">
                <a href="{{ route('user.profil') }}" class="d-block">{{ auth()->user()->name ?? 'Guest' }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                @if (auth()->user()->level == 1)
                <li class="nav-header">MASTER</li>
                <li class="nav-item">
                    <a href="{{ route('kategori.index') }}" class="nav-link {{ request()->routeIs('kategori.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cube"></i>
                        <p>Kategori</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('produk.index') }}" class="nav-link {{ request()->routeIs('produk.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cubes"></i>
                        <p>Produk</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('member.index') }}" class="nav-link {{ request()->routeIs('member.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-id-card"></i>
                        <p>Member</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('supplier.index') }}" class="nav-link {{ request()->routeIs('supplier.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-ship"></i>
                        <p>Supplier</p>
                    </a>
                </li>

                <li class="nav-header">BARANG</li>
                <li class="nav-item">
                    <a href="{{ route('inventory.index') }}" class="nav-link {{ request()->routeIs('inventory.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-box"></i>
                        <p>Data Barang</p>
                    </a>
                </li>

                <li class="nav-header">TRANSAKSI</li>
                <li class="nav-item">
                    <a href="{{ route('pengeluaran.index') }}" class="nav-link {{ request()->routeIs('pengeluaran.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-money-bill"></i>
                        <p>Pengeluaran</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('pembelian.index') }}" class="nav-link {{ request()->routeIs('pembelian.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-download"></i>
                        <p>Pembelian</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('penjualan.index') }}" class="nav-link {{ request()->routeIs('penjualan.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-upload"></i>
                        <p>Penjualan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('transaksi.baru') }}" class="nav-link {{ request()->routeIs('transaksi.baru') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cart-arrow-down"></i>
                        <p>Transaksi Baru</p>
                    </a>
                </li>

                <li class="nav-header">REPORT</li>
                
                <li class="nav-item">
                    <a href="{{ route('laporan.index') }}" class="nav-link {{ request()->routeIs('laporan.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-file-pdf"></i>
                        <p>Laporan</p>
                    </a>
                </li>

                <li class="nav-header">SYSTEM</li>
                <li class="nav-item">
                    <a href="{{ route('user.index') }}" class="nav-link {{ request()->routeIs('user.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>User</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('setting.index') }}" class="nav-link {{ request()->routeIs('setting.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>Pengaturan</p>
                    </a>
                </li>
                @else
                <li class="nav-header">TRANSAKSI</li>
                <li class="nav-item">
                    <a href="{{ route('pengeluaran.index') }}" class="nav-link {{ request()->routeIs('pengeluaran.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-money-bill"></i>
                        <p>Pengeluaran</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('penjualan.index') }}" class="nav-link {{ request()->routeIs('penjualan.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-upload"></i>
                        <p>Penjualan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('transaksi.baru') }}" class="nav-link {{ request()->routeIs('transaksi.baru') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cart-arrow-down"></i>
                        <p>Transaksi Baru</p>
                    </a>
                </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
 <script>
    $(document).ready(function () {
    $('.nav-sidebar .nav-item').hover(function () {
        $(this).find('.nav-link').animate({ paddingLeft: '15px' }, 300);
        $(this).find('.nav-icon').animate({ transform: 'scale(1.1)' }, 300);
    }, function () {
        $(this).find('.nav-link').animate({ paddingLeft: '10px' }, 300);
        $(this).find('.nav-icon').animate({ transform: 'scale(1.0)' }, 300);
    });
});

 </script>