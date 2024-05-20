@extends('admin')
@section('content')
    <div class="container">
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
                                        <label for="name" class="form-label">Tên sản phẩm <span class="text-danger text-small">(*)</span></label>
                                        <input type="text" name="name" class="form-control
                                        @error('name') 
                                            is-invalid
                                        @enderror" id="name"
                                        @isset($product)
                                            value="{{$product->name}}"
                                        @else
                                        value="{{old('name')}}"        
                                        @endisset
                                        autocomplete="name"
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
                                        @else
                                            value="{{old('seo_keywords')}}"        
                                        @endisset
                                        autocomplete="seo_keywords"
                                        placeholder="Từ khóa liên quan tới sản phẩm"
                                        id="seo_keywords">   
                                        @error('seo_keywords')
                                        <div id="seo_keywords" class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-12 col-xl-6 mb-3">
                                        <label for="categories_product_id" class="form-label ">Danh mục sản phẩm <span class="text-danger text-small">(*)</span></label>
                                        <select
                                        class="form-select @error('categories_product_id') is-invalid @enderror" name="categories_product_id" id="categories_product_id">
                                            @foreach ($categories as $category)
                                                <option 
                                                value="{{$category->id}}" @isset($product) @selected($product->categories_product_id == $category->id) @endisset>{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('categories_product_id')
                                            <div id="categories_product_id" class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 col-xl-6 mb-3">
                                        <label for="brand_id" class="form-label ">Thương hiệu <span class="text-danger text-small">(*)</span></label>
                                        <select 
                                        class="form-select @error('brand_id') is-invalid @enderror" name="brand_id" id="brand_id">
                                            @foreach ($brands as $brand)
                                                <option value="{{$brand->id}}" @isset($product) @selected($product->brand_id == $brand->id) @endisset>{{$brand->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('brand_id')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                @isset($product)
                                    <div class="row mb-3">
                                        <div class="col-sm-12 col-xl-6 mb-3 px-3">
                                            <a href="{{ route('varia.create', ['id'=>$product->id]) }}">
                                                <button type="button" class="w-100 btn btn-primary" >
                                                    Màu sản phẩm
                                                </button>
                                            </a>
                                        </div>
                                        <div class="col-sm-12 col-xl-6 mb-3 px-3">
                                            <a href="{{ route('specifi.create', ['idProduct'=>$product->id]) }}" class="w-100 btn btn-primary">
                                                Thông số sản phẩm
                                            </a>
                                        </div>
                                    </div> 
                                @endisset
                                <div class="row mb-3">
                                    <div class="col-sm-12 col-xl-6 mb-3">
                                        <div class="card">
                                            <div class="card-body pt-1 bg-light">
                                                <h6 class="fw-normal mb-3">Các setting khác</h6>
                                                <div class="d-flex justify-content-around">
                                                    <div class="form-check form-switch">
                                                        <input 
                                                        class="form-check-input" type="checkbox" name="type_hot" autocomplete="off" id="type_hot" @isset($product) @checked($product->product_type_hot) @endisset>
                                                        <label class="form-check-label" for="type_hot">Sản phẩm hot</label>
                                                    </div>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" name="type_new" autocomplete="off" id="type_new"  @isset($product) @checked($product->product_type_new) @endisset >
                                                        <label class="form-check-label" for="type_new">Sản phẩm mới</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-xl-6 mb-3">
                                        <label for="show_hide" class="form-label">Trạng thái (mặc định sẽ là Hiện)</label>
                                        <select class="form-select" name="show_hide" autocomplete="show_hide" id="show_hide">
                                            <option value="1" @isset($product) @selected($product->show_hide) @endisset>Hiện</option>
                                            <option value="0" @isset($product) @selected(!$product->show_hide) @endisset>Ẩn</option>
                                        </select>    
                                    </div>
                                </div>      
                                <div class="row mb-3">
                                    <div class="col-sm-12 col-xl-12">
                                        <label for="description" class="form-label">Mô tả sản phẩm</label>
                                        <textarea
                                        name="description"
                                        id="description"
                                        class="form-control ck-editor__editable_inline" 
                                        ></textarea>
                                    </div>
                                </div>     
                                <div class="mb-3 float-end">
                                    <button type="submit" class="btn btn-primary">
                                    @isset($product) Sửa
                                    @else Thêm mới
                                    @endisset
                                    </button>

                                    @isset($product) <a href="{{ route('product.index') }}" class="btn btn-danger">Đóng</a>
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
@endsection
@section('js')
    @include('layouts.admin.Product.ckeditor') 
@endsection