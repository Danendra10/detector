<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    @stack('heads')

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <link rel="stylesheet" href="/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
    <link rel="stylesheet" href="/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
    <link rel="stylesheet" href="/assets/css/argon.css?v=1.2.0" type="text/css">
    <script src="/assets/vendor/jquery/dist/jquery.min.js"></script>
    {{-- <script src="/assets/vendor/jquery/dist/jquery.min.js"></script> --}}
    <script src="/assets/vendor/datatables/jquery.dataTables.min.js"></script>
    {{-- <link href="https://cdn.datatables.net/v/bs4/dt-1.13.2/b-2.3.4/datatables.min.css" />
    
    <script src="https://cdn.datatables.net/v/bs4/dt-1.13.2/b-2.3.4/datatables.min.js"></script> --}}
    {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
    <script src="{{ asset('js/app.js') }}"></script>


    <link rel="stylesheet" href="/assets/vendor/datatables/dataTables.bootstrap4.min.css">
</head>

<body>
    <!-- Sidenav -->
    <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
        <div class="scrollbar-inner">
            <!-- Brand -->
            <div class="sidenav-header  align-items-center mb-4">
                <a class="navbar-brand" href="javascript:void(0)">

                    <h1>{{ env('APP_NAME') }}</h1>


                    <p> Admin Controls </p>
                </a>
            </div>

            <div class=" navbar-inner">
                <!-- Collapse -->
                <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                    <!-- Nav items -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}" style="font-size: 18px; text-align: center">
                                <i class="fas fa-home" style="font-size: 16px;"></i>
                                <span class="nav-link-text ml-2">Dashboard</span>
                            </a>
                        </li>
                        <!-- Divider -->
                        <hr class="my-2">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/detector') }}"
                                style="font-size: 18px; text-align: center">
                                <i class="fas fa-plus" style="font-size: 16px;"></i>
                                <span class="nav-link-text ml-2">Detector</span>
                            </a>
                        </li>
                        <!-- Divider -->
                        <hr class="my-2">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/meteran') }}"
                                style="font-size: 18px; text-align: center">
                                <i class="fas fa-table" style="font-size: 16px;"></i>
                                <span class="nav-link-text ml-2">Meteran</span>
                            </a>
                        </li>
                        <!-- Divider -->
                        <hr class="my-2">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/summary-data') }}"
                                style="font-size: 18px; text-align: center">
                                <i class="fas fa-table" style="font-size: 16px;"></i>
                                <span class="nav-link-text ml-2">Summary Datas</span>
                            </a>
                        </li>
                    </ul>
                    <!-- Divider -->
                    <hr class="my-3">
                </div>
            </div>
        </div>
    </nav>


    <!-- Main content -->
    <div class="main-content" id="panel">
        <!-- Topnav -->
        <nav class="navbar navbar-top navbar-expand bg-default navbar-dark border-bottom">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Navbar links -->
                    <ul class="navbar-nav align-items-center">
                        <li class="nav-item">
                            <!-- Sidenav toggler -->
                            <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin"
                                data-target="#sidenav-main">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item d-sm-none">
                            <a class="nav-link" href="#" data-action="search-show"
                                data-target="#navbar-search-main">
                                <i class="ni ni-zoom-split-in"></i>
                            </a>
                        </li>

                    </ul>
                    <ul class="navbar-nav align-items-center  ml-auto ">
                        <li class="nav-item dropdown">
                            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <div class="media align-items-center">
                                    <span class="avatar avatar-sm rounded-circle">
                                        <!-- <img alt="Image placeholder" src="/img/user/topik.png"> -->
                                        <i class="fas fa-bell fa-lg"></i>
                                    </span>
                                </div>
                            </a>
                            <div class="dropdown-menu  dropdown-menu-right ">
                                <a href="{{ url('/admin/news/minta-tambah-fitur') }}" class="dropdown-item">
                                    <span>AJUKAN FITUR</span>
                                    <p>Klik disini!!</p>
                                </a>
                                <a href="{{ url('/admin/news/peserta-tidak-bisa-login') }}" class="dropdown-item">
                                    <span>PESERTA TIDAK BISA LOGIN</span>
                                    <p>Klik disini!!</p>
                                </a>
                                <a href="{{ url('/admin/lihat-semua-data-akun') }}" class="dropdown-item">
                                    <span>ADMIN BISA CEK AKUN USER SENDIRI</span>
                                    <p>Klik disini!!</p>
                                </a>
                                <a class="dropdown-item" aria-disabled="true">
                                    <span>TOMBOL HAPUS DINONAKTIFKAN</span>
                                    <p>Harap admin hati hati dalam mengolah data</p>
                                </a>
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <div class="media align-items-center">
                                    <span class="avatar avatar-sm rounded-circle">
                                        <!-- <img alt="Image placeholder" src="/img/user/topik.png"> -->
                                        <i class="fas fa-user-shield fa-lg"></i>
                                    </span>
                                    <div class="media-body  ml-2  d-none d-lg-block">
                                        {{-- <span class="mb-0 text-sm  font-weight-bold">{{ Auth::user()->email }}</span> --}}
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-menu  dropdown-menu-right ">
                                <a href="{{ url('/logout') }}" class="dropdown-item">
                                    <span>Logout</span>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

        </nav>


        <!-- PISAHHHH  -->

        @yield('content')

        <!-- PPPPIIISAAAHH  -->


        <!-- Footer -->
        <footer class="footer pt-0">
            <div class="row align-items-center justify-content-lg-between">
                <div class="col-lg-6">
                    <div class="copyright text-center  text-lg-left  text-muted">
                        &copy; 2023 <span class="font-weight-bold ml-1"
                            style="color: #172B4D">{{ env('APP_NAME') }}</span>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    @stack('scripts')
    <!-- Argon Scripts -->
    <script src="/assets/vendor/js-cookie/js.cookie.js"></script>
    <script src="/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
    <script src="/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
    <!-- Argon JS -->
    <script src="/assets/js/argon.js?v=1.2.0"></script>
    <!-- tabel  -->
    <script src="/assets/vendor/datatables/jquery.dataTables.js"></script>
    <script src="/assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <!-- Page level custom scripts -->
    {{-- <!-- <script src="/js/demo/datatables-demo.js"></script> --> --}}

    @yield('script')

</body>

</html>
