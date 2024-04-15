{{-- <div class="main-menu d-none d-md-block">
    
    <nav class="text-center">
        <ul id="">
            <li><a href="{{ route('newsFront.index') }}">Trang chủ</a></li>
            <li><a href="{{route('categories-news')}}">Danh mục</a>
                <ul class="submenu">
                    @foreach ($categories_news as $category)
                        <li class="nav-item">
                            <a href="">{{ $category->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </li>
            <li><a href="{{ route('newsFront.index', ['slug'=>1]) }}">Tin ngoài nước</a></li>
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
                            
                            @endif

                            {{-- <a class="nav-link"
                                href="{{ route('tin.category', ['idTL' => $tl->id]) }}">{{ $tl->category_nm }}</a> --}}
                        {{-- </li> --}}
                    {{-- </ul>
                </li>        
            @endif
        </ul>
    </nav>

</div> --}}
{{-- </div>
<div class="col-xl-2 col-lg-2 col-md-4">
    <div class="header-right-btn f-right d-none d-lg-block">
        <i class="fas fa-search special-tag"></i>
        <div class="search-box">
            <form action="#">
                <input type="text" placeholder="Search">

            </form>
        </div>
    </div>
</div>
<!-- Mobile Menu -->
<div class="col-12">
    <div class="mobile_menu d-block d-md-none"></div>
</div>  --}}


