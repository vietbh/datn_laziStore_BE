{{-- <header>
    <!-- Header Start -->
   <div class="header-area">
        <div class="main-header ">
            <div class="header-top black-bg d-none d-md-block">
               <div class="container">
                   <div class="col-xl-12">
                        <div class="row d-flex justify-content-between align-items-center">
                            <div class="header-info-left">
                                <ul>     
                                    <li><img src="{{asset('news/assets/assets/img/icon/header_icon1.png')}}" alt=""><script>document.write(new Date().toLocaleString());</script></li>
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
                    <div class="row d-flex align-items-center">
                        <!-- Logo -->
                        <div class="col-xl-3 col-lg-3 col-md-3">
                            <div class="logo ">
                                <a class="d-flex align-items-center text-decoration-none" href="{{ route('newsFront.index') }}">
                                        <img src="{{asset('news/assets/upload/images/logo.png')}}" width="50" height="50">
                                        <h4 class="text-secondary text-bolder ">Lazi Store</h4>
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-9 col-lg-9 col-md-9">
                            <div class="main-menu d-none d-md-block">
                                <nav class="text-center">
                                    <ul id="">
                                        <li><a href="{{ route('newsFront.index') }}">Trang chủ</a></li>
                                        {{-- <li><a href="{{route('categories-news')}}">Danh mục</a>
                                            <ul class="submenu">
                                                @foreach ($categories_news as $category)
                                                    <li class="nav-item">
                                                        <a href="">{{ $category->name }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li> --}}
                                        {{-- <li><a href="{{ route('newsFront.index', ['slug'=>1]) }}">Tin ngoài nước</a></li>
                                        <li><a href="latest_news.html">Tin buôn bán</a></li>
                                        <li><a href="contact.html">Dịch vụ</a></li>
                                        @if (Auth::check())
                                            <li><a href="#" class="truncate">Xin chào {{ Auth::user()->name }}</a>
                                                <ul class="submenu">
                                                    @if (Route::has('login'))
                                                            @auth               
                                                                    <li class="nav-item"> 
                                                                        <a href="{{ route('profile.edit') }}">Thông tin cá nhân</a>
                                                                    </li>
                                                                    @if (Auth::user()->role === 0)
                                                                    <li class="nav-item"> 
                                                                        <a href="{{ url('/admin') }}">Admin</a>
                                                                    </li>
                                                                    @endif
                                                                    <form  style="width: 163px;height: 33px;" method="POST" action="{{ route('logout') }}">
                                                                        @csrf
                                                                            <a class="my-0 ml-2 pl-1 py-1"  href="route('logout')"
                                                                                    onclick="event.preventDefault();
                                                                                                this.closest('form').submit();">
                                                                                {{ __('Đăng xuất') }}
                                                                            </a>
                                                                    </form>
                                                            @endauth
                                                    
                                                    @endif
                                                </li>
                                            </ul>
                                        @else
                                            <li><a href="#">Tài khoản</a>
                                                <ul class="submenu">
                                                    <li class="nav-item">
                                                        @if (Route::has('login'))
                                                                @auth
                                                                    <a href="{{ url('/dashboard') }}"class="">Dashboard</a>
                                                                @else
                                                                    <a href="{{ route('login') }}"class="">Đăng nhập</a>
                                                                    @if (Route::has('register'))
                                                                        <a href="{{ route('register') }}"class="">Đăng kí</a>
                                                                    @endif
                                                                @endauth
                                                        
                                                        @endif --}}
                            
                                                        {{-- <a class="nav-link"
                                                            href="{{ route('tin.category', ['idTL' => $tl->id]) }}">{{ $tl->category_nm }}</a> --}}
                                                    {{-- </li>
                                                </ul>
                                            </li>        
                                        @endif
                                    </ul>
                                </nav>
                            
                            </div>
                            
                        </div>
                    </div>
               </div>
            </div>
           <div class="header-bottom header-sticky">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-10 col-lg-10 col-md-12 header-flex">
                            <!-- sticky -->
                                {{-- <div class="sticky-logo">
                                    <a href="{{ route('newsFront.index') }}">
                                        <img src="{{asset('news/assets/upload/images/Logo-Tinh-Ba-Ria-Vung-Tau.png')}}" width="50" height="50" alt="">
                                        <h4 class="text-secondary text-bolder" href="">Lazi Store</h4>
                                    </a> --}}
                                </div>
                            <!-- Main-menu -->
                                @include('FrontEnd.part.nav')
                     </div>
                </div>
           {{-- </div>
        </div>
   </div>  
    <!-- Header End -->
</header> --}}
{{-- <div class="container">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
      <div class="col-md-3 mb-2 mb-md-0">
        <a href="{{ route('newsFront.index') }}" class="d-flex align-items-center text-decoration-none">
            <img src="{{url('img/logo.png')}}" width="40" height="40">
            <h4 class="text-secondary text-bolder">Lazi News</h4>
        </a>
      </div>
      <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
        <li><a href="{{route('newsFront.index')}}" class="nav-link px-2 link-secondary">Trang chủ</a></li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle link-secondary" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Danh mục
            </a>
            <ul class="dropdown-menu">
                @foreach ($categories_news as $category)
              <li><a class="dropdown-item" href="">{{ $category->name }}</a></li>
              @endforeach
            </ul>
        </li>
        <li><a href="{{ route('newsFront.index', ['slug'=>1]) }}" class="nav-link px-2 link-secondary">Tin ngoài nước</a></li>
        @if (Auth::check())
        <li class="nav-item dropdown list-unstyled">
            <a class="nav-link dropdown-toggle " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Xin chào {{ Auth::user()->name }}</a>
            <ul class="dropdown-menu list-unstyled">
                @if (Route::has('login'))
                        @auth               
                            <li class="nav-item dropdown"> 
                                    <a href="{{ route('profile.edit') }}" class="dropdown-item btn">Thông tin</a>
                                @if (Auth::user()->role === 0)
                                @endif
                                <li>
                                     <form style="" method="POST" action="{{ route('logout') }}">
                                    @csrf
                                        <button class="dropdown-items  btn btn-white"
                                                onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                            {{ __('Đăng xuất') }}
                                            </button>
                                    </form>
                                </li>
                            </li>
                        @endauth
                
                @endif
            </li>
        </ul>
    @else --}}
    {{-- <ul class="list-unstyled">
        <li class="list-unstyled">
            <a href="#" class="">Tài khoản</a>
            <ul class="submenu list-unstyled">
                <li class="nav-item">
                    @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}"class="nav-link px-2 link-secondary">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}"class="nav-link px-2 link-secondary">Đăng nhập</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}"class="nav-link px-2 link-secondary">Đăng kí</a>
                                @endif
                            @endauth
                    @endif --}}
                    {{-- <a class="nav-link"
                        href="{{ route('tin.category', ['idTL' => $tl->id]) }}">{{ $tl->category_nm }}</a> --}}
                {{-- </li>
            </ul>
        </li>   
    </ul>      --}}
    {{-- <div class="dropdown">
        <a class="dropdown-toggle nav-link px-2 link-secondary" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Tài khoản</a>
        <ul class="dropdown-menu">
            @if(Route::has('login'))
            @auth
                <a class="dropdown-item" href="{{url('/dashboard')}}">Dashboard</a>
            @else
                <a class="dropdown-item" href="{{route('login')}}">Đăng nhập</a>
            @if(Route::has('register'))
                <a class="dropdown-item" href="{{route('register')}}">Đăng ký</a>
            @endif
          @endauth
          @endif
        </ul>
      </div>
    @endif
      </ul>
    </header>
  </div> --}}
  <!--Main Navigation-->
<header>
    <!-- Jumbotron -->
    <div class="p-3 text-center bg-white border-bottom">
      <div class="container">
        <div class="row">
          <!-- Left elements -->
          <div class="col-md-4 d-flex justify-content-center justify-content-md-start mb-3 mb-md-0">
            <a href="{{ route('newsFront.index') }}" class="ms-md-2 d-flex" style="text-decoration: none;">
              <img src="{{url('img/logo.png')}}" height="35" /><h2 class="text-danger">Lazi News</h2>
            </a>
          </div>
          <!-- Left elements -->
  
          <!-- Center elements -->
          <div class="col-md-4">
            <form class="d-flex input-group w-auto my-auto mb-3 mb-md-0">
              <input autocomplete="off" type="search" class="form-control rounded" placeholder="Search" />
              <span class="input-group-text border-0 d-none d-lg-flex"><i class="bi bi-search"></i></span>
            </form>
          </div>
          <!-- Center elements -->
  
          <!-- Right elements -->
          <div class="col-md-4 d-flex justify-content-center justify-content-md-end align-items-center">
            <div class="d-flex">
              <!-- Notification -->
              <div class="dropdown">
                <a class="text-reset me-3 dropdown-toggle hidden-arrow" href="#" id="navbarDropdownMenuLink"
                  role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                  <i class="bi bi-bell-fill"></i>
                </a>
              </div>
              <!-- User -->

            </div>
          </div>
          <!-- Right elements -->
        </div>
      </div>
    </div>
    <!-- Jumbotron -->
  
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
      <!-- Container wrapper -->
      <div class="container justify-content-center justify-content-md-between">
        <!-- Left links -->
        <ul class="navbar-nav flex-row">
          <li class="nav-item me-2 me-lg-0">
            <a class="nav-link" href="{{ route('newsFront.index') }}" role="button" data-mdb-toggle="sidenav" data-mdb-target="#sidenav-1"
              class="btn shadow-0 p-0 me-3" aria-controls="#sidenav-1" aria-haspopup="true">
              <i class="bi bi-list"></i>
              <span>Trang chủ</span>
            </a>
          </li>
          <li class="nav-item dropdown me-2 me-lg-0 d-none d-md-inline-block">
            <a class="nav-link dropdown-toggle link-secondary" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Danh mục
            </a>
            <ul class="dropdown-menu">
                @foreach ($categories_news as $category)
              <li><a class="dropdown-item" href="">{{ $category->name }}</a></li>
              @endforeach
            </ul>
        </li>
          <li class="nav-item me-2 me-lg-0 d-none d-md-inline-block">
            <a class="nav-link" href="{{ route('newsFront.index', ['slug'=>1]) }}">Tin ngoài nước</a>
          </li>
          @if (Auth::check())
          <li class="nav-item dropdown me-2 me-lg-0 d-none d-md-inline-block">
              <a class="nav-link dropdown-toggle " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Xin chào {{ Auth::user()->name }}</a>
              <ul class="dropdown-menu list-unstyled">
                  @if (Route::has('login'))
                          @auth               
                              <li class="nav-item dropdown"> 
                                      <a href="{{ route('profile.edit') }}" class="dropdown-item btn">Thông tin</a>
                                  @if (Auth::user()->role === 0)
                                  @endif
                                  <li>
                                       <form style="" method="POST" action="{{ route('logout') }}">
                                      @csrf
                                          <button class="dropdown-items  btn btn-white"
                                                  onclick="event.preventDefault();
                                                              this.closest('form').submit();">
                                              {{ __('Đăng xuất') }}
                                              </button>
                                      </form>
                                  </li>
                              </li>
                          @endauth
                  
                  @endif
              </li>
            </ul>
            @else 
            <ul class="navbar-nav flex-row">
                <li class="nav-item me-2 me-lg-0">
                    <a href="#" class="nav-link">Tài khoản</a>
                    <ul class="submenu list-unstyled">
                        <li class="nav-item">
                            {{-- @if (Route::has('login'))
                                    @auth
                                    @else
                                        <a href="{{ route('login') }}"class="nav-item me-2 me-lg-0">Đăng nhập</a>
                                        @if (Route::has('register'))
                                            <a href="{{ route('register') }}"class="nav-item me-2 me-lg-0">Đăng kí</a>
                                        @endif
                                    @endauth
                            @endif  --}}
                            {{-- <a class="nav-link"
                                href="{{ route('tin.category', ['idTL' => $tl->id]) }}">{{ $tl->category_nm }}
                            </a>  --}}
                         </li>
                    </ul>
                </li>   
            </ul>      
            <div class="dropdown">
                <a class="dropdown-toggle nav-link px-2 link-secondary" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Tài khoản</a>
                <ul class="dropdown-menu">
                    @if(Route::has('login'))
                    @auth
                        <a class="dropdown-item" href="{{url('/dashboard')}}">Dashboard</a>
                    @else
                        <a class="dropdown-item" href="{{route('login')}}">Đăng nhập</a>
                    @if(Route::has('register'))
                        <a class="dropdown-item" href="{{route('register')}}">Đăng ký</a>
                    @endif
                  @endauth
                  @endif
                </ul>
              </div>
            @endif
        </ul>

        <button class="btn btn-outline-primary" data-mdb-ripple-color="dark" type="button">
          Download app<i class="fas fa-download ms-2"></i>
        </button>
      </div>
      <!-- Container wrapper -->
    </nav>
    <!-- Jumbotron -->
  </header>
  <!--Main Navigation-->