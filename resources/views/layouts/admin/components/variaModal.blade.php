<div class="modal fade" id="addProductVariationModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="true" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
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
                        <div class="col-sm-12 col-xl-5">
                            @isset($productVariation)
                                <h5>Sửa màu sắc</h5>
                            @else
                                <h5>Thêm màu sắc</h5>
                            @endisset
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
                                    <div class="col-sm-12 col-xl-6 mb-3">
                                        <label for="color_type" class="form-label">Màu sắc <span class="text-danger text-small">(*)</span></label>
                                        <input type="text" class="form-control" 
                                        name="color_type"
                                        @isset($productVariation)
                                            value="{{$productVariation->color_type}}"
                                        @else
                                            value="Vàng"
                                        @endisset
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
                                        @isset($productVariation)
                                            value="{{$productVariation->price /1000}}"
                                        @else
                                            value="50000"
                                        @endisset
                                        autocomplete="price"
                                        placeholder="Nhập giá tiền (vd:300=300.000 vnđ)"
                                        aria-describedby="price">
                                        @error('price')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 col-xl-6 mb-3">
                                        <label for="price_sale" class="form-label ">Giá khuyến mãi(vnđ) <span class="text-danger text-small">(*)</span></label>
                                        <input type="text" name="price_sale" class="form-control
                                        @error('price_sale') 
                                        is-invalid
                                        @enderror"
                                        id="price_sale"
                                        @isset($productVariation)
                                            value="{{$productVariation->price_sale /1000}}"
                                        @else
                                            value="4000"
                                        @endisset
                                        autocomplete="price_sale"
                                        placeholder="Nhập giá tiền (vd:300=300.000đ)"
                                        aria-describedby="price_sale">
                                        @error('price_sale')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 col-xl-6 mb-3">
                                        <label for="quantity" class="form-label ">Số lượng <span class="text-danger text-small">(*)</span></label>
                                        <input type="text"name="quantity"
                                        class="form-control 
                                        @error('quantity') 
                                            is-invalid
                                        @enderror" 
                                        id="quantity"
                                        @isset($productVariation)
                                            value="{{$productVariation->quantity}}"
                                        @else
                                            value="50"
                                        @endisset
                                        autocomplete="quantity"
                                        placeholder="Nhập số lượng sản phẩm"
                                        aria-describedby="quantity">
                                        @error('quantity')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    @isset($productVariation)
                                        <div class="col-sm-12 col-xl-12 mb-3">
                                            <img src="{{$productVariation->image_url}}" class="img-fluid" width="200" alt="">
                                        </div>
                                    @endisset
                                    <div class="col-sm-12 col-xl-12 mb-3">
                                        <label for="image_url" class="form-label ">Chọn hình ảnh <span class="text-danger text-small">(*)</span></label>
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
                                    <div class="d-flex justify-content-end">
                                        @isset($productVariation)
                                            <button type="submit" class="btn btn-primary me-2">Sửa</button>
                                            <a href="{{ route('product.create') }}">
                                                <button type="button" class="float-right btn btn-secondary me-2">Đóng</button>
                                            </a>                                            
                                        @else
                                            <button type="submit" class="btn btn-primary me-2">Thêm</button>
                                        @endisset
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-sm-12 col-xl-7">
                            <div class="bg-light rounded h-100 p-4 text-start">
                                <table class="table table-hover">
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
                                    @isset($productVariationsCreate)
                                        @foreach ($productVariationsCreate as $variation)
                                            <tr>
                                                <td><img src="{{$variation->image_url}}" class="rounded-3 me-2" width="100" height="100" aria-describedby="image_url"></td>
                                                <td ><p>{{$variation->color_type}}</p></td>
                                                <td ><p>{{number_format($variation->price,0,2)}}<span class="text-sm">đ</span></p></td>
                                                <td ><p>{{number_format($variation->price_sale,0,2)}}<span class="text-sm">đ</span></p></td>
                                                <td ><p>{{$variation->quantity}}<span class="text-sm"> chiếc</span></p></p></td>
                                                <td>
                                                    <div class="d-flex justify-content-evenly">
                                                        <a href="{{ route('varia.edit', ['id'=>$variation->id]) }}" title="Edit">
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

