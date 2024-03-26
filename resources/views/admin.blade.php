<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>Trang quản trị - Lazi Store</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="DASHMIN - Lazi Store" name="description">
    <meta content="csrf_token" name="{{ csrf_token() }}">
    <!-- Favicon -->
    <link href="{{ asset('favicon.ico') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="{{ url('https://fonts.gstatic.com') }} " crossorigin>
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href='{{ asset("lib/owlcarousel/assets/owl.carousel.min.css") }}' rel="stylesheet">
    <link href="{{ asset('lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    {{-- Multiple Select --}}
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
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
        @include('layouts.admin.Header.sideBar')
        <!-- Sidebar End -->
        
        <!-- Content Start -->
        <div class="content">
            @if (session('success') && session('error') || session('success'))
                @include('layouts.admin.components.alert')
            @endif   
            @include('layouts.admin.Header.nav')   
            
            @yield('content')

            <!-- Footer Start -->
            @include('layouts.admin.components.Footer')
            <!-- Footer End -->
        </div>
        <!-- Content End -->
        <!-- Back to Top -->
        <button id="scrollToTop" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></button>
    </div>
</body>
    @yield('modal')
    <!-- JavaScript Libraries -->
    <script src="{{ url('https://code.jquery.com/jquery-3.4.1.min.js') }} "></script>
    <script src="{{ asset('lib/chart/chart.min.js') }}"></script>
    <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    {{-- Text editor --}}
    <script src="{{ asset('ckeditor5-build-classic/ckeditor.js') }}"></script>
    <!-- Template Javascript -->
    <script src="{{ asset('js/main.js') }}"></script>
    {{-- Multiple Select --}}
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
    <script type="module">
       setTimeout(() => {
            let alerts = document.getElementsByClassName('alert');
            for (let i = 0; i < alerts.length; i++) {
                let bsAlert = new bootstrap.Alert(alerts[i]);
                bsAlert.close();
            }
        }, 2000);
    </script>
    @yield('js')
</html>