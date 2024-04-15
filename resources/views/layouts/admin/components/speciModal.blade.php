@extends('admin')
@section('content')
@php
    $tab = request()->query('tab');
@endphp
    <div class="container-fluid mt-5 mb-5" style="height: 85vh">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('product.edit', ['id'=>$product->id]) }}">Sản phẩm {{$product->name}}</a></li>
              <li class="breadcrumb-item active" aria-current="page">Thêm thông số sản phẩm</li>
            </ol>
        </nav>
        <div class="card bg-light">
            <div class="card-body p-1 m-3">
                <div class="container">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                          <button class="nav-link @if($tab != 'speci') active @endif " id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Thông số sản phẩm</button>
                          <button class="nav-link @if($tab == 'speci') active @endif" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Thông số setting</button>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade @if($tab != 'speci') show active @endif " id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h5 class="card-title my-3">
                                        @isset($productSpecification)
                                            Sửa 
                                        @else
                                            Thêm thông số {{$product->name}}
                                        @endisset
                                    </h5>                 
                                </div>
                                <div class="col-sm-6 col-xl-4">
                                    <div class="bg-white rounded h-100 p-3 text-start">
                                        <form 
                                            action="@isset($productSpecification) {{ route('specifi.update',['id' => $productSpecification->id]) }} @else {{ route('specifi.store') }} @endisset"
                                            method="post">
                                            @csrf
                                            @isset($productSpecification) @method('put')
                                            @else @method('post')
                                            @endisset
<<<<<<< HEAD
                                            autocomplete="name"
                                            placeholder="Kích thước màn hình,bộ nhớ,..."
                                            id="name">
                                            @error('name')
                                                <div class="form-text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-sm-12 col-xl-12 mb-3">
                                            <label for="value" class="form-label ">Giá trị thông số <span class="text-danger text-small">(*)</span></label>
                                            <textarea name="value" class="form-control 
                                            @error('value') 
                                                is-invalid
                                            @enderror" id="value"
                                            autocomplete="value"
                                            placeholder="Nhập tên thông số (vd:Công nghệ màn hình)"
                                            aria-describedby="value">
                                            @isset($productSpecification)
                                            {{$productSpecification->value}}
                                        @else
                                            {{old('value')}}
                                        @endisset
                                            </textarea>
                                            @error('value')
                                                <div class="form-text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-sm-12 col-xl-12 mb-3">
                                            <label for="position" class="form-label ">Thứ tự</label>
                                            <input type="number" name="position" class="form-control
                                            @error('position') 
                                                is-invalid
                                            @enderror" id="position"
                                            @isset($productSpecification)
                                                value="{{$productSpecification->position}}"
                                            @else
                                                value="1"
                                            @endisset
                                            autocomplete="position"
                                            placeholder="Nhập giá trị (VD:Dynamic AMOLED 2X)"
                                            aria-describedby="position">
                                            @error('position')
                                                <div class="form-text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-sm-12 col-xl-12 mb-3">
                                            <label for="show_hide" class="form-label">Trạng thái (mặc định sẽ là Hiện)</label>
                                            <select class="form-select" name="show_hide" 
                                            @isset($productSpecification)
                                                value="{{$productSpecification->show_hide}}"
                                            @else
                                                value="{{old('show_hide')}}"    
                                            @endisset
                                            autocomplete="show_hide"
                                            id="show_hide">
                                                <option value="1">Hiện</option>
                                                <option value="0">Ẩn</option>
                                            </select>    
                                        </div>
                                        <div class="col-sm-12 col-xl-12 mb-3">
                                            <div class="d-flex justify-content-end">
                                                @isset($productSpecification)
                                                    <button type="submit" class="btn btn-primary me-2">Sửa</button>
                                                    <a href="{{ route('specifi.create',['id' => $product->id]) }}">
                                                        <button type="button" class="float-right btn btn-secondary me-2">Đóng</button>
                                                    </a>                                            
                                                @else
                                                    @if($productSpecificationCount > 0)
                                                        <a href="{{ route('varia.create',['id' => $product->id ]) }}">
                                                            <button type="button" class="float-right btn btn-sm btn-secondary me-2">Màu sản phẩm</button>
                                                        </a>                                            
                                                        <a href="{{ route('product.index') }}">
                                                            <button type="button" class="float-right btn btn-sm btn-secondary me-2">Đóng</button>
                                                        </a>                                            
                                                    @endif
                                                    <button type="submit" class="btn @if($productSpecificationCount > 0) btn-sm @endif btn-primary me-2">Thêm</button>
                                                @endisset
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-sm-12 col-xl-8">
                            <div class="bg-white rounded h-100 p-2 text-start">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">Tên thông sô</th>
                                                <th scope="col">Giá trị thông số</th>
                                                <th scope="col">Vị trí</th>
                                                <th scope="col">Ẩn Hiện</th>
                                                <th scope="col" class="text-start" colspan="2">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @isset($productSpecifications)
                                                @foreach ($productSpecifications as $productSpeci)
                                                    <tr>
                                                        <td ><p>{{$productSpeci->name}}</p></td>
                                                        <td ><p>{{ $productSpeci->value }}</p></td>
                                                        <td ><p>{{$productSpeci->position}}</p></td>
                                                        <td ><p>{{$productSpeci->show_hide ? 'Ẩn' : 'Hiện'}}</p></td>
                                                        <td>
                                                            <div class="d-flex justify-content-evenly">
                                                                <a class="@isset($productSpecification){{$productSpeci->id == $productSpecification->id ? 'd-none' : ''}} @endisset" href="{{ route('specifi.edit', ['id' => $productSpeci->id]) }}" title="Edit"  >
                                                                        <button class="btn btn-sm btn-primary">
                                                                            Edit
                                                                        </button>
                                                                    </a>
                                                                <form action="{{ route('specifi.delete', ['id' => $productSpeci->id]) }}" method="POST">
                                                                    @csrf
                                                                    @method('delete')
                                                                    <button class="btn btn-sm btn-danger" type="submit" title="Xóa">Xóa</button>
                                                                </form>
=======
                                            <div class="row mb-3">
                                                <div 
                                                class="col-sm-12 col-xl-12 mb-3">
                                                    <input 
                                                    type="text" value="{{$product->id}}" name="product_id" hidden>
                                                    <label 
                                                    for="speci_id" class="form-label">Tên thông số <span class="text-danger text-small">(*)</span></label>
                                                        
                                                    <select 
                                                    class="js-example-basic-single form-control" name="speci_id" id="speci_id">
                                                        @isset($specis)
                                                            @foreach ($specis as $speci)
                                                                <option 
                                                                value="{{$speci->id}}" @isset($productSpecification) {{$productSpecification->id == $speci->id ? 'selected':''}} @endisset >{{$speci->name}}</option>
                                                            
                                                            @endforeach
                                                        @endisset
                                                      </select>     

                                                    @error('speci_id')
                                                        <div class="form-text text-danger">{{ $message }}</div>
                                                    @enderror

                                                </div>

                                                <div 
                                                class="col-sm-12 col-xl-12 mb-3">
                                                    <label for="value" class="form-label ">Giá trị thông số <span class="text-danger text-small">(*)</span></label>
                                                    
                                                    <textarea 
                                                    type="text" class="form-control @error('value')is-invalid @enderror" name="value" rows="1" autocomplete="value"
                                                    placeholder="Kích thước màn hình,bộ nhớ,..." id="value" >
                                                        @isset($speciDetail) {{$speciDetail->value}} @else {{old('value')}} @endisset
                                                    </textarea>
                                                   
                                                    @error('value')
                                                        <div class="form-text text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div 
                                                class="col-sm-12 col-xl-12 mb-3">
                                                    <div 
                                                    class="card">
                                                        <div 
                                                        class="card-body pt-1 bg-light">
                                                            <h6 
                                                            class="fw-normal mb-3">Các setting khác</h6>
                                                            <div 
                                                            class="d-flex justify-content-start">
                                                                <div 
                                                                class="form-check form-switch">
                                                                    <input 
                                                                    class="form-check-input" type="checkbox" name="type_speci" autocomplete="off" id="type_speci" 
                                                                    @isset($speciDetail)
                                                                        {{$speciDetail->type_speci ? 'checked' : ''}}
                                                                    @endisset>
                                                                    <label 
                                                                    class="form-check-label" for="type_speci">Thông số đặc biệt</label>
                                                                </div>
>>>>>>> c9d1dfca9896e9bddfb26f1bf3ffb8733c1eac9d
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div 
                                                class="col-sm-12 col-xl-12 mb-3">
                                                    <label 
                                                    for="rep_speci_product_id" class="form-label">Thông số chung </label>
                                                    <select 
                                                    class="js-example-basic-single form-control" name="rep_speci_product_id" id="rep_speci_product_id">
                                                        <option value="" selected>Không có</option>
                                                        @isset($products)
                                                            @foreach ($products as $product)
                                                                <option 
                                                                value="{{$product->id}}" @isset($productSpecification) {{$productSpecification->product_id == $product->id ? 'selected':''}} @endisset >{{$product->name}}</option>
                                                            
                                                            @endforeach
                                                        @endisset

                                                    </select>                                         
                                                   
                                                    @error('name')
                                                        <div class="form-text text-danger">{{ $message }}</div>
                                                    @enderror

                                                </div>

                                                <div 
                                                class="col-sm-12 col-xl-12 mb-3">
                                                    <label 
                                                    for="position" class="form-label ">Thứ tự</label>
                                                    
                                                    <input 
                                                    type="number" name="position" class="form-control
                                                    @error('position') is-invalid @enderror" id="position"
                                                    value="@isset($productSpecification)1 {{$productSpecification->position}}@endisset"
                                                    autocomplete="position"
                                                    min="1"
                                                    placeholder="Nhập thứ tự hiển thị"
                                                    aria-describedby="position">

                                                    @error('position')
                                                        <div class="form-text text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div 
                                                class="col-sm-12 col-xl-12 mb-3">
                                                    <label 
                                                    for="show_hide" class="form-label">Trạng thái (mặc định sẽ là Hiện)</label>
                                                    
                                                    <select
                                                    class="form-select" name="show_hide" 
                                                    value="@isset($productSpecification) {{$productSpecification->show_hide}} @else {{old('show_hide')}} @endisset"
                                                    autocomplete="show_hide"
                                                    id="show_hide">

                                                        <option value="1">Hiện</option>
                                                        <option value="0">Ẩn</option>
                                                    </select>    
                                                </div>

                                                <div 
                                                class="col-sm-12 col-xl-12 mb-3">
                                                    <div class="d-flex justify-content-end">
                                                        @isset($productSpecification)
                                                            <button type="submit" class="btn btn-primary me-2">Sửa</button>
                                                            <a href="{{ route('specifi.create',['id' => $product->id]) }}">
                                                                <button type="button" class="float-right btn btn-secondary me-2">Đóng</button>
                                                            </a>                                            
                                                        @else
                                                            @if($productSpecificationCount > 0)
                                                                <a href="{{ route('varia.create',['id' => $product->id ]) }}">
                                                                    <button type="button" class="float-right btn btn-sm btn-secondary me-2">Màu sản phẩm</button>
                                                                </a>                                            
                                                                <a href="{{ route('product.index') }}">
                                                                    <button type="button" class="float-right btn btn-sm btn-secondary me-2">Đóng</button>
                                                                </a>                                            
                                                            @endif
                                                            <button type="submit" class="btn @if($productSpecificationCount > 0) btn-sm @endif btn-primary me-2">Thêm</button>
                                                        @endisset
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-xl-8">
                                    <div class="bg-white rounded h-100 p-2 text-start">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th scope="col" class="text-start">Action</th>
                                                        <th scope="col">Tên</th>
                                                        <th scope="col">Giá trị</th>
                                                        <th scope="col">Thông số thuộc</th>
                                                        <th scope="col">Loại</th>
                                                        <th scope="col">Ẩn Hiện</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @isset($productSpecifications)
                                                        @foreach ($productSpecifications as $productSpeci)
                                                            <tr>
                                                                <td>
                                                                    <div class="d-flex justify-content-evenly">
                                                                        <a class="@isset($productSpecification){{$productSpeci->id == $productSpecification->id ? 'd-none' : ''}} @endisset" href="{{ route('specifi.edit', ['id' => $productSpeci->id]) }}" title="Edit"  >
                                                                                <button class="btn btn-sm btn-primary">
                                                                                    Edit
                                                                                </button>
                                                                            </a>
                                                                        <form action="{{ route('specifi.delete', ['id' => $productSpeci->id]) }}" method="POST">
                                                                            @csrf
                                                                            @method('delete')
                                                                            <button class="btn btn-sm btn-danger" type="submit" title="Xóa">Xóa</button>
                                                                        </form>
                                                                    </div>
                                                                </td>
                                                                <td ><p>{{$productSpeci->speci->name}}</p></td>
                                                                <td ><p>{{ $productSpeci->value }}</p></td>
                                                                <td><p>
                                                                    @forelse ($products as $product)
                                                                        @if ($product->id == $productSpeci->rep_speci_product_id)
                                                                            {{ $product->name }}
                                                                            @break
                                                                        @endif
                                                                    @empty
                                                                        Không có
                                                                    @endforelse
                                                                </p></td>
                                                                <td ><p>{{$productSpeci->type_speci ? 'Đặc biệt' : 'Chung' }}</p></td>
                                                                <td ><p>{{$productSpeci->show_hide ? 'Hiện' : 'Ẩn' }}</p></td>
                                                        @endforeach
                                                    @else
                                                        <thead>
                                                            <tr>
                                                                <th scope="col" class="text-start">Action</th>
                                                                <th scope="col">Tên</th>
                                                                <th scope="col">Giá trị</th>
                                                                <th scope="col">Thông số thuộc</th>
                                                                <th scope="col">Ẩn Hiện</th>
                                                                <hr>
                                                            </tr>
                                                        </thead>
                                                    @endisset
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade @if($tab == 'speci') show active @endif " id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h5 class="card-title my-3">
                                        @isset($speciDetail)
                                            Sửa {{$speciDetail->name}}
                                        @else
                                            Thêm thông số
                                        @endisset
                                    </h5>                 
                                </div>
                                <div class="col-sm-6 col-xl-4">
                                    <div class="bg-white rounded h-100 p-3 text-start">
                                        <form 
                                            action="@isset($speciDetail) {{ route('speci.update',['id' => $speciDetail->id]) }} @else {{ route('speci.store') }} @endisset"
                                            method="post" >
                                            @csrf
                                            @isset($speciDetail) @method('put')
                                            @else  @method('post')
                                            @endisset
                                            <div class="row mb-3">
                                                <div class="col-sm-12 col-xl-12 mb-3">
                                                    <input 
                                                    type="text" value="{{$product->id}}" name="product_id" hidden>
                                                    
                                                    <label 
                                                    for="name" class="form-label">Tên thông số <span class="text-danger text-small">(*)</span></label>
                                                    
                                                    <textarea 
                                                    type="text" class="form-control" name="name" rows="1" autocomplete="name"
                                                    placeholder="Kích thước màn hình,bộ nhớ,..."
                                                    id="name">
                                                        @isset($speciDetail) {{$speciDetail->name}} @else {{old('name')}} @endisset
                                                    </textarea>
                                                   
                                                    @error('name')
                                                        <div class="form-text text-danger">{{ $message }}</div>
                                                    @enderror

                                                </div>
                                                <div class="col-sm-12 col-xl-12 mb-3">
                                                    <input 
                                                    type="text" value="{{$product->id}}" name="product_id" hidden>
                                                    
                                                    <label 
                                                    for="categories_product_id" class="form-label">Danh mục <span class="text-danger text-small">(*)</span></label>
                                                    
                                                    <select 
                                                    class="form-select" name="categories_product_id" id="categories_product_id" aria-label="Default select example">
                                                        @isset($categories)
                                                            @foreach ($categories as $category)
                                                            <option value="{{$category->id}}" 
                                                                @if ($category->id == $product->category->id) selected @endif >{{$category->name}}</option>
                                                            
                                                            @endforeach
                                                        @endisset
                                                    </select>

                                                </div>
                                               
                                            </div>
                                            <div class="col-sm-12 col-xl-12 mb-3">
                                                <div class="d-flex justify-content-end">
                                                    @isset($speciDetail)
                                                        <button 
                                                        type="submit" class="btn btn-sm btn-primary me-2">Sửa</button>
                                                        <a 
                                                        href="{{ route('specifi.create',['id' => $product->id]) }}">
                                                            <button type="button" class="float-right btn-sm btn-danger me-2">Đóng</button>
                                                        </a>                                            
                                                    @else
                                                        <button
                                                        type="submit" class="btn btn-sm btn-primary me-2">Thêm</button>
                                                        <a 
                                                        href="{{ route('product.index') }}">
                                                            <button
                                                            type="button" class="float-right btn btn-sm btn-secondary me-2">Thoát</button>
                                                        </a>                                            
                                                    @endisset

                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-xl-8">
                                    <div class="bg-white rounded h-100 p-2 text-start">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th scope="col" class="text-start">Action</th>
                                                        <th scope="col">Tên thông số</th>
                                                        <th scope="col">Danh mục</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @isset($specis)
                                                        @foreach ($specis as $speci)
                                                            <tr>
                                                                <td>
                                                                    <div 
                                                                    class="d-flex justify-content-around">
                                                                        <a  
                                                                        class="@isset($speciDetail) d-none @endisset" href="{{ route('speci.edit', ['productId'=> $product->id,'id' => $speci->id,'tab'=>'speci']) }}" title="Edit" >
                                                                            <button 
                                                                            class="btn btn-sm btn-primary">Edit</button>
                                                                        </a>
                                                                        <form action="{{ route('speci.delete', ['id' => $speci->id]) }}" method="POST">
                                                                            @csrf
                                                                            @method('delete')
                                                                            <button class="btn btn-sm btn-danger" type="submit" title="Xóa">Xóa</button>
                                                                        </form>
                                                                    </div>
                                                                </td>
                                                                <td ><p>{{$speci->name}}</p></td>
                                                                <td >
                                                                    <p>
                                                                    @isset($speci->category){{$speci->category->name}}
                                                                    @else Không có 
                                                                    @endisset
                                                                    </p>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <th scope="col" class="text-center" colspan="2">Chưa có thông số nào</th>                                                               
                                                        </tr>
                                                    @endisset
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
@endsection
