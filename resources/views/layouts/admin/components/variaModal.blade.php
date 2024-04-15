@extends('admin')
@section('content')
    <div class="container-fluid mt-5 mb-5" style="height: 120vh">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('product.edit', ['id'=>$product->id]) }}">Sản phẩm {{$product->name}}</a></li>
              <li class="breadcrumb-item active" aria-current="page">Thêm màu sắc</li>
            </ol>
        </nav>
        <div class="card bg-light">
            <div class="card-body p-1 m-3">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <h5 class="card-title my-3">
                                @isset($productVariation)
                                    Sửa 
                                @else
                                    Thêm màu sắc {{$product->name}}
                                @endisset
                            </h5>                 
                        </div>
                        <div class="col-sm-6 col-xl-4">
                            <div class="bg-white rounded h-100 p-3 text-start">
                                <form 
                                    @isset($productVariation)
                                        action="{{ route('varia.update',['id' => $productVariation->id]) }}"
                                    @else
                                        action="{{ route('varia.store') }}"
                                    @endisset
                                    method="post" enctype="multipart/form-data">
                                    @csrf
                                    @isset($productVariation)
                                        @method('put')
                                    @else   
                                        @method('post')
                                    @endisset
                                    <div class="row mb-3">
                                        <div class="col-sm-12 col-xl-12 mb-3">
                                            <input type="text" value="{{$product->id}}" name="product_id" hidden>
                                            <label for="color_type" class="form-label">Màu sắc <span class="text-danger text-small">(*)</span></label>
                                            <input type="text" class="form-control
                                            @error('color_type') 
                                                is-invalid
                                            @enderror" 
                                            name="color_type"
                                            @isset($productVariation)
                                                value="{{$productVariation->color_type}}"
                                            @else
                                                value="{{old('color_type')}}"
                                            @endisset
                                            autocomplete="color_type"
                                            placeholder="Màu đen,màu vàng,..."
                                            id="color_type">
                                            @error('color_type')
                                                <div class="form-text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-sm-12 col-xl-12 mb-3">
                                            <label for="price" class="form-label ">Giá gốc <span class="text-danger text-small">(*Giá tiền x 1000đ)</span></label>
                                            <input type="text" name="price" class="form-control @error('price') 
                                            is-invalid
                                            @enderror"
                                            id="price"
                                            @isset($productVariation)
                                                value="{{$productVariation->price / 1000}}"
                                            @else
                                                value="{{old('price')}}"
                                            @endisset
                                            autocomplete="price"
                                            placeholder="Nhập giá tiền (vd:300=300.000 vnđ)"
                                            aria-describedby="price">
                                            @error('price')
                                                <div class="form-text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-sm-12 col-xl-12 mb-3">
                                            <label for="price_sale" class="form-label ">Giá khuyến mãi <span class="text-danger text-small">(*Giá tiền x 1000đ)</span></label>
                                            <input type="text" name="price_sale" class="form-control
                                            @error('price_sale') 
                                            is-invalid
                                            @enderror"
                                            id="price_sale"
                                            @isset($productVariation)
                                                value="{{$productVariation->price_sale /1000}}"
                                            @else
                                                value="{{old('price_sale')}}"
                                            @endisset
                                            autocomplete="price_sale"
                                            placeholder="Nhập giá tiền (vd:300=300.000đ)"
                                            aria-describedby="price_sale">
                                            @error('price_sale')
                                                <div class="form-text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-sm-12 col-xl-12 mb-3">
                                            <label for="quantity" class="form-label ">Số lượng <span class="text-danger text-small">(*)</span></label>
                                            <input 
                                            type="number" name="quantity" class="form-control 
                                            @error('quantity') is-invalid @enderror" 
                                            id="quantity" min="1"
                                            @isset($productVariation)
                                                value="{{$productVariation->quantity}}"
                                            @else
                                                value="{{old('quantity')}}"
                                            @endisset
                                            autocomplete="quantity"
                                            placeholder="Nhập số lượng sản phẩm"
                                            aria-describedby="quantity">
                                            @error('quantity')
                                                <div class="form-text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-sm-12 col-xl-12 mb-3">
                                            <label for="position" class="form-label ">Vị trí (Mặc định là 1)</label>
                                            <input type="number" name="position"
                                            class="form-control 
                                            @error('position') 
                                                is-invalid
                                            @enderror" 
                                            id="position"
                                            @isset($productVariation)
                                                value="{{$productVariation->position}}"
                                            @else
                                                value="1"
                                            @endisset
                                            autocomplete="position"
                                            placeholder="Nhập số lượng sản phẩm"
                                            aria-describedby="position">
                                            @error('position')
                                                <div class="form-text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        @isset($productVariation)
                                            <div class="col-sm-12 col-xl-12 mb-3">
                                                <img src="{{$productVariation->image_url}}" class="img-fluid" width="200" alt="">
                                            </div>
                                        @endisset
                                        <div class="col-sm-12 col-xl-12 mb-3">
                                            <label for="image_url" class="form-label">Chọn hình ảnh <span class="text-danger text-small">(*)</span></label>
                                            <input type="file" name="image_url" class="form-control 
                                            @error('image_url') 
                                                is-invalid
                                            @enderror" 
                                            id="image_url"
                                            aria-describedby="image_url">
                                            @error('image_url')
                                                <div class="form-text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-sm-12 col-xl-12 mb-3">
                                            <label for="show_hide" class="form-label">Trạng thái (mặc định sẽ là Hiện)</label>
                                            <select class="form-select" name="show_hide" 
                                            @isset($productVariation)
                                                value="{{$productVariation->show_hide}}"
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
                                                @isset($productVariation)
                                                    <button type="submit" class="btn btn-primary me-2">Sửa</button>
                                                    <a href="{{ route('varia.create',['id'=>$product->id]) }}">
                                                        <button type="button" class="float-right btn btn-secondary me-2">Đóng</button>
                                                    </a>                                            
                                                @else
                                                    @if($productVariationCount > 0)
                                                        <a href="{{ route('specifi.create',['id'=>$product->id]) }}">
                                                            <button type="button" class="float-right btn btn-sm btn-secondary me-2">Thông số</button>
                                                        </a>      
                                                        <a href="{{ route('product.index') }}">
                                                            <button type="button" class="float-right btn btn-sm btn-secondary me-2">Đóng</button>
                                                        </a> 
                                                    @endif
                                                    <button type="submit" class="btn  @if($productVariationCount > 0) btn-sm @endif btn-primary me-2">Thêm</button>
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
                                                <th scope="col">Hình ảnh</th>
                                                <th scope="col">Màu sắc</th>
                                                <th scope="col">Giá</th>
                                                <th scope="col">Giá khuyến mãi</th>
                                                <th scope="col">Số lượng</th>
                                                <th scope="col" class="text-start" colspan="2">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @isset($productVariations)
                                                @foreach ($productVariations as $variation)
                                                    <tr>
                                                        <td><img src="{{$variation->image_url}}" class="rounded-3 me-2" width="100" height="100" aria-describedby="image_url"></td>
                                                        <td ><p>{{$variation->color_type}}</p></td>
                                                        <td ><p>{{number_format($variation->price,0,2)}}<span class="text-sm">đ</span></p></td>
                                                        <td ><p>{{number_format($variation->price_sale,0,2)}}<span class="text-sm">đ</span></p></td>
                                                        <td ><p>{{$variation->quantity}}<span class="text-sm"> chiếc</span></p></p></td>
                                                        <td>
                                                            <div class="d-flex justify-content-evenly">
                                                                <a href="{{ route('varia.edit', ['id'=>$variation->id]) }}" class="
                                                                    @isset($productVariation)
                                                                        {{$productVariation->id == $variation->id ? 'd-none' : ''}}
                                                                    @endisset"
                                                                     title="Edit">
                                                                    <button class="btn btn-sm btn-primary">Edit</button>
                                                                </a>
                                                                <form action="{{ route('varia.delete', ['id' =>$variation->id]) }}" method="POST">
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
                                                        <th scope="col">Hình ảnh</th>
                                                        <th scope="col">Màu sắc</th>
                                                        <th scope="col">Giá</th>
                                                        <th scope="col">Giá khuyến mãi</th>
                                                        <th scope="col">Số lượng</th>
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