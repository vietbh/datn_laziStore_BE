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
            <a href="{{ route('chart.index') }}" class="nav-item nav-link {{request()->routeIs('chart.index') == 1 ? 'active':''}}"><i class="fa fa-chart-bar me-2"></i>Thống kê</a>
            <a href="{{ route('guest.index') }}" class="nav-item nav-link {{request()->routeIs('guest.index') == 1 ? 'active':''}}"><i class="fas fa-users me-2"></i>Khách hàng</a>
            <a href="{{ route('payment.index') }}" class="nav-item nav-link {{request()->routeIs('payment.index') == 1 ? 'active':''}}"><i class="fas fa-cash-register me-2"></i>Đơn hàng</a>
            <a href="{{ route('hot.index') }}" class="nav-item nav-link {{request()->routeIs('hot.index') == 1 ? 'active':''}}"><i class="fa fa-fire me-2"></i>Sản phẩm hot</a>
            <a href="{{ route('discount.index') }}" class="nav-item nav-link {{request()->routeIs('discount.index') == 1 ? 'active':''}}"><i class="fa fa-ticket-alt me-2"></i>Mã giảm giá</a>
            <a href="{{ route('delivery.index') }}" class="nav-item nav-link {{request()->routeIs('delivery.index') == 1 ? 'active':''}}"><i class="fa fa-truck me-2"></i>Vận chuyển</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle 
                {{request()->routeIs('comment.product.index') 
                || request()->routeIs('comment.news.index')
                == 1 ? 'active':''}} " data-bs-toggle="dropdown"><i class="fa fa-comments me-2"></i>Bình luận</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="{{ route('comment.product.index') }}" class="dropdown-item {{request()->routeIs('comment.product.index') == 1 ? 'active':''}}">Bình luận sản phẩm</a>
                    <a href="{{ route('comment.news.index') }}" class="dropdown-item {{request()->routeIs('comment.news.index') == 1 ? 'active':''}}">Bình luận tin tức</a>
                </div>
            </div>
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
            <a href="{{ route('contact.index') }}" class="nav-item nav-link {{request()->routeIs('contact.index') == 1 ? 'active':''}}"><i class="far fa-question-circle me-2"></i>Tư vấn</a>
            <a href="{{ route('policy.index') }}" class="nav-item nav-link {{request()->routeIs('policy.index') == 1 ? 'active':''}}"><i class="fas fa-certificate me-2"></i></i>Chính sách</a>
            <a href="{{ route('slide.index') }}" class="nav-item nav-link {{request()->routeIs('slide.index') == 1 ? 'active':''}}"><i class="far fa-question-circle me-2"></i>Slide quảng cáo</a>
            <a href="{{ route('role.index') }}" class="nav-item nav-link {{request()->routeIs('role.index') == 1 ? 'active':''}}"><i class="fas fa-key me-2"></i>Vai trò</a>
            <a href="{{ route('lazi.index') }}" target="_blank" class="nav-item nav-link {{request()->routeIs('lazi.index') == 1 ? 'active':''}}"><i class="fas fa-store me-2"></i>Tới cửa hàng</a>
        </div>
    </nav>
</div>
