<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>DASHMIN - Lazi Store</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="{{ asset('favicon.ico') }}" rel="icon">

    <!-- Google Web Fonts -->
    {{-- <link rel="preconnect" href="{{ url('https://fonts.googleapis.com') }}"> --}}
    <link rel="preconnect" href="{{ url('https://fonts.gstatic.com') }} " crossorigin>
    {{-- <link href="{{ url('https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap') }}" rel="stylesheet"> --}}
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href='{{ asset("lib/owlcarousel/assets/owl.carousel.min.css") }}' rel="stylesheet">
    <link href="{{ asset('lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">


</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Đang tải...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="index.html" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-secondary"></i>LAZI-STORE</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="{{ asset('img/user.jpg') }}" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-danger rounded-circle border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">{{ Auth::user()->name }}</h6>
                        <span>Admin</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
             
                    <a href="{{ route('home') }}" class="nav-item nav-link {{request()->routeIs('home') == 1 ? 'active':''}}"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <a href="chart.html" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Thống kê</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle 
                        {{request()->routeIs('product.cat.index') 
                        || request()->routeIs('product.index')
                        || request()->routeIs('brand.index')
                        == 1 ? 'active':''}} " data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Sản phẩm</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="{{ route('brand.index') }}" class="dropdown-item {{request()->routeIs('brand.index') == 1 ? 'active':''}}">Thương hiệu</a>
                            <a href="{{ route('product.cat.index') }}" class="dropdown-item {{request()->routeIs('product.cat.index') == 1 ? 'active':''}}">Danh mục</a>
                            <a href="{{ route('product.index') }}" class="dropdown-item {{request()->routeIs('product.index') == 1 ? 'active':''}}">Sản phẩm</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle 
                        {{request()->routeIs('news.cat.index')==1 
                        || request()->routeIs('news.tag.index') == 1
                        || request()->routeIs('news.index') == 1 ? 'active':''}}
                        " data-bs-toggle="dropdown"><i class="fa fa-newspaper me-2"></i>Tin tức</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="{{ route('news.cat.index') }}" class="dropdown-item {{request()->routeIs('news.cat.index') == 1 ? 'active':''}}">Danh mục</a>
                            <a href="{{ route('news.tag.index') }}" class="dropdown-item {{request()->routeIs('news.tag.index') == 1 ? 'active':''}}">Tag</a>
                            <a href="{{ route('news.index') }}" class="dropdown-item {{request()->routeIs('news.index') == 1 ? 'active':''}}">Tin tức</a>
                        </div>
                    </div>
                    {{-- <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle 
                        {{request()->routeIs('cat.news')==1 || request()->routeIs('news') == 1 ? 'active':''}}
                        " data-bs-toggle="dropdown"><i class="fa-regular fa-newspaper"></i>Tin tức</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="{{ route('news.cat.index') }}" class="dropdown-item {{request()->routeIs('news.cat.index') == 1 ? 'active':''}}">Danh mục</a>
                            <a href="{{ route('news.index') }}" class="dropdown-item {{request()->routeIs('news.index') == 1 ? 'active':''}}">Tin tức</a>
                        </div>
                    </div> --}}
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->
        
        <!-- Content Start -->
        <div class="content">
            @include('layouts.admin.nav')   
            
            @yield('content')

            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="#">Lazi-Store</a>, Cửa hàng bán thiết bị công nghệ. 
                        </div>
                        <div class="col-12 col-sm-6 text-center text-sm-end">
                            <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                            Phát triển bởi <a href="vietbh.github.io/lazi-store">Lazi Team</a>
                        </br>
                        {{-- Distributed By <a class="border-bottom" href="https://themewagon.com" target="_blank">ThemeWagon</a> --}}
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End -->
        </div>
        <!-- Content End -->
        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>
    
    <!-- JavaScript Libraries -->
    <script src="{{ url('https://code.jquery.com/jquery-3.4.1.min.js') }} "></script>
    <script src="{{ url('https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('lib/chart/chart.min.js') }}"></script>
    <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    {{-- Text editor --}}
    <script src="{{ url('https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js') }}"></script>
    <!-- Template Javascript -->
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>