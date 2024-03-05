@extends('admin')
@section('content')

@if (session('success') || session('error'))
    @include('layouts.admin.components.alert')
@endif
@if ($errors->has('image_url')
    || $errors->has('color_type')
    || $errors->has('price')
    || $errors->has('price_sale')
    || $errors->has('quantity')
)
<script type="module"> 
    const myModal = new bootstrap.Modal(document.getElementById('addProductVariationModal'), {
        keyboard: false
    })
    myModal.toggle();
    myModal.show();
</script>    
@endif
{{-- @if ($errors->has('image_url')
    || $errors->has('color_type')
)
    <script type="module"> 
        const myModal1 = new bootstrap.Modal(document.getElementById('addProductSpecialModal'), {
            keyboard: false
        })
        myModal1.toggle();
        myModal1.show();
    </script>    
@endif --}}
@if ($productVariations)
    <script type="module"> 
        const myModal = new bootstrap.Modal(document.getElementById('addProductVariationModal'), {
            keyboard: false
        })
        myModal.toggle();
        myModal.show();
    </script>   
@endif
    <div class="container-fluid">
        <div class="modal-header">
            <h5 class="fw-bold">
                Thêm sản phẩm
            </h5>
            <a href="{{ route('product.index') }}" class="btn-close " aria-label="Close"></a>
        </div>
        <div class="modal-body p-0">
            <div class="container-fluid pt-4 px-4 mb-4" >
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-light rounded h-100 p-4 text-start">
                            <form 
                            action="{{ route('product.store') }}"
                            method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('post')
                                <div class="row mb-3">
                                    <div class="col-sm-12 col-xl-6 mb-3">
                                        <label for="name" class="form-label ">Tên sản phẩm <span class="text-danger text-small">(*)</span></label>
                                        <input type="text" name="name" class="form-control @error('name') 
                                        is-invalid
                                        @enderror" id="name"
                                        @isset($product)
                                            value="{{$product->name}}"
                                        @else
                                        value="{{old('name')}}"        
                                        @endisset
                                        placeholder="Nhập tên sản phẩm (vd:Iphone15,Samsung A23,...)"
                                        autocomplete="name"
                                        aria-describedby="name">
                                        @error('name')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 col-xl-6 mb-3">
                                        <label for="seo_keywords" class="form-label">Từ khóa SEO<span class="text-danger text-small">(*)</span></label>
                                        <input type="text" name="seo_keywords" class="form-control" 
                                        @isset($product)
                                            value="{{$product->seo_keywords}}"
                                        @else
                                            value="{{old('seo_keywords')}}"        
                                        @endisset
                                        autocomplete="seo_keywords"
                                        placeholder="Nhập từ khóa muốn SEO"
                                        id="seo_keywords">   
                                        @error('seo_keywords')
                                            <div class="form-text text-danger">{{ $message }}</div>
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
                                        @else
                                            value="{{old('categories_product_id')}}"    
                                        @endisset
                                        autocomplete="categories_product_id"
                                        id="categories_product_id">
                                            <option value="" selected disabled>Chọn danh mục sản phẩm</option>
                                            @foreach ($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('categories_product_id')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 col-xl-6 mb-3">
                                        <label for="brand_id" class="form-label ">Thương hiệu <span class="text-danger text-small">(*)</span></label>
                                        <select class="form-select  
                                        @error('brand_id') 
                                            is-invalid
                                        @enderror" 
                                        name="brand_id" 
                                        @isset($product)
                                            value="{{$product->brand_id}}"
                                        @else
                                            value="{{old('brand_id')}}"    
                                        @endisset
                                        autocomplete="brand_id"
                                        id="brand_id">
                                            <option value="" selected disabled>Chọn thương hiệu sản phẩm</option>
                                            @foreach ($brands as $brand)
                                                <option value="{{$brand->id}}">{{$brand->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('brand_id')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-12 col-xl-12 mb-3">
                                        <label for="show_hide" class="form-label">Trạng thái (mặc định sẽ là Hiện)</label>
                                        <select class="form-select" name="show_hide" 
                                        @isset($product)
                                            value="{{$product->show_hide}}"
                                        @else
                                            value="{{old('show_hide')}}"    
                                        @endisset
                                        autocomplete="show_hide"
                                        id="show_hide">
                                            <option value="1">Hiện</option>
                                            <option value="0">Ẩn</option>
                                        </select>    
                                    </div>
                                </div>    
                                <div class="row mb-3">
                                    <div class="col-sm-12 col-xl-6 mb-3 px-3">
                                        <button type="button" class="w-100 btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductVariationModal">
                                            Thêm màu sản phẩm
                                        </button>
                                    </div>
                                    <div class="col-sm-12 col-xl-6 mb-3 px-3">
                                        <button type="button" class="w-100 btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductSpecialModal">
                                            Thêm thông số sản phẩm
                                        </button>
                                    </div>
                                </div> 
                                <div class="row mb-3">
                                    <div class="col-sm-12 col-xl-12">
                                        <label for="description" class="form-label">Mô tả sản phẩm</label>
                                        <textarea
                                        name="description"
                                        id="description"
                                        class="form-control ck-editor__editable_inline" 
                                        autocomplete="description"
                                        >
                                            @isset($product)
                                                {{$product->description}}
                                            @endisset
                                        </textarea>
                                    </div>
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
                                        <a href="{{ route('product.index') }}" class="btn btn-danger">Đóng</a>
                                    @else
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Đóng</button>
                                    @endisset
                                </div>
                            </form>
                            {{-- Modal --}}
                            @include('layouts.admin.components.variaModal')
                            @include('layouts.admin.components.speciModal')    
                            {{-- End Modal --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
@endsection
@include('layouts.admin.Product.ckeditor')