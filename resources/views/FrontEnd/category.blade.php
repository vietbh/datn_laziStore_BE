@extends('FrontEnd/app')

@section('content')
    <!-- Whats New Start -->
    <section class="whats-news-area pt-50 pb-20">
        <div class="container">
            <nav class="bg-white" aria-label="breadcrumb">
                <ol class="breadcrumb bg-white">
                  <li class="breadcrumb-item"><a href="{{ route('fe.news.index') }}" class=""><span>Trang chủ</span></a></li>
                  {{-- <li class="breadcrumb-item"><a href="{{ route('fe.category.show', ['slug'=>$category->slug]) }}" class="text-primary">{{$category->name}}</a></li> --}}
                  <li class="breadcrumb-item active" aria-current="page">{{$category->name}}</li>
                </ol>
            </nav>
            <div class="row">
                <div class="col-lg-8">
                    <div class="row d-flex justify-content-between">
                        <div class="col-lg-12 col-md-12">
                            <div class="section-tittle mb-30">
                                <h4 class="font-weight-bold">Danh mục {{ $category->name }}</h4>
                            </div>
                            <div class="properties__button">
                                <!--Nav Button  -->
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        @foreach ($categories as $cate)
                                            <a 
                                            class="nav-item nav-link" id="nav-profile-tab" href="{{ route('fe.category.show', ['slug' => $cate->slug]) }}"
                                            aria-selected="false">{{ $cate->name }}</a>
                                        @endforeach
                                    </div>
                                </nav>
                                <!--End Nav Button  -->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <!-- Nav Card -->
                            <div class="tab-content" id="nav-tabContent">
                                <!-- card one -->
                                <div class="whats-news-caption">
                                    <div class="row">
                                        @forelse ($category->news()->paginate(6)->all() as $news)
                                            <div class="col-lg-6 col-md-6">
                                                <div class="single-what-news mb-100">
                                                    <div class="what-img">
                                                        @if ($news->image_path)
                                                            <a href="{{ route('fe.news.show', ['slugNews' => $news->slug]) }}">
                                                                <img 
                                                                src="{{ asset('storage/'.$news->image_path) }}" width="300" height="300" alt="">
                                                            </a>
                                                            @else
                                                                <img src="{{ asset('assets/img/news/weekly2News2.jpg') }}" width="300" height="300">
                                                            @endif
                                                            
                                                    </div>
                                                    <div class="what-cap">
                                                        <small class="text-muted"><i class="far fa-clock"></i>
                                                            @php
                                                                \Carbon\Carbon::setLocale('vi');
                                                                $current = \Carbon\Carbon::parse($news->date_create);
                                                            @endphp
                                                            {{$current->diffForHumans(\Carbon\Carbon::now())}}    
                                                        </small>
                                                        <h4><a href="{{ route('fe.news.show', ['slugNews' => $news->slug]) }}">{{ $news->title }}</a></h4>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="single-what-news mb-100 container-fluid">
                                                <div class="alert alert-warning " role="alert">
                                                    <h3 class="text-center">Đang cập nhật tin !</h3>
                                                </div>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>

                                <!-- End Nav Card -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <!-- Section Tittle -->
                    <div class="section-tittle mb-40">
                        <h3>Tin tức khác</h3>
                    </div>
                    <!-- Flow Socail -->
                    <div class="single-follow mb-45">
                        <div class="single-box">
                            @foreach ($categories as $cate)
                                @foreach ($cate->news()->take(6)->get() as $news)
                                    <div class="trand-right-single d-flex mb-2">
                                        <div class="trand-right-img mb-2">
                                            <img src="{{ asset('storage/'.$news->image_path) }}" width="100" height="100" alt="">
                                        </div>
                                        <div class="trand-right-cap ml-2">
                                            <span class="color1">{{$news->category->name}}</span>
                                            <a href="{{ route('fe.news.show', ['slugNews'=>$news->slug]) }}" style="color: black"><h6>{{$news->title}}</h6></a>
                                        </div>
                                    </div>
                                @endforeach                                
                            @endforeach
                        </div>
                    </div>
                    <!-- New Poster -->
                    <div class="news-poster d-none d-lg-block">
                        <img src="{{ asset('assets/img/news/news_card.jpg') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            {{ $category->news()->paginate(6)->links('pagination::bootstrap-4') }}
        </div>
    </section>
@endsection
