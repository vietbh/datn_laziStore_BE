<div class="modal-content mb-3">
    <div class="modal-header">
        <h5 class="modal-title">
            @isset($product)
                Sửa màu sản phẩm <strong>{{$product->name}}</strong>
            @else
                Thêm màu sắc
            @endisset
        </h5>
        <button type="button" class="float-right btn btn-primary w-10 me-2" id="addColor">Thêm màu</button>
    </div>
    <div class="modal-body p-0">
        <div class="container-fluid pt-4 px-4 mb-4" >
            <div class="row g-4">
                <div class="col-sm-12 col-xl-12">
                    <div class="bg-light rounded h-100 p-4 text-start">
                        @isset($product)
                            @foreach ($product->variations as $product)
                            <div class="row mb-3">
                                <div class="col-sm-12 col-xl-3 mb-3">
                                    <input type="text" name="colors" hidden>
                                    <label for="color_type" class="form-label">Màu sắc <span class="text-danger text-small">(*)</span></label>
                                    <input type="text" class="form-control" name="color_type"
                                    @isset($product)
                                    value="{{$product->color_type}}"
                                    @endisset
                                    placeholder="Màu đen,màu vàng,..."
                                    id="color_type">
                                    @error('color_type')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-12 col-xl-3 mb-3">
                                    <label for="price" class="form-label ">Giá gốc(vnđ) <span class="text-danger text-small">(*)</span></label>
                                    <input type="text" name="price" class="form-control @error('price') 
                                    is-invalid
                                    @enderror"
                                    id="price"
                                    @isset($product)
                                    value="{{$product->price}}"
                                    @endisset
                                    placeholder="Nhập giá tiền (vd:300=300.000đ)"
                                    aria-describedby="price">
                                    @error('price')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-12 col-xl-3 mb-3">
                                    <label for="price_sale" class="form-label ">Giá khuyến mãi(vnđ) <span class="text-danger text-small">(*)</span></label>
                                    <input type="text" name="price_sale" class="form-control @error('price_sale') 
                                    is-invalid
                                    @enderror" id="price_sale"
                                    @isset($product)
                                        value="{{$product->price_sale}}"
                                    @endisset
                                    placeholder="Nhập giá tiền (vd:300=300.000đ)"
                                        aria-describedby="price_sale">
                                    @error('price_sale')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-12 col-xl-3 mb-3">
                                    <label for="quantity" class="form-label ">Số lượng <span class="text-danger text-small">(*)</span></label>
                                    <input type="text" name="quantity" class="form-control @error('quantity') 
                                    is-invalid
                                    @enderror" id="quantity"
                                    @isset($product)
                                        value="{{$product->quantity}}"
                                    @endisset
                                    placeholder="Nhập giá tiền (vd:300=300.000đ)"
                                    aria-describedby="quantity">
                                    @error('quantity')
                                        <div  class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            @endforeach
                        @else
                            <h6 id="initial-color"></h6>
                            <div class="row mb-3">
                                <div class="col-sm-12 col-xl-3 mb-3">
                                    <input type="text" name="colors" hidden>
                                    <label for="color_type" class="form-label">Màu sắc <span class="text-danger text-small">(*)</span></label>
                                    <input type="text" class="form-control" 
                                    name="color_type"
                                    @isset($product)
                                    value="{{$product->color_type}}"
                                    @endisset
                                    value="vàng"
                                    placeholder="Màu đen,màu vàng,..."
                                    id="color_type">
                                    @error('color_type')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-12 col-xl-3 mb-3">
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
                                <div class="col-sm-12 col-xl-3 mb-3">
                                    <label for="price_sale" class="form-label ">Giá khuyến mãi(vnđ) <span class="text-danger text-small">(*)</span></label>
                                    <input type="text" name="price_sale" class="form-control
                                    @error('price_sale') 
                                    is-invalid
                                    @enderror"
                                    id="price_sale"
                                    value="4000"

                                    @isset($product)
                                        value="{{$product->price_sale}}"
                                    @endisset
                                    placeholder="Nhập giá tiền (vd:300=300.000đ)"
                                        aria-describedby="price_sale">
                                    @error('price_sale')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-12 col-xl-3 mb-3">
                                    <label for="quantity" class="form-label ">Số lượng <span class="text-danger text-small">(*)</span></label>
                                    <input type="text" 
                                    name="quantity"
                                    value="50"
                                    class="form-control 
                                    @error('quantity') 
                                    is-invalid
                                    @enderror" 
                                    id="quantity"
                                    @isset($product)
                                        value="{{$product->quantity}}"
                                    @endisset
                                    placeholder="Nhập số lượng sản phẩm"
                                    aria-describedby="quantity">
                                    @error('quantity')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        @endisset
                            <div id="formColor"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

