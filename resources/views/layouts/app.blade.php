<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <link rel="shortcut icon" href="/assets/images/logo/favicon.svg" type="image/x-icon" />
    <link rel="shortcut icon" href="/assets/images/logo/favicon.png" type="image/png">
    <link rel="stylesheet" href="/assets/css/main/app.css" />
    <link rel="stylesheet" href="/assets/css/main/app-dark.css" />
    <link rel="stylesheet" href="/assets/extensions/choices.js/public/assets/styles/choices.css">
    <link rel="stylesheet" href="/assets/extensions/simple-datatables/style.css" />
    <link rel="stylesheet" href="/assets/css/pages/simple-datatables.css" />



    <style>
        .badge-notification {
            padding: 3px;
            position: absolute;
            right: 20px;
        }

        .scroll {
            inline-size: 150px;
            overflow-wrap: break-word;
        }
    </style>
</head>


@php
    
    use App\Models\Pesan;
    $pesan = Pesan::where('penerima_id', Auth::user()->id)
        ->where('status', 'Belum Dibaca')
        ->get();
    use App\Models\Pemberitahuan;
    $pemberitahuan = Pemberitahuan::orderBy('id', 'DESC')
        ->take(5)
        ->get();
@endphp


<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header position-relative">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="logo">
                            <h2>Perpus</h2>
                        </div>
                        <div class="theme-toggle d-flex gap-2  align-items-center mt-2">
                            <div class="form-check form-switch fs-6">
                                <input class="form-check-input  me-0" type="checkbox" id="toggle-dark" hidden>
                                <label class="form-check-label"></label>
                            </div>
                        </div>
                        <div class="sidebar-toggler x">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i
                                    class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                @if (Auth::user()->role == 'admin')
                    @include('admin.sidebar')
                @else
                    @include('user.sidebar')
                @endif
            </div>
        </div>
        <div id="main" class='layout-navbar'>
            <header class='mb-2'>
                <nav class="navbar navbar-expand navbar-light navbar-top">
                    <div class="container-fluid">
                        <a href="#" class="burger-btn d-block">
                            <i class="bi bi-justify fs-3"></i>
                        </a>

                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto mb-lg-0">
                                <li class="nav-item dropdown me-1">
                                    <a class="nav-link active dropdown-toggle text-gray-600" href="#"
                                        data-bs-toggle="dropdown" aria-expanded="false">

                                        <i class='bi bi-envelope bi-sub fs-4'></i>
                                        <span class="badge badge-notification bg-danger">

                                            {{ count($pesan) }}
                                        </span>

                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">


                                        @if (count($pesan) == 0)
                                            <li><a class="dropdown-item" href="#">
                                                    No New Mail

                                                </a>
                                            </li>
                                        @else
                                            @if (Auth::user()->role == 'user')
                                                @foreach ($pesan as $p)
                                                    <li class="dropdown-item">


                                                        <form action="{{ route('user.edit_status_pesan', $p->id) }}"
                                                            method="POST">
                                                            @csrf

                                                            <button class="dropdown-item" type="submit">
                                                                <div class="row  align-items-center">
                                                                    <div class="avatar avatar-md col-2 ">
                                                                        <img src="{{ asset($p->pengirim->foto) }}">
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <p class="mb-0 font-bold">
                                                                            {{ $p->pengirim->username }}</p>
                                                                        <p class="mb-0 text-custx">{{ $p->judul }}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </button>
                                                        </form>
                                                    </li>
                                                @endforeach
                                            @else
                                                @foreach ($pesan as $p)
                                                    <li class="dropdown-item">


                                                        <form action="{{ route('admin.edit_status_pesan', $p->id) }}"
                                                            method="POST">
                                                            @csrf

                                                            <button class="dropdown-item" type="submit">
                                                                <div class="row  align-items-center">
                                                                    <div class="avatar avatar-md col-2 ">
                                                                        <img src="{{ asset($p->pengirim->foto) }}">
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <p class="mb-0 font-bold">
                                                                            {{ $p->pengirim->username }}</p>
                                                                        <p class="mb-0 text-custx">{{ $p->judul }}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </button>
                                                        </form>
                                                    </li>
                                                @endforeach
                                            @endif
                                        @endif
                                    </ul>
                                </li>
                                {{--  --}}

                                @if (Auth::user()->role == 'admin')


                                    <li class="nav-item dropdown me-1">
                                        <a class="nav-link active dropdown-toggle text-gray-600" href="#"
                                            data-bs-toggle="dropdown" aria-expanded="false">

                                            <i class="bi bi-bell fs-4"></i> <span
                                                class="badge badge-notification bg-danger">

                                                {{ count($pemberitahuan) }}
                                            </span>

                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end"
                                            aria-labelledby="dropdownMenuButton">


                                            @if (count($pemberitahuan) == 0)
                                                <li><a class="dropdown-item" href="#">
                                                        No New Pemberitahuan

                                                    </a>
                                                </li>
                                            @else
                                                @foreach ($pemberitahuan as $infoPemberitahuan)
                                                    <li class="dropdown-item notification-item">
                                                        <a class="d-flex align-items-center" href="#">
                                                            <div class="notification-icon bg-primary">

                                                                @if ($infoPemberitahuan->status == 'peminjaman')
                                                                    {{-- <i class="bi bi-belld-fill align-middle"></i> --}}
                                                                    <i class="bi bi-arrow-left-right align-middle"></i>
                                                                @else
                                                                    <i class="bi bi-arrow-repeat align-middle"></i>
                                                                @endif
                                                            </div>
                                                            <div class="notification-text ms-4">

                                                                <p class="notification-subtitle font-thin text-sm">
                                                                    {{ $infoPemberitahuan->isi }}
                                                                    {{-- {{ $infoPemberitahuan->isi }} --}}
                                                                </p>
                                                            </div>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </li>

                                @endif
                            </ul>
                            <div class="dropdown">
                                <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="user-menu d-flex">
                                        <div class="user-name text-end me-3">
                                            <h6 class="mb-0 text-gray-600">{{ Auth::user()->username }}</h6>
                                            <p class="mb-0 text-sm text-gray-600">{{ Auth::user()->role }}</p>
                                        </div>
                                        <div class="user-img d-flex align-items-center">
                                            <div class="avatar avatar-md" style="border:solid grey 1px">
                                                <img src="/assets/images/faces/2.jpg" alt="Face 1">
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </nav>
            </header>
            <div id="main-content">
                @yield('content')
            </div>
        </div>
    </div>

    <script>
        const appBody = document.body;
        if (localStorage.getItem('theme') == 'theme-dark') {
            localStorage.setItem('theme', "theme-light")
            appBody.classList.add("theme-light");
        } else {
            localStorage.setItem('theme', "theme-light")
            appBody.classList.add("theme-light");
        };
    </script>
    <script src="/assets/js/bootstrap.js"></script>
    <script src="/assets/js/app.js"></script>

    <script src="/assets/extensions/simple-datatables/umd/simple-datatables.js"></script>
    <script src="/assets/js/pages/simple-datatables.js"></script>

    <script src="/assets/extensions/choices.js/public/assets/scripts/choices.js"></script>
    <script src="/assets/js/pages/form-element-select.js"></script>

</body>

</html>
