<!doctype html>
<html lang="vi">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Trang tin tức🆕 Lazi Store Page</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {{-- <link rel="manifest" href="site.webmanifest"> --}}
		<link rel="shortcut icon" type="image/x-icon" href="news/assets/assets/img/favicon.ico">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        
        
        <!-- CSS here -->
        {{-- <link href="{{ asset('news/assets/assets/css/themify-icons.css') }}" rel="stylesheet"> 
        <link href="{{ asset('news/assets/assets/css/style.css') }}" rel="stylesheet"> 
        <link href="{{ asset('news/assets/assets/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('news/assets/assets/css/owl.carousel.min.css') }}" rel="stylesheet">
        <link href="{{ asset('news/assets/assets/css/ticker-style.css') }}" rel="stylesheet">
        <link href="{{ asset('news/assets/assets/css/flaticon.css') }}" rel="stylesheet">
        <link href="{{ asset('news/assets/assets/css/slicknav.css') }}" rel="stylesheet">
        <link href="{{ asset('news/assets/assets/css/animate.min.css') }}" rel="stylesheet">
        <link href="{{ asset('news/assets/assets/css/magnific-popup.css') }}" rel="stylesheet">
        <link href="{{ asset('news/assets/assets/css/fontawesome-all.min.css') }}" rel="stylesheet">
        <link href="{{ asset('news/assets/assets/css/slick.css') }}" rel="stylesheet">
        <link href="{{ asset('news/assets/assets/css/nice-select.css') }}" rel="stylesheet">  --}}

   </head>
   <body>
        @include('FrontEnd.part.Header')
        <main>
            @yield('content')
        </main>
         @include('FrontEnd.part.Footer')

		<!-- All JS Custom Plugins Link Here here -->
        <script src="{{ asset('news/assets/assets/js/vendor/modernizr-3.5.0.min.js') }}" ></script>
        {{-- <script src="news/assets/assets/js/vendor/modernizr-3.5.0.min.js"></script> --}}
		<!-- Jquery, Popper, Bootstrap -->
        <script src="{{ asset('news/assets/assets/js/vendor/jquery-1.12.4.min.js') }}" ></script>
        <script src="{{ asset('news/assets/assets/js/popper.min.js') }}" ></script>
        <script src="{{ asset('news/assets/assets/js/bootstrap.min.js') }}" ></script>
	    <!-- Jquery Mobile Menu -->
        <script src="{{ asset('news/assets/assets/js/jquery.slicknav.min.js') }}" ></script>
        {{-- <script src="news/assets/assets/js/jquery.slicknav.min.js"></script> --}}
        
		<!-- Jquery Slick , Owl-Carousel Plugins -->
        <script src="{{ asset('news/assets/assets/js/owl.carousel.min.js') }}" ></script>
        <script src="{{ asset('news/assets/assets/js/slick.min.js') }}" ></script>
        <!-- Date Picker -->
        <script src="{{ asset('news/assets/assets/js/gijgo.min.js') }}" ></script>
		<!-- One Page, Animated-HeadLin -->
        <script src="{{ asset('news/assets/assets/js/wow.min.js') }}" ></script>
        <script src="{{ asset('news/assets/assets/js/animated.headline.js') }}" ></script>
        <script src="{{ asset('news/assets/assets/js/jquery.magnific-popup.js') }}" ></script>
        <!-- Breaking New Pluging -->
        <script src="{{ asset('news/assets/assets/js/jquery.ticker.js') }}" ></script>
        <script src="{{ asset('news/assets/assets/js/site.js') }}" ></script>
		<!-- Scrollup, nice-select, sticky -->
        <script src="{{ asset('news/assets/assets/js/jquery.scrollUp.min.js') }}" ></script>
        <script src="{{ asset('news/assets/assets/js/jquery.nice-select.min.js') }}" ></script>
        <script src="{{ asset('news/assets/assets/js/jquery.sticky.js') }}" ></script>
        <!-- contact js -->
        <script src="{{ asset('news/assets/assets/js/contact.js') }}" ></script>
        <script src="{{ asset('news/assets/assets/js/jquery.form.js') }}" ></script>
        <script src="{{ asset('news/assets/assets/js/jquery.validate.min.js') }}" ></script>
        <script src="{{ asset('news/assets/assets/js/mail-script.js') }}" ></script>
        <script src="{{ asset('news/assets/assets/js/jquery.ajaxchimp.min.js') }}" ></script>
		<!-- Jquery Plugins, main Jquery -->	
        <script src="{{ asset('news/assets/assets/js/plugins.js') }}" ></script>
        <script src="{{ asset('news/assets/assets/js/main.js') }}" ></script>
    </body>
</html>