<div class="sidebar-menu">
    <ul class="menu">
        <li class="sidebar-title">Main Menu</li>


        <li class="sidebar-item {{ Request::is('admin/dashboard*') ? 'active' : '' }}">
            <a href="{{ url('/admin/dashboard') }}" class="sidebar-link">
                <i class="bi bi-grid-fill"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li
            class="sidebar-item {{ Request::is('admin/data_anggota*', 'admin/data_penerbit*', 'admin/data_admin*', 'admin/data_peminjaman*') ? 'active' : '' }} has-sub">
            <a href="{{ url('/admin/data_anggota*') }}" class='sidebar-link'>
                <i class="bi bi-folder-fill"></i> <span>Master Data</span>
            </a>
            <ul class="submenu">
                <li class="submenu-item {{ Request::is('admin/data_anggota*') ? 'active' : '' }}">
                    <a href="{{ url('/admin/data_anggota') }}">Data Anggota</a>
                </li>
                <li class="submenu-item {{ Request::is('admin/data_penerbit*') ? 'active' : '' }} ">
                    <a href="{{ url('/admin/data_penerbit') }}">Data Penerbit</a>
                </li>
                <li class="submenu-item {{ Request::is('admin/data_admin*') ? 'active' : '' }} ">
                    <a href="{{ url('/admin/data_admin') }}">Data Administrator</a>
                </li>
                <li class="submenu-item {{ Request::is('admin/data_peminjaman*') ? 'active' : '' }} ">
                    <a href="{{ url('/admin/data_peminjaman') }}">Data Peminjaman</a>
                </li>
            </ul>
        </li>
        <li class="sidebar-item {{ Request::is('admin/data_buku*', 'admin/data_kategori*') ? 'active' : '' }} has-sub">
            <a href="{{ url('/admin/data_buku') }}" class='sidebar-link'>
                <i class="bi bi-book-fill"></i>
                <span>Katalog Buku</span>
            </a>
            <ul class="submenu">
                <li class="submenu-item {{ Request::is('admin/data_buku*') ? 'active' : '' }}">
                    <a href="{{ url('/admin/data_buku') }}">Data Buku</a>
                </li>
                <li class="submenu-item {{ Request::is('admin/data_kategori*') ? 'active' : '' }} ">
                    <a href="{{ url('/admin/data_kategori') }}">Kategori Buku</a>
                </li>
            </ul>
        </li>

        <li
            class="sidebar-item {{ Request::is('admin/report_peminjaman*', 'admin/report_pengembalian*', 'admin/report_user*') ? 'active' : '' }} has-sub">
            <a href="{{ url('/admin/data_buku') }}" class='sidebar-link'>
                <i class="bi bi-file-earmark-bar-graph-fill"></i> <span>Laporan</span>
            </a>
            <ul class="submenu">
                <li class="submenu-item {{ Request::is('admin/report_peminjaman*') ? 'active' : '' }} ">
                    <a href="{{ url('/admin/report_peminjaman') }}">Laporan Peminjaman</a>
                </li>
                <li class="submenu-item {{ Request::is('admin/report_pengembalian*') ? 'active' : '' }} ">
                    <a href="{{ url('/admin/report_pengembalian') }}">Laporan Pengembalian</a>
                </li>


                <li class="submenu-item {{ Request::is('admin/report_user*') ? 'active' : '' }} ">
                    <a href="{{ url('/admin/report_user') }}">Laporan User</a>
                </li>


            </ul>
        </li>

        <li class="sidebar-title">Lain-Lain</li>


        <li class="sidebar-item {{ Request::is('admin/identitas*') ? 'active' : '' }}">
            <a href="{{ url('/admin/identitas') }}" class="sidebar-link">
                <i class="bi bi-info-circle-fill"></i> <span>Identitas Aplikasi</span>
            </a>
        </li>
        <li
            class="sidebar-item {{ Request::is('admin/pesan_terkirim*', 'admin/pesan_masuk*') ? 'active' : '' }} has-sub">
            <a href="{{ url('/admin/pesan_terkirim') }}" class="sidebar-link">
                <i class="bi bi-envelope-fill"></i> <span>Pesan</span>
            </a>

            <ul class="submenu">
                <li class="submenu-item {{ Request::is('admin/pesan_terkirim*') ? 'active' : '' }}">
                    <a href="{{ url('/admin/pesan_terkirim') }}">Pesan Terkirim</a>
                </li>
                <li class="submenu-item {{ Request::is('admin/pesan_masuk*') ? 'active' : '' }} ">
                    <a href="{{ url('/admin/pesan_masuk') }}">Pesan Masuk</a>
                </li>
            </ul>
        </li>
        <li class="sidebar-title">Lanjutan</li>

        <li class="sidebar-item">

            <a href="{{ route('logout') }}"
                onclick="event.preventDefault();
        document.getElementById('logout-form').submit();"
                class='sidebar-link'>
                <i class="bi bi-box-arrow-in-left"></i>
                <span>Logout</span>
            </a>
        </li>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </ul>
</div>
