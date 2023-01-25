<div class="sidebar-menu">
    <ul class="menu">
        <li class="sidebar-title">Main Menu</li>


        <li class="sidebar-item {{ Request::is('user/dashboard*') ? 'active' : '' }}">
            <a href="{{ url('/user/dashboard') }}" class="sidebar-link">
                <i class="bi bi-grid-fill"></i>
                <span>Dashboard</span>
            </a>
        </li>


        <li class="sidebar-item {{ Request::is('user/peminjaman*', 'user/form_peminjaman*') ? 'active' : '' }} has-sub">
            <a href="{{ url('/user/peminjaman') }}" class='sidebar-link'>
                <i class="bi bi-arrow-left-right"></i>
                <span>Peminjaman</span>
            </a>
            <ul class="submenu">
                <li class="submenu-item {{ Request::is('user/form_peminjaman*') ? 'active' : '' }}">
                    <a href="{{ url('/user/form_peminjaman') }}">Form Peminjaman Buku</a>
                </li>
                <li class="submenu-item {{ Request::is('user/peminjaman*') ? 'active' : '' }} ">
                    <a href="{{ url('/user/peminjaman') }}">History Peminjaman Buku</a>
                </li>
            </ul>
        </li>

        <li
            class="sidebar-item {{ Request::is('user/pengembalian*', 'user/form_pengembalian*') ? 'active' : '' }} has-sub">
            <a href="{{ url('/user/pengembalian') }}" class='sidebar-link'>
                <i class="bi bi-arrow-clockwise"></i>
                <span>Pengembalian</span>
            </a>
            <ul class="submenu">
                <li class="submenu-item {{ Request::is('user/form_pengembalian*') ? 'active' : '' }}">
                    <a href="{{ url('/user/form_pengembalian') }}">Form Pengembalian Buku</a>
                </li>
                <li class="submenu-item {{ Request::is('user/pengembalian*') ? 'active' : '' }} ">
                    <a href="{{ url('/user/pengembalian') }}">History Pengembalian Buku</a>
                </li>
            </ul>
        </li>

        <li class="sidebar-title">Lain-Lain</li>
        <li
            class="sidebar-item {{ Request::is('user/pesan_terkirim*', 'user/pesan_masuk*') ? 'active' : '' }} has-sub">
            <a href="{{ url('/user/pesan') }}" class='sidebar-link'>
                <i class="bi bi-envelope"></i>
                <span>Pesan</span>
            </a>
            <ul class="submenu">
                <li class="submenu-item {{ Request::is('user/pesan_terkirim*') ? 'active' : '' }}">
                    <a href="{{ url('/user/pesan_terkirim') }}">Pesan Terkirim</a>
                </li>
                <li class="submenu-item {{ Request::is('user/pesan_masuk*') ? 'active' : '' }} ">
                    <a href="{{ url('/user/pesan_masuk') }}">Pesan Masuk</a>
                </li>
            </ul>
        </li>


        <li class="sidebar-item {{ Request::is('user/profile*', 'user/edit_password') ? 'active' : '' }} has-sub">
            <a href="{{ url('/user/profile') }}" class="sidebar-link">
                <i class="bi bi-person"></i>
                <span>Profile</span>
            </a>

            <ul class="submenu">
                <li class="submenu-item {{ Request::is('user/profile*') ? 'active' : '' }}">
                    <a href="{{ url('/user/profile') }}">Edit Profile</a>
                </li>
                <li class="submenu-item {{ Request::is('user/edit_password*') ? 'active' : '' }} ">
                    <a href="{{ url('/user/edit_password') }}">Edit Password</a>
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
