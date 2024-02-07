<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>Trang đăng nhập - Lazi Store</title>
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
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sign In Start -->
        <div class="container-fluid">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
            <form method="POST" action="{{ route('login') }}">
                <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;height: auto;">
                    @csrf
                    <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                        <div class="bg-light rounded-2 p-4 p-sm-5 my-4 mx-3">
                            <div class="text-center mb-3">
                                <h3 class="text-primary">Đăng nhập Admin</h3>
                                <p>Lazi-Store</p>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" name="email" value="{{old('email')}}" placeholder="Tài khoản quản trị">
                                <label for="floatingInput">Email hoặc tên quản trị</label>
                                <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" style="font-size: 14px"/>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
                                <label for="floatingPassword">Mật khẩu</label>
                                <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" style="font-size: 14px" />
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="form-check">
                                    <input type="checkbox" name="remember" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Lưu đăng nhập</label>
                                </div>
                            </div>
                            <div class="mb-4">
                                <p class="text-center text-danger" style="font-size: 15px">
                                    @foreach ($errors->get('login') as $error)
                                        {{$error}}
                                    @endforeach
                                </p>
                            </div>
                            <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Đăng nhập</button>
                            <div class="flex items-center justify-end mb-4">
                                {{-- @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="pr-4 underline text-sm font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                                        {{ __('Chưa có tài khoản') }}
                                    </a>
                                @endif --}}
                               
                                @if (Route::has('password.request'))
                                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                                        {{ __('Quên mật khẩu?') }}
                                    </a>
                                @endif                    
                            </div>
                    
                        </div>
                    </div>
                </div>
                </form>
        </div>
        <!-- Sign In End -->
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