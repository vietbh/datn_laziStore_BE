@extends('FrontEnd/app')

@section('content')

    <!-- Trending Area Start -->
    <div class="trending-area fix">
        <div class="container">
            <div class="trending-main">
                <!-- Trending Tittle -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="py-3"></div>
                        <div class="trending-tittle">
                            <strong>Tin mới nhất</strong>
                         
                            <div class="trending-animated">
                                <ul id="js-news" class="js-hidden">
                                    @foreach ($news as $item)
                                        <li class="news-item"><a href="{{ route('fe.news.show', ['slugNews'=>$item->slug]) }}">{{$item->title}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12 mb-2">
                                        <a 
                                        class="btn btn-outline-secondary text-left border-0 w-100" href="{{ route('fe.news.index') }}" style="font-family: Arial;font-size: 0.8rem;font-weight: 700"><i class="fas fa-home me-2"></i>Trang chủ</a>
                                    </div>
                                    @foreach ($categories as $category)
                                        <div class="col-lg-12 mb-2">
                                            <a 
                                            class="btn btn-outline-secondary text-left border-0 w-100" href="{{ route('fe.category.show', ['slug' => $category->slug]) }}" style="font-family: Arial;font-size: 0.8rem;font-weight: 700">{{ $category->name }}</a>
                                        </div>
                                    @endforeach
                                    <div class="col-lg-12 mb-2">
                                        <a 
                                        class="btn btn-outline-secondary text-left border-0 w-100" href="{{ route('lazi.index') }}" style="font-family: Arial;font-size: 0.8rem;font-weight: 700"><i class="fas fa-shopping-bag me-2"></i>Về Lazi Store</a>
                                    </div>
                                </div>
    
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-9">
                        <!-- Trending Top -->
                        <div class="trending-top mb-30">
                            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                  <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                  <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                  <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                                </ol>
                                <div class="carousel-inner">
                                  <div class="carousel-item active">
                                    <img class="d-block w-100" src="{{ asset('news/assets/assets/img/trending/trending_top.jpg') }}" height="400" alt="First slide">
                                  </div>
                                  <div class="carousel-item">
                                    <img class="d-block w-100" src="{{ asset('news/assets/assets/img/trending/trending_bottom1.jpg') }}" height="400" alt="Second slide">
                                  </div>
                                  <div class="carousel-item">
                                    <img class="d-block w-100" src="{{ asset('news/assets/assets/img/trending/right5.jpg') }}" height="400" alt="Third slide">
                                  </div>
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                  <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                  <span class="sr-only">Next</span>
                                </a>
                            </div>
                            {{-- <div class="trend-top-img">
                                <img src="" alt="">
                                <div class="trend-top-cap">
                                    <span>Appetizers</span>
                                    <h2><a href="details.html">Welcome To The Best Model Winner<br> Contest At Look of the year</a></h2>
                                </div>
                            </div> --}}
                        </div>
                        <!-- Trending Bottom -->
                        <div class="trending-bottom">
                            <div class="row row-cols-1 row-cols-md-2 g-4">
                                <div class="col-lg-9 col-sm-6">
                                    <div class="row">
                                        <div class="col-lg-12 col-sm-12 mb-3">
                                            <h4 class="text-danger" style="font-family: Arial">Tin mới cập nhật</h4>
                                        </div>
                                        @forelse ($news as $new)
                                            <div class="col-lg-12 col-sm-12 mb-2" >
                                                <div class="card w-100" style="border-radius: 25px;">
                                                    <div class="row g-0 h-auto" style="border-radius: 25px;">
                                                      <div class="col-md-4 col-lg-4">
                                                        <a class="text-decoration-none text-secondary" href="{{ route('fe.news.show', ['slugNews'=>$new->slug]) }}">
                                                            <img src="{{ asset('storage/'.$new->image_path) }}" style="border-radius: 25px;" height="180" width="230" alt="">
                                                        </a>
                                                      </div>
                                                      <div class="col-md-8 col-lg-8">
                                                        <div class="card-body">
                                                            <div class="d-flex justify-content-between">
                                                                <a
                                                                class="text-decoration-none mr-1" style="color:black;" href="{{ route('fe.news.show', ['slugNews'=>$new->slug]) }}">
                                                                    <h6 class="card-title">{{$new->title}}</h6>
                                                                </a>
                                                                <a 
                                                                class="text-decoration-none text-secondary" href="{{ route('fe.category.show', ['slug' => $new->category->slug]) }}">
                                                                    <span class="badge bg-light p-2">{{$new->category->name}}</span>                                                
                                                                </a>
                                                                
                                                            </div>
                                                            <div class="card-text">
                                                                <small class="text-muted"><i class="far fa-clock"></i>
                                                                    @php
                                                                        \Carbon\Carbon::setLocale('vi');
                                                                        $current = \Carbon\Carbon::parse($new->date_create);
                                                                    @endphp
                                                                    {{$current->diffForHumans(\Carbon\Carbon::now())}}    
                                                                </small>
                                                            </div>
                                                            <div class="card-text mt-4 float-right">
                                                                <a 
                                                                href="{{ route('fe.news.show', ['slugNews'=>$new->slug]) }}" class="genric-btn primary-border circle arrow">Xem tiếp<i class="fas fa-arrow-right ml-1"></i></a>
                                                            </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                            </div>
                                        @empty
                                            <div class="col-lg-6 mb-4">
                                                <div class="single-bottom mb-35">
                                                    <div class="trend-bottom-img mb-30">
                                                        <img src="news/assets/assets/img/trending/trending_bottom2.jpg" alt="">
                                                    </div>
                                                    <div class="trend-bottom-cap">
                                                        <span class="color2">Sports</span>
                                                        {{-- <h4><h4><a href="details.html">Tin tiếp tục cập nhật by “Mascng.”</a></h4></h4> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        @endforelse
                                        <div class="col-lg-12 col-sm-12 mt-1 mb-3 d-flex justify-content-center">
                                            {{ $news->links('pagination::bootstrap-4') }}
                                        </div>   

                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 ">
                                    <div class="row">
                                        <div class="col-lg-12 col-sm-12 mb-3 ">
                                            <h4 class="text-danger" style="font-family: Arial">Tin khác</h4>
                                            <hr>
                                        </div>
                                        <div class="col-lg-12 col-sm-12 mb-3">
                                            <h5 class="text-danger" style="font-family: Arial">Thể thao</h5>
                                            <ul>
                                                <li>3</li>
                                                <li>3</li>
                                                <li>3</li>
                                                <li>3</li>
                                                <li>3</li>
                                                <li>3</li>
                                            </ul>
                                        </div>
                                        <div class="col-lg-12 col-sm-12 mb-3">
                                            <h5 class="text-danger" style="font-family: Arial">Đời sống</h5>
                                            <ul>
                                                <li>3</li>
                                                <li>3</li>
                                                <li>3</li>
                                                <li>3</li>
                                                <li>3</li>
                                                <li>3</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   {{-- Slide --}}
   
@endsection
