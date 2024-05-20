
<div class="modal fade" id="addSlideModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">
                @isset($slide)
                    Sửa slide {{$slide->name}}
                @else
                    Thêm slide quảng cáo
                @endisset
            </h5>
            @isset($slide)
                <a href="{{ route('slide.index') }}" class="btn-close" aria-label="Close"></a>
            @else
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            @endisset
        </div>
        <div class="modal-body p-0">
            <div class="container-fluid pt-4 px-4 mb-4" >
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-light rounded h-100 p-4 text-start">
                            <form 
                            action="@isset($slide){{ route('slide.update',['id'=>$slide->id]) }}@else{{ route('slide.store') }}@endisset"
                            method="POST" enctype="multipart/form-data">
                                @csrf
                                @isset($slide) @method('put')
                                @else @method('post')
                                @endisset
                                <div class="row">
                                    <div class="col-lg-6 col-sm-12">
                                        <div class="mb-3">
                                            <label for="title" class="form-label ">Tiêu đề</label>
                                            <input 
                                                type="text" name="title" class="form-control" id="title"
                                                @isset($slide) value="{{$slide->title}}"
                                                @else value="{{old('title')}}"
                                                @endisset
                                                placeholder="Nhập tiêu đề (vd:Đồng hồ,Laptop,...)"
                                                autocomplete="title"
                                                aria-describedby="title">
                                            @error('title')
                                                <div class="form-text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="content" class="form-label">Nội dung</label>
                                            <textarea 
                                                name="content" id="content" rows="2" class="form-control" autocomplete="content" placeholder="Nhập nội dung">@isset($slide){{$slide->content}}@else{{old('content')}}@endisset</textarea>
                                       
                                            @error('content')
                                                <div class="form-text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-12">
                                        <div class="mb-3">
                                            @isset($slide)
                                                <div class="">
                                                    <img src="{{ asset('storage/'.$slide->image_path) }}" class=" mb-2 width-100" height="100" alt="">
                                                </div>
                                            @endisset
                                            <label for="image_url" class="form-label">Banner(*)</label>
                                            <input 
                                                type="file" name="image_url" class="form-control" 
                                                @isset($slide)value="{{$slide->image_url}}"
                                                @else value="{{old('image_url')}}"
                                                @endisset
                                                autocomplete="image_url" id="image_url">   
                                            @error('image_url')
                                                <div class="form-text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                               
                                <div class="row">
                                    <div class="col-lg-6 col-sm-12">
                                      
                                        <div class="mb-3">
                                            <label for="position" class="form-label">Thứ tự (Mặc định là 1)</label>
                                            <input 
                                                type="number" name="position" class="form-control" 
                                                @isset($slide) value="{{$slide->position}}"
                                                @else value="1"
                                                @endisset
                                                placeholder="Nhập thứ tự hiện của danh mục" autocomplete="position" id="position">   
                                            @error('position')
                                                <div class="form-text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="slide_now" class="form-label">Hẹn thời gian</label>
                                            <div class="form-control">
                                                <div class="form-check form-switch">
                                                    <input 
                                                    class="form-check-input" name="slide_now" @isset($slide) @checked($slide->slide_now) @endisset type="checkbox" id="slide_now">
                                                    <label class="form-check-label" for="slide_now">Hoạt động</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-12">
                                        <div class="mb-3">
                                            <label for="show_hide" class="form-label">Trạng thái (mặc định sẽ là Hiện)</label>
                                            <select 
                                                class="form-select" name="show_hide" autocomplete="show_hide" id="show_hide">
                                                <option value="1" @isset($slide) @selected($slide->show_hide) @endisset>Hiện</option>
                                                <option value="0" @isset($slide) @selected(!$slide->show_hide) @endisset>Ẩn</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="slide_area" class="form-label">Dành cho (mặc định sẽ là Cửa hàng)</label>
                                            <select 
                                                class="form-select" name="slide_area" autocomplete="slide_area" id="slide_area">
                                                <option value="store" @isset($slide) @selected($slide->slide_area === 'store') @endisset>Cửa hàng</option>
                                                <option value="blog" @isset($slide) @selected($slide->slide_area === 'blog') @endisset>Blog</option>
                                                <option value="both" @isset($slide) @selected($slide->slide_area === 'both') @endisset>Chung</option>
                                            </select>
                                      
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="link" class="form-label">Url</label>
                                        <input
                                            type="text" name="link" class="form-control" 
                                            @isset($slide) value="{{$slide->link}}"
                                            @else value="{{old('link')}}"
                                            @endisset
                                            placeholder="Nhập đường link vd(https://www.google.com,...)"
                                            autocomplete="link"
                                            id="link">   
                                        @error('link')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                              
                                <div class="row">
                                    <div class="col-lg-6 col-sm-12 mb-3">
                                        <label for="start_date" class="form-label">Ngày bắt đầu</label>
                                        <input type="datetime-local" name="start_date" class="form-control" 
                                        @isset($slide)
                                            value="{{$slide->start_date}}"
                                        @endisset
                                        autocomplete="start_date"
                                        id="start_date">   
                                        @error('start_date')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 col-sm-12">
                                        <label for="end_date" class="form-label">Ngày kết thúc</label>
                                        <input type="datetime-local" name="end_date" class="form-control" 
                                        @isset($slide)
                                            value="{{$slide->end_date}}"
                                        @endisset
                                        autocomplete="end_date"
                                        id="end_date">   
                                        @error('end_date')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                              
                                <div class="mb-3 float-end">
                                    <button type="submit" class="btn btn-primary">
                                        @isset($slide) Sửa
                                        @else Thêm mới
                                        @endisset
                                    </button>
                                    @isset($slide) <a href="{{ route('slide.index') }}" class="btn btn-danger">Đóng</a>
                                    @else <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Đóng</button>
                                    @endisset
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
