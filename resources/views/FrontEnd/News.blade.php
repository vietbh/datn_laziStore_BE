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
                            <strong>Trending now</strong>
                         
                            <div class="trending-animated">
                                <ul id="js-news" class="js-hidden">
                                    @foreach ($news as $item)
                                    <li class="news-item"><a href="{{ route('newsFront.show', ['slug'=>$item->id]) }}">{{$item->title}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <!-- Trending Top -->
                        <div class="trending-top mb-30">
                            <div class="trend-top-img">
                                <img src="news/assets/assets/img/trending/trending_top.jpg" alt="">
                                <div class="trend-top-cap">
                                    <span>Appetizers</span>
                                    <h2><a href="details.html">Welcome To The Best Model Winner<br> Contest At Look of the year</a></h2>
                                </div>
                            </div>
                        </div>
                        <!-- Trending Bottom -->
                        <div class="trending-bottom">
                            <div class="row">
                                @forelse ($news as $news)
                                    <div class="col-lg-4">
                                        <div class="single-bottom mb-35">
                                            <div class="trend-bottom-img mb-30">
                                                <img src="{{ asset($news->image_url) }} " width="200" height="200" alt="" loading="lazy">
                                            </div>
                                            <div class="trend-bottom-cap">
                                                <span class="color1">{{$news->category->name}}</span>
                                                <h4><a class="a-title d-inline-block text-truncate" style="max-width: 250px;"  href="{{ route('newsFront.show',['slug' => $news->slug]) }}">{{ $news->title }}</a></h4>
                                            </div>
                                        </div>
                                                    <p class="d-inline-block text-truncate" style="max-width: 150px;">{!! $news->description !!}</p>
                                        
                                                <div class="bg-secondary pl-2 rounded pb-0">
                                                    <p class="text-light ">Ngày đăng: {{  $news->date_create  }}</p>
                                                </div>
                                    </div>
                                @empty
                                    <div class="col-lg-4">
                                        <div class="single-bottom mb-35">
                                            <div class="trend-bottom-img mb-30">
                                                <img src="news/assets/assets/img/trending/trending_bottom2.jpg" alt="">
                                            </div>
                                            <div class="trend-bottom-cap">
                                                <span class="color2">Sports</span>
                                                <h4><h4><a href="details.html">Tin tiếp tục cập nhật by “Mascng.”</a></h4></h4>
                                            </div>
                                        </div>
                                    </div>
                                @endforelse 

                            </div>
                        </div>
                    </div>
                    <!-- Right content -->
                    {{-- <div class="col-lg-4">
                        @foreach ($news_right as $v)
                            <div class="trand-right-single d-flex">
                                <div class="trand-right-img">
                                    <img  src="{{$v->images}}" width="100" height="100" alt="">
                                </div>
                                <div class="trand-right-cap">
                                    <span class="color3">{{$v->category->category_nm}}</span>
                                    <h4><a href="{{route('newsFront.show',['slug' => $v->id])}}">{{$v->title}}</a></h4>
                                </div>
                            </div>
                            
                        @endforeach
                    
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
   {{-- Slide --}}
    <!--  Recent Articles start -->
    <div class="recent-articles">
        <div class="container">
           <div class="recent-wrapper">
                <!-- section Tittle -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-tittle mt-30 mb-30">
                            <h3>Tin cua nguoi dung</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    {{-- <div class="col-12">
                        <div class="recent-active dot-style d-flex dot-style">
                            @forelse ($news_slide as $item)
                            <div class="single-recent mb-100">
                            @if (public_path($item->images) !== public_path())
                                <div class="what-img">
                                    <img src="{{ asset($item->images) }}" width="150" height="350" alt="">
                                </div>
                            @else
                                <div class="what-img">
                                    <img src="{{ asset("upload/images/empty.jpg") }}" width="150" height="350" alt="">
                                </div>
                            @endif
                                <div class="what-cap">
                                    <span class="color1">{{$item->category->category_nm}}</span>
                                    <p>{{$item->date_time}}</p>
                                    <h4><a href="{{ route('newsFront.show',['slug' => $item->id]) }}">{{$item->title}}</a></h4>
                                </div>
                            </div> 
                        @empty               
                        @endforelse
                            
                        </div>
                    </div> --}}
                </div>
           </div>
        </div>
    </div>           
    <!--Recent Articles End -->
    
    <div class="youtube-area video-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="video-items-active">
                        <div class="video-items text-center">
                            <iframe src="{{ asset('https://www.youtube.com/embed/CicQIuG8hBo') }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                        <div class="video-items text-center">
                            <iframe  src="{{ asset('https://www.youtube.com/embed/rIz00N40bag') }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                        <div class="video-items text-center">
                            <iframe src="{{ asset('https://www.youtube.com/embed/CONfhrASy44') }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

                        </div>
                        <div class="video-items text-center">
                            <iframe src="{{ asset('https://www.youtube.com/embed/lq6fL2ROWf8') }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                         
                        </div>
                        <div class="video-items text-center">
                            <iframe src="{{ asset('https://www.youtube.com/embed/0VxlQlacWV4') }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
            <div class="video-info">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="video-caption">
                            <div class="top-caption">
                                <span class="color1">Politics</span>
                            </div>
                            <div class="bottom-caption">
                                <h2>Welcome To The Best Model Winner Contest At Look of the year</h2>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod ipsum dolor sit. Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod ipsum dolor sit. Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod ipsum dolor sit lorem ipsum dolor sit.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="testmonial-nav text-center">
                            <div class="single-video">
                                <iframe  src="{{ asset('https://www.youtube.com/embed/CicQIuG8hBo') }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                <div class="video-intro">
                                    <h4>Welcotme To The Best Model Winner Contest</h4>
                                </div>
                            </div>
                            <div class="single-video">
                                <iframe  src="{{ asset('https://www.youtube.com/embed/rIz00N40bag') }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                <div class="video-intro">
                                    <h4>Welcotme To The Best Model Winner Contest</h4>
                                </div>
                            </div>
                            <div class="single-video">
                                <iframe src="{{ asset('https://www.youtube.com/embed/CONfhrASy44') }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                <div class="video-intro">
                                    <h4>Welcotme To The Best Model Winner Contest</h4>
                                </div>
                            </div>
                            <div class="single-video">
                                <iframe src="{{ asset('https://www.youtube.com/embed/lq6fL2ROWf8') }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                <div class="video-intro">
                                    <h4>Welcotme To The Best Model Winner Contest</h4>
                                </div>
                            </div>
                            <div class="single-video">
                                <iframe src="{{ asset('https://www.youtube.com/embed/0VxlQlacWV4') }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                <div class="video-intro">
                                    <h4>Welcotme To The Best Model Winner Contest</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    <!-- End Start youtube -->
    <!--  Recent Articles start -->
    <div class="recent-articles">
        <div class="container">
           <div class="recent-wrapper">
                <!-- section Tittle -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-tittle mt-30 mb-30">
                            <h3>Tin de xuat</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    {{-- <div class="col-12">
                        <div class="recent-active dot-style d-flex dot-style">
                            @forelse ($news_slide as $item)
                            <div class="single-recent mb-100">
                                @if (public_path($item->images) !== public_path())
                                    <div class="what-img">
                                        <img src="{{ asset($item->images) }}" width="150" height="350" alt="">
                                    </div>
                                @else
                                    <div class="what-img">
                                        <img src="{{ asset("upload/images/empty.jpg") }}" width="150" height="350" alt="">
                                    </div>
                                @endif
                                <div class="what-cap">
                                    <span class="color1">{{$item->category->category_nm}}</span>
                                    <p>{{$item->date_time}}</p>
                                    <h4><a href="{{ route('newsFront.show', $item) }}">{{$item->title}}</a></h4>
                                </div>
                            </div> 
                        @empty    
                        @endforelse
                            
                        </div>
                    </div> --}}
                </div>
           </div>
        </div>
    </div>           
    <!--Recent Articles End -->
   
@endsection