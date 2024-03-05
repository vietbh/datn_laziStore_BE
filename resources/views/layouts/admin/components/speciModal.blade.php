<div class="modal fade" id="addProductSpecialModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="true" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content mb-3">
            <div class="modal-header">
                <h5 class="modal-title">
                    @isset($product)
                        Sửa màu sản phẩm <strong>{{$product->name}}</strong>
                    @else
                        Thêm màu sắc
                    @endisset
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="container-fluid pt-4 px-4 mb-4" >
                    <div class="row g-4">
                        <div class="col-sm-12 col-xl-12">
                            <div class="bg-light rounded h-100 p-4 text-start">
                                @isset($product)
                                    @foreach ($product->variations as $variation)
                                        <div class="row mb-3">
                                            <div class="col-sm-12 col-xl-3 mb-3">
                                                <input type="text" name="colors" hidden>
                                                <label for="color_type" class="form-label">Màu sắc <span class="text-danger text-small">(*)</span></label>
                                                <input type="text" class="form-control" name="color_type"
                                                value="{{$variation->color_type}}"
                                                placeholder="Màu đen,màu vàng,..."
                                                id="color_type">
                                                @error('color_type')
                                                <div class="form-text text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-12 col-xl-3 mb-3">
                                                <label for="price" class="form-label ">Giá gốc(vnđ) <span class="text-danger text-small">(*)</span></label>
                                                <input type="text" name="price" class="form-control 
                                                @error('price') 
                                                    is-invalid
                                                @enderror" id="price" value="{{$variation->price / 1000}}"
                                                autocomplete="price"
                                                placeholder="Nhập giá tiền (vd:300=300.000đ)"
                                                aria-describedby="price">
                                                @error('price')
                                                    <div class="form-text text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-12 col-xl-3 mb-3">
                                                <label for="price_sale" class="form-label ">Giá khuyến mãi(vnđ) <span class="text-danger text-small">(*)</span></label>
                                                <input type="text" name="price_sale" class="form-control 
                                                @error('price_sale') 
                                                    is-invalid
                                                @enderror" id="price_sale"
                                                value="{{$variation->price_sale / 1000}}" autocomplete="price_sale"
                                                placeholder="Nhập giá tiền (vd:300=300.000đ)"
                                                aria-describedby="price_sale">
                                                @error('price_sale')
                                                    <div class="form-text text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-12 col-xl-3 mb-3">
                                                <label for="quantity" class="form-label ">Số lượng <span class="text-danger text-small">(*)</span></label>
                                                <input type="text" name="quantity" class="form-control \
                                                @error('quantity') 
                                                    is-invalid
                                                @enderror" id="quantity"
                                                value="{{$variation->quantity}}"
                                                autocomplete="quantity" placeholder="Nhập giá tiền (vd:300=300.000đ)"
                                                aria-describedby="quantity">
                                                @error('quantity')
                                                    <div  class="form-text text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-12 col-xl-12 mb-3">
                                                <label for="image_url" class="form-label ">Chọn hình ảnh <span class="text-danger text-small">(*)</span></label>
                                                <div class="d-flex justify-content-around">
                                                    <img src="{{$variation->image_url}}" class="rounded-3 me-2" width="100" height="100" aria-describedby="image_url">
                                                    <input type="file" name="image_url" class="form-control 
                                                    @error('image_url') 
                                                        is-invalid
                                                    @enderror" 
                                                    id="image_url"
                                                    value="{{$variation->image_url ?? old('image_url')}}"
                                                    autocomplete="image_url"
                                                    aria-describedby="image_url">
                                                    @error('image_url')
                                                        <div class="form-text text-danger">{{ $message }}</div>
                                                    @enderror
                                                    <button type="button" class="btn btn-secondary ms-1">Thêm nhiều hình ảnh</button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endisset
                                    {{-- <h6 id="initial-color"></h6> --}}
                                    <form action="{{ route('specifi.store') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method('post')
                                        <div class="row mb-3">
                                            <div class="col-sm-12 col-xl-6 mb-3">
                                                <label for="name" class="form-label">Màu sắc <span class="text-danger text-small">(*)</span></label>
                                                <input type="text" class="form-control" 
                                                name="name"
                                                @isset($product)
                                                    value="{{$product->name}}"
                                                @endisset
                                                value="Vàng"
                                                autocomplete="name"
                                                placeholder="Màu đen,màu vàng,..."
                                                id="name">
                                                @error('name')
                                                    <div class="form-text text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-12 col-xl-6 mb-3">
                                                <label for="price" class="form-label ">Giá gốc(vnđ) <span class="text-danger text-small">(*)</span></label>
                                                <input type="text" name="price" class="form-control @error('price') 
                                                is-invalid
                                                @enderror"
                                                id="price"
                                                value="50000"
    
                                                @isset($product)
                                                value="{{$product->price}}"
                                                @endisset
                                                placeholder="Nhập giá tiền (vd:300=300.000 vnđ)"
                                                aria-describedby="price">
                                                @error('price')
                                                    <div class="form-text text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-12 col-xl-6 mb-3">
                                                <label for="color_type" class="form-label">Màu sắc <span class="text-danger text-small">(*)</span></label>
                                                <input type="text" class="form-control" 
                                                name="color_type"
                                                @isset($product)
                                                value="{{$product->color_type}}"
                                                @endisset
                                                value="Vàng"
                                                autocomplete="color_type"
                                                placeholder="Màu đen,màu vàng,..."
                                                id="color_type">
                                                @error('color_type')
                                                    <div class="form-text text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-12 col-xl-6 mb-3">
                                                <label for="price" class="form-label ">Giá gốc(vnđ) <span class="text-danger text-small">(*)</span></label>
                                                <input type="text" name="price" class="form-control @error('price') 
                                                is-invalid
                                                @enderror"
                                                id="price"
                                                value="50000"
    
                                                @isset($product)
                                                value="{{$product->price}}"
                                                @endisset
                                                placeholder="Nhập giá tiền (vd:300=300.000 vnđ)"
                                                aria-describedby="price">
                                                @error('price')
                                                    <div class="form-text text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-2">Thêm màu</button>
                                            <button type="button" class="float-right btn btn-secondary me-2" data-bs-dismiss="modal">Đóng</button>
                                        </div>
                                    </form>
                                    <div id="formColor"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

