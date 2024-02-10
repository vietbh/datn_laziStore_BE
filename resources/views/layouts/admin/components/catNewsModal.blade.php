
<div class="modal fade" id="addCategoriesModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
            @isset($category)
                Sửa danh mục tin tức {{$category->title}}
            @else
                Thêm danh mục tin tức
            @endisset
        </h5>
        @isset($category)
        <a href="{{ route('product.cat.index') }}" class="btn-close" aria-label="Close">
        </a>
            @else
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">        </button>
        @endisset
        </div>
        <div class="modal-body p-0">
            <div class="container-fluid pt-4 px-4 mb-4" >
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-light rounded h-100 p-4 text-start">
                            <form 
                            @isset($category)
                                action="{{ route('product.cat.update',['id'=>$category->id]) }}"
                            @else
                                action="{{ route('product.cat.store') }}"
                            @endisset
                            method="POST">
                                @csrf
                                @isset($category)
                                @method('put')
                                @else
                                @method('post')
                                @endisset
                                <div class="mb-3 ">
                                    <label for="title" class="form-label ">Tên danh mục <span class="text-danger text-small">*</span></label>
                                    <input type="text" name="title" class="form-control @error('title') 
                                    is-invalid
                                    @enderror" id="title"
                                    @isset($category)
                                        value="{{$category->title}}"
                                    @endisset
                                    placeholder="Nhập tên của danh mục (vd:Đồng hồ,Laptop,...)"
                                        aria-describedby="title">
                                        @error('title')
                                            <div id="title" class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="index" class="form-label">Thứ tự của danh mục (Mặc định là 0)</label>
                                    <input type="text" name="index" class="form-control" 
                                    @isset($category)
                                        value="{{$category->index}}"
                                    @endisset
                                    id="index">   
                                    @error('index')
                                    <div id="index" class="form-text text-danger">{{ $message }}</div>
                                    @enderror

                                </div>
                                <div class="mb-3">
                                    <label for="show_hide" class="form-label">Trạng thái (mặc định sẽ là Hiện)</label>
                                    <select class="form-select" name="show_hide" 
                                    @isset($category)
                                        value="{{$category->show_hide}}"
                                    @endisset
                                    id="show_hide">
                                        <option value="show">Hiện</option>
                                        <option value="hide">Ẩn</option>
                                    </select>
                                </div>
                                <div class="mb-3 float-end ">
                                    <button type="submit" class="btn btn-primary">
                                        @isset($category)
                                        Sửa
                                    @else
                                        Thêm mới
                                    @endisset
                        
                                    </button>
                                    @isset($category)
                                    <a href="{{ route('product.cat.index') }}" class="btn btn-danger">
                                        Đóng
                                    </a>
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

