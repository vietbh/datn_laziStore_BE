
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
                            @isset($slide)
                                action="{{ route('slide.update',['id'=>$slide->id]) }}"
                            @else
                                action="{{ route('slide.store') }}"
                            @endisset
                            method="POST" enctype="multipart/form-data">
                                @csrf
                                @isset($slide)
                                    @method('put')
                                @else
                                    @method('post')
                                @endisset
                                <div class="mb-3">
                                    <label for="slide" class="form-label ">Tiêu đề <span class="text-danger text-small">*</span></label>
                                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" 
                                    id="title"
                                    @isset($slide)
                                        value="{{$slide->title}}"
                                    @else
                                        value="{{old('title')}}"
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
                                    <input type="text" name="content" class="form-control" 
                                    @isset($slide)
                                        value="{{$slide->content}}"
                                    @else
                                        value="{{old('content')}}"
                                    @endisset
                                    placeholder="Nhập thứ tự hiện của danh mục"
                                    autocomplete="content"
                                    id="content">   
                                    @error('content')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    @isset($slide)
                                        <div class="mb-2">
                                            <img src="{{$slide->image_url}}" class="img-fluid mb-2" width="250" alt="">
                                        </div>
                                    @endisset
                                    <label for="image_url" class="form-label">Banner(*)</label>
                                    <input type="file" name="image_url" class="form-control" 
                                    @isset($slide)
                                        value="{{$slide->image_url}}"
                                    @else
                                        value="{{old('image_url')}}"
                                    @endisset
                                    autocomplete="image_url"
                                    id="image_url">   
                                    @error('image_url')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="link" class="form-label">Url</label>
                                    <input type="text" name="link" class="form-control" 
                                    @isset($slide)
                                        value="{{$slide->link}}"
                                    @else
                                        value="{{old('link')}}"
                                    @endisset
                                    placeholder="Nhập đường link vd(https://www.google.com,...)"
                                    autocomplete="link"
                                    id="link">   
                                    @error('link')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="position" class="form-label">Thứ tự (Mặc định là 1)</label>
                                    <input type="number" name="position" class="form-control" 
                                    @isset($slide)
                                        value="{{$slide->position}}"
                                    @else
                                        value="{{old('position')}}"
                                    @endisset
                                    placeholder="Nhập thứ tự hiện của danh mục"
                                    autocomplete="position"
                                    id="position">   
                                    @error('position')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="show_hide" class="form-label">Trạng thái (mặc định sẽ là Hiện)</label>
                                    <select class="form-select" name="show_hide" 
                                    @isset($slide)
                                        value="{{$slide->show_hide}}"
                                    @endisset
                                    id="show_hide">
                                        <option value="1">Hiện</option>
                                        <option value="0">Ẩn</option>
                                    </select>
                                </div>
                                <div class="mb-3 float-end">
                                    <button type="submit" class="btn btn-primary">
                                        @isset($slide)
                                            Sửa
                                        @else
                                            Thêm mới
                                        @endisset
                                    </button>
                                    @isset($slide)
                                        <a href="{{ route('slide.index') }}" class="btn btn-danger">Đóng</a>
                                    @else
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Đóng</button>
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
