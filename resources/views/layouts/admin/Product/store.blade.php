@extends('admin')
@section('content')
    <div class="container-fluid pt-4">
        <div class="bg-light">
            <div class="modal-body">
                <div class="container-fluid pt-4 px-4 mb-4" >
                    <div class="row ms-3">
                        <h5>Thêm sản phẩm</h5>
                        <hr>
                    </div>
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
                                        <div class="col-sm-12 col-xl-6 mb-3">
                                            <div class="card">
                                                <div class="card-body pt-1 bg-light">
                                                    <h6 class="fw-normal mb-3">Các setting khác</h6>
                                                    <div class="d-flex justify-content-around">
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" type="checkbox" name="type_hot" id="type_hot" 
                                                            @isset($product)
                                                            {{$product->product_type ? 'checked' : ''}}
                                                            @endisset>
                                                            <label class="form-check-label" for="type_hot">Sản phẩm hot</label>
                                                        </div>
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" type="checkbox" name="type_new" id="type_new" 
                                                            {{-- @isset($product)
                                                            {{$product->product_type ? 'checked' : ''}}
                                                            @endisset> --}}>
                                                            <label class="form-check-label" for="type_new">Sản phẩm mới</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-xl-6 mb-3">
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
                                            <a href="{{ route('product.index') }}" >
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Đóng</button>
                                            </a>
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
@endsection
@section('js')
    @include('layouts.admin.Product.ckeditor')
@endsection
