
<div class="modal fade" id="{{$modal}}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">
                @isset($shippingProvider)
                    Sửa chính sách {{$shippingProvider->name}}
                @else
                    Thêm nhà vận chuyển
                @endisset
            </h5>
            @isset($shippingProvider)
                <a href="{{ route('shipping.index') }}" class="btn-close" aria-label="Close"></a>
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
                            @isset($shippingProvider)
                                action="{{ route('shipping.update',['id'=>$shippingProvider->id]) }}"
                            @else
                                action="{{ route('shipping.store') }}"
                            @endisset
                            method="POST">
                                @csrf
                                @isset($shippingProvider)
                                    @method('put')
                                @else
                                    @method('post')
                                @endisset
                                <div class="mb-3">
                                    <label for="name" class="form-label ">Tên nhà vận chuyển <span class="text-danger text-small">*</span></label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                                    id="name"
                                    @isset($shippingProvider)
                                        value="{{$shippingProvider->name}}"
                                    @endisset
                                    placeholder="Nhập tên (vd:Giao hàng tiết kiệm,J&T,...)"
                                    autocomplete="name"
                                    aria-describedby="name">
                                    @error('name')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label ">Khu vực<span class="text-danger text-small">*</span></label>
                                    <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" 
                                    id="address"
                                    @isset($shippingProvider)
                                        value="{{$shippingProvider->address}}"
                                    @endisset
                                    placeholder="Nhập tên (vd:Hồ Chí Minh,Hà Nội,...)"
                                    autocomplete="address"
                                    aria-describedby="address">
                                    @error('address')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="shipping_cost" class="form-label">Phí vận chuyển</label>
                                    <input type="number" name="shipping_cost" class="form-control @error('shipping_cost')invalid @enderror" 
                                    @isset($shippingProvider)
                                        value="{{$shippingProvider->shipping_cost}}"
                                    @endisset
                                    placeholder="Nhập phí vận chuyển vd:30000 = 30.000đ"
                                    autocomplete="shipping_cost"
                                    id="shipping_cost">   
                                    @error('shipping_cost')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 float-end">
                                    <button type="submit" class="btn btn-primary">
                                        @isset($shippingProvider)
                                            Sửa
                                        @else
                                            Thêm mới
                                        @endisset
                                    </button>
                                    @isset($shippingProvider)
                                        <a href="{{ route('shipping.index') }}" class="btn btn-danger">Đóng </a>
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
