<!DOCTYPE html>
<html lang="en">

<head>
    {{-- <title>@yield('title')</title> --}}
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>bale classy</title>
    <link rel="stylesheet" href="{{ asset('assets/css/main/app.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/extensions/simple-datatables/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/simple-datatables.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/extensions/sweetalert2/sweetalert2.min.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo/logo.png')}}" type="image/png">


</head>

<body>
    <div id="app">

        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header position-relative">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="logo">
                            <a href="{{ route('dashboard') }}"><img src="{{ asset('assets/images/logo/text.png')}}" style="height: 6rem;" alt="Logo"srcset="" /></a>
                        </div>
                        <div class="d-flex gap-2 align-items-center mt-2">
                            <div class="fs-6">
                                <p class="me-0" id="toggle-dark"></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        <li class="sidebar-item">
                            <a href="{{ route('dashboard') }}" class="sidebar-link">
                                <i class="bi bi-house-door-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('catalog') }}" class="sidebar-link">
                                <i class="bi bi-grid-fill"></i>
                                <span>Catalog</span>
                            </a>
                        </li>

                        @if (session('user')->isAdmin)
                          <li class="sidebar-item">
                              <a href="{{ route('product') }}" class="sidebar-link">
                                  <i class="bi bi-inboxes-fill"></i>
                                  <span>Product</span>
                              </a>
                          </li>
                          <li class="sidebar-item">
                              <a href="{{ route('category') }}" class="sidebar-link">
                                  <i class="bi bi-stickies-fill"></i>
                                  <span>Category</span>
                              </a>
                          </li>
                          <li class="sidebar-item">
                              <a href="{{ route('user') }}" class="sidebar-link">
                                  <i class="bi bi-people-fill"></i>
                                  <span>Users</span>
                              </a>
                          </li>
                          <li class="sidebar-item">
                              <a href="{{ route('sales') }}" class="sidebar-link">
                                  <i class="bi bi-clipboard-check-fill"></i>
                                  <span>Sales</span>
                              </a>
                          </li>

                        @else
                          <li class="sidebar-item">
                              <a href="{{ route('cart') }}" class="sidebar-link">
                                  <i class="bi bi-basket-fill"></i>
                                  <span>Cart</span>
                              </a>
                          </li>
                          <li class="sidebar-item">
                              <a href="{{ route('order') }}" class="sidebar-link">
                                  <i class="bi bi-clipboard-check-fill"></i>
                                  <span>Order History</span>
                              </a>
                          </li>
                        @endif

                    </ul>
                </div>
            </div>
        </div>

        <div id="main" class="layout-navbar">

            <header class="mb-3">
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
                                <li class="nav-item dropdown me-3">
                                    <a class="nav-link active text-gray-600" href="{{ route('cart') }}"
                                        data-bs-display="static" aria-expanded="false">
                                        <i class="bi bi-cart-check fs-2"></i>
                                    </a>
                                </li>
                            </ul>
                            <div class="dropdown">
                                <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="user-menu d-flex">
                                        <div class="user-name text-end me-3">
                                            <h6 class="mb-0 text-gray-600">{{ session('user')->name }}</h6>
                                            @if (session('user')->isAdmin == 1)
                                                <p class="mb-0 text-sm text-gray-600">Admin</p>
                                            @else
                                                <p class="mb-0 text-sm text-gray-600">User</p>
                                            @endif
                                        </div>
                                        <div class="user-img d-flex align-items-center">
                                            <div class="avatar avatar-md">
                                                <img src="{{ asset('assets/images/faces/1.jpg') }}" />
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton"
                                    style="min-width: 11rem">
                                    <li>
                                        <h6 class="dropdown-header">Hello, {{ session('user')->name }}</h6>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('profile') }}"><i
                                                class="icon-mid bi bi-person me-2"></i> My Profile</a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider" />
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}">
                                            <i class="icon-mid bi bi-box-arrow-left me-2"></i>Logout
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
            </header>

            <div id="main-content">

                <div class="page-heading">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-12 col-md-6 order-md-1 order-last">
                                <h3>@yield('pages')</h3>
                                <p class="text-subtitle text-muted">@yield('description')</p>
                            </div>
                        </div>
                    </div>

                    @yield('content')

                </div>

                <footer>
                    <div class="footer clearfix mb-0 text-muted">
                        <div class="float-start">
                            <p>2024 &copy; JNF All right reserved</p>
                        </div>
                        <div class="float-end">
                            <p>
                                Made with
                                <span class="text-danger"><i class="bi bi-heart-fill icon-mid"></i></span>
                                by <a href="#">JNF</a>
                            </p>
                        </div>
                    </div>
                </footer>

            </div>

        </div>
    </div>
    <script src="{{ asset('assets/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/extensions/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/js/pages/simple-datatables.js') }}"></script>

</body>

</html>
