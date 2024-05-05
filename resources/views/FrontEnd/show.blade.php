@extends('FrontEnd/app')

@section('content')
    <!--================Blog Area =================-->
    <section class="blog_area single-post-area section-padding">
        <div class="container">
            <nav class="bg-white" aria-label="breadcrumb">
                <ol class="breadcrumb bg-white">
                  <li class="breadcrumb-item"><a href="{{ route('fe.news.index') }}" class=""><span>Trang chủ</span></a></li>
                  <li class="breadcrumb-item"><a href="{{ route('fe.category.show', ['slug'=>$detailNews->category->slug]) }}" class="text-primary">{{$detailNews->category->name}}</a></li>
                  <li class="breadcrumb-item active" aria-current="page">{{$detailNews->title}}</li>
                </ol>
            </nav>
            <div class="row">
                <div class="col-lg-8 posts-list">
                    <div class="single-post">
                        <div class="feature-img">
                            @if ($detailNews->image_path)
                                <img 
                                class="img-fluid" src="{{ asset('storage/'.$detailNews->image_path) }}" width="90%" height="450" alt="">         
                            @else
                                <img 
                                class="img-fluid" src="{{ asset('upload/images/empty.jpg') }}" width="90%" height="450" alt="">
                            @endif
                        </div>
                        <div class="blog_details">
                            <ul class="blog-info-link mt-3 mb-4">
                                <li><a href="#"><i class="fa fa-user"></i>{{ $detailNews->author }}</a></li>
                                <li><a href="{{ route('fe.category.show', ['slug'=> $detailNews->category->slug]) }}"><span class="badge bg-light">{{ $detailNews->category->name }}</span></a></li>
                                {{-- <li><a href="#"><i class="fa fa-comments"></i>{{ $detailNews->comments->count() }}Comments</a></li> --}}
                            </ul>
                            <h3 style="font-family: Roboto">{{ $detailNews->title }}</h3>
                            <p class="excert">{!! $detailNews->description !!}</p>
                        </div>
                    </div>
                    <div class="navigation-top">
                        <div class="d-sm-flex justify-content-between text-center">
                            <p class="like-info">
                                <span class="align-middle">Ngày đăng: {{ \Carbon\Carbon::parse($detailNews->date_create)->format('H:i')}} - {{ \Carbon\Carbon::parse($detailNews->date_create)->format('d/m/Y')}} <i class="fas fa-calendar-alt"></i></p>
                            <div class="col-sm-4 text-center my-2 my-sm-0">
                                <!-- <p class="comment-count"><span class="align-middle"><i class="fa fa-comment"></i></span> 06 Comments</p> -->
                            </div>
                            <ul class="social-icons">
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-dribbble"></i></a></li>
                                <li><a href="#"><i class="fab fa-behance"></i></a></li>
                            </ul>
                        </div>
                        <div class="d-sm-flex justify-content-start text-center">
                            <p class="comment-count">
                                <span class="align-middle"><i class="fas fa-tags me-2"></i></span>{{$detailNews->tags->count()}} Tags:
                                @forelse ($detailNews->tags as $tag)
                                    <span class="badge bg-secondary text-light p-2">{{$tag->tag->name}}</span>
                                @empty
                                    Không có tag liên quan
                                @endforelse
                            </p> 
                        </div>
             
                    </div>
                 
                    <div class="comments-area ">
                        <h4>{{ $detailNews->comments->count() }} Bình luận</h4>
                        @forelse ($detailNews->comments as $v)
                            <div class="comment-list border border-right-4 rounded p-3 mb-2 ">
                                <h5 class="mb-1">
                                    <a href="#">{{ $v->full_nm }}</a>
                                </h5>
                                <div class="single-comment justify-content-between d-flex">
                                    <div class="user justify-content-between d-flex">
                                        <div class="thumb">
                                            <img src="{{ asset('assets/img/comment/comment_1.png') }} " alt="">
                                        </div>

                                        <div class="desc">
                                            <p class="comment">
                                                {{ $v->comment }}
                                            </p>
                                            <div class="d-flex justify-content-between">
                                                <div class="d-flex align-items-left">
                                                    <p class="date">{{ $v->create_time }} </p>
                                                </div>
                                                <div class="reply-btn">
                                                    <a href="#comment-reply" class="btn-reply text-uppercase">reply</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @empty
                            <p>Chưa có bình luận nào</p>
                        @endforelse

                        @include('FrontEnd.comment')
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog_right_sidebar">
                        {{-- <aside class="single_sidebar_widget search_widget">
                            <form action="" method="get"> 
                                @csrf
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <input type="search" name="search" required class="form-control" placeholder='Search Keyword'
                                            onfocus="this.placeholder = ''" onblur="this.placeholder = 'Search Keyword'">
                                        <div class="input-group-append">
                                            <button class="btns" type="submit"><i class="ti-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </aside> --}}
                        <aside class="single_sidebar_widget post_category_widget">
                            <h4 class="widget_title">Danh mục</h4>
                            <ul class="list cat-list">
                                @foreach ($categories as $cate)
                                    @if ($cate->news->count() > 0)
                                        <li>
                                            <a href="{{ route('fe.category.show', ['slug'=>$cate->slug]) }}">
                                                <p>{{$cate->name}} ({{$cate->news->count()}})</p>
                                            </a>
                                        </li>
                                        
                                    @endif
                                @endforeach
                            </ul>
                        </aside>
                        <aside class="single_sidebar_widget popular_post_widget">
                            <h3 class="widget_title">Tin tức liên quan</h3>
                            @forelse ($detailNews->category->news as $news)
                                @if ($detailNews->id != $news->id)
                                    <div class="media post_item">
                                        @if ($news->image_path)
                                        <img src="{{ asset('storage/'.$news->image_path) }}" width="50" height="50" alt="post">
                                        @else
                                        <img src="{{ asset('upload/images/empty.jpg') }}" width="50" height="50" alt="post">
                                        @endif
                                        <div class="media-body">
                                            <a 
                                            style="color: black" href="{{ route('fe.news.show', ['slugNews'=>$news->slug]) }}">
                                                <h6>{{$news->title}}</h6>
                                            </a>
                                            <small class="text-muted"><i class="far fa-clock"></i>
                                                @php
                                                    \Carbon\Carbon::setLocale('vi');
                                                    $current = \Carbon\Carbon::parse($news->date_create);
                                                @endphp
                                                {{$current->diffForHumans(\Carbon\Carbon::now())}}    
                                            </small>
                                        </div>
                                    </div>       
                                    
                                @endif
                            @empty
                                <div class="media post_item">
                                    <img src="{{ asset('news/assets/assets/img/post/post_1.png') }}" alt="post">
                                    <div class="media-body">
                                        <h3>Không có tin liên quan</h3>
                                    </div>
                                </div>       
                            @endforelse
                                           
                        </aside>
                        <aside class="single_sidebar_widget tag_cloud_widget">
                            <h4 class="widget_title">Tag liên quan</h4>
                            <ul class="list">
                                @foreach ($detailNews->tags as $tag)
                                    <li>
                                        <a href="#">{{$tag->tag->name}}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </aside>
                    
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ Blog Area end =================-->

@endsection
