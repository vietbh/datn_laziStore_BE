<!doctype html>
<html lang="vi">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Lazi Store Tech</title>
        <meta name="description" content="Trang thông tin về công nghệ">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {{-- <link rel="manifest" href="site.webmanifest"> --}}
		{{-- <link rel="shortcut icon" type="image/x-icon" href="news/assets/assets/img/favicon.ico"> --}}

		<!-- CSS here -->
        <link href="{{ asset('news/assets/assets/css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('news/assets/assets/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('news/assets/assets/css/owl.carousel.min.css') }}" rel="stylesheet">
        <link href="{{ asset('news/assets/assets/css/ticker-style.css') }}" rel="stylesheet">
        <link href="{{ asset('news/assets/assets/css/flaticon.css') }}" rel="stylesheet">
        <link href="{{ asset('news/assets/assets/css/slicknav.css') }}" rel="stylesheet">
        <link href="{{ asset('news/assets/assets/css/animate.min.css') }}" rel="stylesheet">
        <link href="{{ asset('news/assets/assets/css/magnific-popup.css') }}" rel="stylesheet">
        <link href="{{ asset('news/assets/assets/css/fontawesome-all.min.css') }}" rel="stylesheet">
        <link href="{{ asset('news/assets/assets/css/themify-icons.css') }}" rel="stylesheet">
        <link href="{{ asset('news/assets/assets/css/slick.css') }}" rel="stylesheet">
        <link href="{{ asset('news/assets/assets/css/nice-select.css') }}" rel="stylesheet">
           
   </head>

   <body>
       
    <!-- Preloader Start -->
     {{-- <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="{{asset('upload/images/Logo-Tinh-Ba-Ria-Vung-Tau.png')}}" width="60" height="60" alt="">
                    
                </div>
            </div>
        </div>
    </div>  --}}
    <!-- Preloader Start -->

    <header style="min-height: 15vh">
        <!-- Header Start -->
       <div class="header-area">
            <div class="main-header ">
                <div class="header-top black-bg d-none d-md-block  ">
                   <div class="container">
                       <div class="col-xl-12">
                            <div class="row d-flex justify-content-between align-items-center">
                                <div class="header-info-left">
                                    <ul>     
                                        {{-- <li><img src="{{asset('news/assets/assets/img/icon/header_icon1.png')}}" alt="">27ºc, Sunny </li> --}}
                                        <li><img src="{{asset('news/assets/assets/img/icon/header_icon2.png')}}" alt=""><script>document.write(new Date().toLocaleString());</script></li>
                                    </ul>
                                </div>
                                <div class="header-info-right">
                                    <ul class="header-social">    
                                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                       <li> <a href="#"><i class="fab fa-pinterest-p"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                       </div>
                   </div>
                </div>
                <div class="header-mid d-none d-md-block">
                   <div class="container">
                        <div class="row d-flex align-items-center py-3">
                            <!-- Logo -->
                            <div class="col-xl-3 col-lg-3 col-md-3">
                                <div class="logo">
                                    <a 
                                    class="text-decoration-none" href="{{ route('fe.news.index') }}">
                                        {{-- <img src="{{asset('news/assets/upload/images/Logo-Tinh-Ba-Ria-Vung-Tau.png')}}" width="50" height="50"> --}}
                                        <h4 class="text-secondary text-uppercase my-2" style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif; font-size: 32px;line-height: 0.8rem;">Lazi Store</h4>
                                        <p class="m-0" style="font-size: 12px;">Trang tin công nghệ của cửa hàng Lazi Store</p>
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-9 col-lg-9 col-md-9">
                                <nav class="navbar navbar-light ">
                                    <div class="container-fluid">
                                        <form action="{{ route('fe.news.search') }}" class="row w-100 g-0">
                                            <div class="col-lg-12 d-flex">
                                                <textarea name="search"
                                                class="form-control w-100" style="border-radius: 15px;" rows="1" wrap="hard" type="search" placeholder="Tìm kiếm tin tức" aria-label="Search">{{ request()->query('search') }}</textarea>
                                                <button class="genric-btn danger-border border-0 circle arrow ml-1" type="submit"><i class="fas fa-search"></i></button>
                                            </div>
                                        </form>
                                    </div>
                                </nav>
                                {{-- <div class="header-banner f-right ">
                                    <img src="{{ asset('news/assets/assets/img/hero/header_card.jpg') }}" alt="">
                                </div> --}}
                            </div>
                        </div>
                      
                   </div>
                </div>
               {{-- <div class="header-bottom header-sticky">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-xl-9 col-lg-9 col-md-12 header-flex">
                                <!-- sticky -->
                                    <div class="sticky-logo">
                                        <a  href="{{ route('fe.news.index') }}">
                                            <h4 class="text-secondary text-uppercase mb-1" style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif; font-size: 32px;">Lazi Store</h4>
                                            <p class="m-0" style="font-size: 12px;">Trang tin công nghệ của cửa hàng Lazi Store</p>
                                        </a>
                                    </div>
                                <!-- Main-menu -->
                                    @include('FrontEnd.part.nav')
                         </div>
                    </div>
               </div> --}}
            </div>
       </div>
        <!-- Header End -->
    </header>
<main>
    @yield('content')
</main>
    
    <footer>
       <!-- Footer Start-->
       <div class="footer-area footer-padding fix">
            <div class="container">
                <div class="row d-flex justify-content-between">
                    <div class="col-xl-5 col-lg-5 col-md-7 col-sm-12">
                        <div class="single-footer-caption">
                            <div class="single-footer-caption">
                                <!-- logo -->
                                <div class="footer-logo">
                                    <h4 class="text-secondary text-uppercase mb-1" style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif; font-size: 32px;">Lazi Store</h4>
                                    <p class="m-0" style="font-size: 12px;">Trang tin công nghệ của cửa hàng Lazi Store</p>
                                </div>
                                <div class="footer-tittle">
                                    <div class="footer-pera">
                                        {{-- <p>Suscipit mauris pede for con sectetuer sodales adipisci for cursus fames lectus tempor da blandit gravida sodales  Suscipit mauris pede for con sectetuer sodales adipisci for cursus fames lectus tempor da blandit gravida sodales  Suscipit mauris pede for sectetuer.</p> --}}
                                    </div>
                                </div>
                                <!-- social -->
                                <div class="footer-social">
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                    <a href="#"><i class="fab fa-instagram"></i></a>
                                    <a href="#"><i class="fab fa-pinterest-p"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4  col-sm-6">
                        <div class="single-footer-caption mt-60">
                            <div class="footer-tittle">
                                <h4>Newsletter</h4>
                                <p>Heaven fruitful doesn't over les idays appear creeping</p>
                                <!-- Form -->
                                <div class="footer-form" >
                                    <div id="mc_embed_signup">
                                        <form target="_blank" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01"
                                        method="get" class="subscribe_form relative mail_part">
                                            <input type="email" name="email" id="newsletter-form-email" placeholder="Email Address"
                                            class="placeholder hide-on-focus" onfocus="this.placeholder = ''"
                                            onblur="this.placeholder = ' Email Address '">
                                            <div class="form-icon">
                                            <button type="submit" name="submit" id="newsletter-submit"
                                            class="email_icon newsletter-submit button-contactForm"><img src="news/assets/assets/img/logo/form-iocn.png" alt=""></button>
                                            </div>
                                            <div class="mt-10 info"></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-5 col-sm-6">
                        <div class="single-footer-caption mb-50 mt-60">
                            <div class="footer-tittle">
                                <h4>Map</h4>
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15673.878191566528!2d106.67631391966556!3d10.851846754502919!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m3!3e0!4m0!4m0!5e0!3m2!1svi!2s!4v1691591901915!5m2!1svi!2s" width="350" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       <!-- footer-bottom aera -->
       <div class="footer-bottom-area">
           <div class="container">
               <div class="footer-border">
                    <div class="row d-flex align-items-center justify-content-between">
                        <div class="col-lg-6">
                            <div class="footer-copy-right">
                                <p>
                                    Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="ti-heart" aria-hidden="true"></i> by <a href="#" target="_blank">BH_Ix5</a>
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="footer-menu f-right">
                                <ul>                             
                                    <li><a href="#">Chính sách</a></li>
                                    <li><a href="#">Điều khoản sử dụng</a></li>
                                    <li><a href="#">Liên hệ</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
               </div>
           </div>
       </div>
       <!-- Footer End-->
   </footer>
   
	<!-- JS here -->
	
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