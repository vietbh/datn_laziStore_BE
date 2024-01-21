
<script type="module"> 
    const showModal = ()=>{
        var myModal = new bootstrap.Modal(document.getElementById('addProductModal'), {
        keyboard: false
        })
        myModal.toggle();
        myModal.show();
    }
</script>

<div class="modal fade" id="addProductModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
            @isset($product)
                Sửa sản phẩm <strong>{{$product->name}}</strong>
            @else
                Thêm sản phẩm
            @endisset
        </h5>
        @isset($product)
        <a href="{{ route('product.index') }}" class="btn-close" aria-label="Close">
        </a>
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
                            @isset($product)
                                action="{{ route('product.update',['id'=>$product->id]) }}"
                            @else
                                action="{{ route('product.store') }}"
                            @endisset
                            method="POST" enctype="multipart/form-data">
                                @csrf
                                @isset($product)
                                @method('put')
                                @else
                                @method('post')
                                @endisset
                                <div class="row mb-3">
                                    <div class="col-sm-12 col-xl-6 mb-3">
                                        <label for="name" class="form-label ">Tên sản phẩm <span class="text-danger text-small">(*)</span></label>
                                        <input type="text" name="name" class="form-control @error('name') 
                                        is-invalid
                                        @enderror" id="name"
                                        @isset($product)
                                            value="{{$product->name}}"
                                        @endisset
                                        placeholder="Nhập tên sản phẩm (vd:Iphone15,Samsung A23,...)"
                                        aria-describedby="name">
                                        @error('name')
                                        <div id="name" class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 col-xl-6 mb-3">
                                        <label for="seo_keywords" class="form-label">Từ khóa SEO<span class="text-danger text-small">(*)</span></label>
                                        <input type="text" name="seo_keywords" class="form-control" 
                                        @isset($product)
                                            value="{{$product->seo_keywords}}"
                                        @endisset
                                        id="seo_keywords">   
                                        @error('seo_keywords')
                                        <div id="seo_keywords" class="form-text text-danger">{{ $message }}</div>
                                        @enderror

                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-12 col-xl-6 mb-3">
                                        <label for="categories_product_id" class="form-label ">Danh mục sản phẩm <span class="text-danger text-small">(*)</span></label>
                                        <select class="form-select  
                                        @error('categories_product_id') 
                                        is-invalid
                                        @enderror" name="categories_product_id" 
                                        @isset($product)
                                            value="{{$product->categories_product_id}}"
                                        @endisset
                                        id="categories_product_id">
                                            <option value="" selected disabled>Chọn danh mục sản phẩm</option>
                                            {{-- @foreach ($collection as $k => $v)
                                                <option value="1">Danh mục 1</option>
                                            @endforeach --}}
                                        </select>
                                        @error('categories_product_id')
                                            <div id="categories_product_id" class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 col-xl-6 mb-3">
                                        <label for="brand_id" class="form-label ">Thương hiệu <span class="text-danger text-small">(*)</span></label>
                                        <select class="form-select  
                                        @error('brand_id') 
                                        is-invalid
                                        @enderror" name="brand_id" 
                                        @isset($product)
                                            value="{{$product->brand_id}}"
                                        @endisset
                                        id="brand_id">
                                            <option value="" selected disabled>Chọn thương hiệu sản phẩm</option>
                                            {{-- @foreach ($collection as $k => $v)
                                                <option value="1">Danh mục 1</option>
                                            @endforeach --}}
                                        </select>
                                        @error('brand_id')
                                            <div id="brand_id" class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="color_type" class="form-label">Màu sắc <span class="text-danger text-small">(*)</span></label>
                                    <input type="color" class="form-control" name="color_type"
                                    @isset($product)
                                    value="{{$product->color_type}}"
                                    @endisset
                                    id="color_type">
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-12 col-xl-6 mb-3">
                                        <label for="price" class="form-label ">Giá gốc (Đơn vị vnđ) <span class="text-danger text-small">(*)</span></label>
                                        <input type="text" name="price" class="form-control @error('price') 
                                        is-invalid
                                        @enderror" id="price"
                                        @isset($product)
                                            value="{{$product->price}}"
                                        @endisset
                                        placeholder="Nhập giá tiền (vd:300=300.000đ)"
                                            aria-describedby="price">
                                            @error('price')
                                                <div id="price" class="form-text text-danger">{{ $message }}</div>
                                            @enderror
                                    </div>
                                    <div class="col-sm-12 col-xl-6 mb-3">
                                        <label for="price_sale" class="form-label ">Giá khuyến mãi (Đơn vị vnđ) <span class="text-danger text-small">(*)</span></label>
                                        <input type="text" name="price_sale" class="form-control @error('price_sale') 
                                        is-invalid
                                        @enderror" id="price_sale"
                                        @isset($product)
                                            value="{{$product->price_sale}}"
                                        @endisset
                                        placeholder="Nhập giá tiền (vd:300=300.000đ)"
                                            aria-describedby="price_sale">
                                            @error('price_sale')
                                                <div id="price_sale" class="form-text text-danger">{{ $message }}</div>
                                            @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-12 col-xl-6 mb-3">
                                        <label for="image_url" class="form-label ">Chọn hình ảnh <span class="text-danger text-small">(*)</span></label>
                                        <input type="file" name="image_url" class="form-control @error('image_url') 
                                        is-invalid
                                        @enderror" id="image_url"
                                        @isset($product)
                                            value="{{$product->image_url}}"
                                        @endisset
                                        aria-describedby="image_url">
                                        @error('image_url')
                                            <div id="image_url" class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 col-xl-6 mb-3">
                                        <label for="show_hide" class="form-label">Trạng thái (mặc định sẽ là Hiện)</label>
                                        <select class="form-select" name="show_hide" 
                                        @isset($product)
                                            value="{{$product->show_hide}}"
                                        @endisset
                                        id="show_hide">
                                            <option value="show">Hiện</option>
                                            <option value="hide">Ẩn</option>
                                        </select>    
                                    </div>
                                </div>
                                    
                                <div class="mb-3">
                                    <label for="show_hide" class="form-label">Mô tả ngắn</label>
                                    <select class="form-select" name="show_hide" 
                                    @isset($product)
                                        value="{{$product->show_hide}}"
                                    @endisset
                                    id="show_hide">
                                        <option value="show">Hiện</option>
                                        <option value="hide">Ẩn</option>
                                    </select>
                                </div>
                                <div class="mb-3 float-end">
                                    <button type="submit" class="btn btn-primary">
                                        @isset($product)
                                        Sửa
                                    @else
                                        Thêm mới
                                    @endisset
                        
                                    </button>
                                    @isset($product)
                                    <a href="{{ route('product.index') }}" class="btn btn-danger">
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
