{{-- @extends('FrontEnd/app')

@section('content')
<div class="col-lg-8">
  <div class="trending-bottom">
      <div class="row">
           ($news as $new)

              <a href="">
              <div class="card mb-3" style="max-width: 540px;">
                  <div class="row g-0">
                    <div class="col-md-4">
                      <img src="{{ $new->image_url }}" class="img-fluid rounded-start object-fit-cover" alt="...">
                    </div>
                    <div class="col-md-8">
                      <div class="card-body">
                      <span class="color1">{{$new->category->name}}</span>
                        <p class="card-text">{{ route('newsFront.show',['slug' => $new->slug]) }}">{{ $new->title }}</p>
                        <p class="card-text"><small class="text-body-secondary"></small>{!! $new->description !!}</p>
                        <a href="">Đọc thêm...</a>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
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

      </div>
  </div>

  @endsection --}}