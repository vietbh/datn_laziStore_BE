<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-light navbar-light">
        <a href="index.html" class="navbar-brand mx-4 mb-3">
            <h3 class="text-secondary"></i>LAZI-STORE</h3>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img class="rounded-circle" src="@if(Auth::user()->image_url != ''){{ Auth::user()->image_url}} @endif" alt="" style="width: 40px; height: 40px;">
                @if (Auth::user()->user_status)    
                    <div 
                    class="bg-success rounded-circle border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                @else
                    <div 
                    class="bg-danger rounded-circle border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    
                @endif
            </div>
            <div class="ms-3">
                <h5 class="mb-0">{{ Auth::user()->name }}</h5>
                <span class="text-uppercase text-secondary fw-bolder" style="font-size: 11px;">{{ Auth::user()->roleName(Auth::user()->role)->role_name }}</span>
            </div>
        </div>
        <div class="navbar-nav w-100">            
            <a href="{{ route('home') }}" class="nav-item nav-link {{request()->routeIs('home') == 1 ? 'active':''}}"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
            <a href="{{ route('chart.index') }}" class="nav-item nav-link {{request()->routeIs('chart.index') == 1 ? 'active':''}}"><i class="fa fa-chart-bar me-2"></i>Thống kê</a>
            <a href="{{ route('guest.index') }}" class="nav-item nav-link {{request()->routeIs(['guest.index','guest.edit']) == 1 ? 'active':''}}"><i class="fas fa-users me-2"></i>Tài khoản</a>
            <a href="{{ route('payment.index') }}" class="nav-item nav-link {{request()->routeIs('payment.index','payment.edit') == 1 ? 'active':''}}"><i class="fas fa-cash-register me-2"></i>Đơn hàng</a>
            <a href="{{ route('discount.index') }}" class="nav-item nav-link {{request()->routeIs('discount.index') == 1 ? 'active':''}}"><i class="fa fa-ticket-alt me-2"></i>Mã giảm giá</a>
            <a href="{{ route('shipping.index') }}" class="nav-item nav-link {{request()->routeIs('shipping.index') == 1 ? 'active':''}}"><i class="fa fa-truck me-2"></i>Nhà vận chuyển</a>
            <a href="{{ route('delivery.index') }}" class="nav-item nav-link {{request()->routeIs('delivery.index') == 1 ? 'active':''}}"><i class="fa fa-truck me-2"></i>Vận chuyển</a>
            <a href="{{ route('comment.product.index') }}" class="nav-item nav-link text-nowrap {{request()->routeIs('comment.product.index') == 1 ? 'active':''}}"><i class="fa fa-comments me-2"></i>Bình luận sản phẩm</a>
            <a href="{{ route('comment.news.index') }}" class="nav-item nav-link {{request()->routeIs('comment.news.index') == 1 ? 'active':''}}"><i class="fa fa-comments me-2"></i>Bình luận tin tức</a>
            <a href="{{ route('brand.index') }}" class="nav-item nav-link {{request()->routeIs('brand.index') == 1 ? 'active':''}}"><i class="fas fa-globe"></i>Thương hiệu</a>
            <a href="{{ route('product.cat.index') }}" class="nav-item nav-link text-nowrap {{request()->routeIs('product.cat.index') == 1 ? 'active':''}}"><i class="far fa-list-alt"></i>Danh mục sản phẩm</a>
            <a href="{{ route('product.index') }}" class="nav-item nav-link {{request()->routeIs('product.index') == 1 ? 'active':''}}"><i class="fa fa-laptop me-2"></i>Sản phẩm</a>
            <a href="{{ route('speci.index') }}" class="nav-item nav-link {{request()->routeIs('speci.index','speci.store','speci.edit') == 1 ? 'active':''}}"><i class="fa fa-laptop me-2"></i>Thông số</a>
            <a href="{{ route('news.cat.index') }}" class="nav-item nav-link text-nowrap {{request()->routeIs('news.cat.index') == 1 ? 'active':''}}"><i class="far fa-list-alt"></i>Danh mục tin tức</a>
            <a href="{{ route('news.tag.index') }}" class="nav-item nav-link {{request()->routeIs('news.tag.index') == 1 ? 'active':''}}"><i class="fas fa-tags"></i>Tag</a>
            <a href="{{ route('news.index') }}" class="nav-item nav-link {{request()->routeIs('news.index') == 1 ? 'active':''}}"><i class="fa fa-newspaper me-2"></i>Tin tức</a>
            <a href="{{ route('contact.index') }}" class="nav-item nav-link {{request()->routeIs('contact.index') == 1 ? 'active':''}}"><i class="far fa-question-circle me-2"></i>Tư vấn</a>
            <a href="{{ route('policy.index') }}" class="nav-item nav-link {{request()->routeIs('policy.index') == 1 ? 'active':''}}"><i class="fas fa-certificate me-2"></i></i>Chính sách</a>
            <a href="{{ route('slide.index') }}" class="nav-item nav-link {{request()->routeIs('slide.index') == 1 ? 'active':''}}"><i class="far fa-question-circle me-2"></i>Slide quảng cáo</a>
            <a href="{{ route('role.index') }}" class="nav-item nav-link {{request()->routeIs('role.index') == 1 ? 'active':''}}"><i class="fas fa-key me-2"></i>Vai trò</a>
            <a href="{{ route('lazi.index') }}" target="_blank" class="nav-item nav-link {{request()->routeIs('lazi.index') == 1 ? 'active':''}}"><i class="fas fa-store me-2"></i>Tới cửa hàng</a>
        </div>
    </nav>
</div>
