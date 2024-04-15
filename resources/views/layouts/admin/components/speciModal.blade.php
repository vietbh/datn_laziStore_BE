@extends('admin')
@section('content')
    <div class="container-fluid mt-5 mb-5" style="height: 85vh">
        <div class="card bg-light">
            <div class="card-body p-1 m-3">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                  <li class="breadcrumb-item"><a href="{{ route('product.edit', ['id'=>$product->id]) }}">Sản phẩm {{$product->name}}</a></li>
                                  <li class="breadcrumb-item active" aria-current="page">Thêm thông số sản phẩm</li>
                                </ol>
                            </nav>
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
                                    @isset($productSpecification)
                                        action="{{ route('specifi.update',['id' => $productSpecification->id]) }}"
                                    @else
                                        action="{{ route('specifi.store') }}"
                                    @endisset
                                    method="post" enctype="multipart/form-data">
                                    @csrf
                                    @isset($productSpecification)
                                        @method('put')
                                    @else   
                                        @method('post')
                                    @endisset
                                    <div class="row mb-3">
                                        <div class="col-sm-12 col-xl-12 mb-3">
                                            <input type="text" value="{{$product->id}}" name="product_id" hidden>
                                            <label for="name" class="form-label">Tên thông số <span class="text-danger text-small">(*)</span></label>
                                            <input type="text" class="form-control" 
                                            name="name"
                                            @isset($productSpecification)
                                                value="{{$productSpecification->name}}"
                                            @else
                                                value="{{old('name')}}"
                                            @endisset
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
                                                            </div>
                                                        </td>
                                                @endforeach
                                            @else
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Id</th>
                                                        <th scope="col">Hình ảnh</th>
                                                        <th scope="col">Màu sắc</th>
                                                        <th scope="col">Giá</th>
                                                        <th scope="col">Giá khuyến mãi</th>
                                                        <th scope="col">Số lượng</th>
                                                        <th scope="col"></th>
                                                        <th scope="col" class="text-start" colspan="2">Action</th>
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
            </div>
        </div>
    </div>
@endsection