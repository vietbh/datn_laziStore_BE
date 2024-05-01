
<div class="modal fade" id="addDiscModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">
            @isset($discount)
                Sửa mã {{$discount->discount_code}}
            @else
                Thêm mã giảm giá
            @endisset
        </h5>
        @isset($discount)
            <a href="{{ route('discount.index') }}" class="btn-close" aria-label="Close"></a>
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
                            action=" @isset($discount) {{ route('discount.update',['id'=>$discount->id]) }} @else {{ route('discount.store') }} @endisset"                            
                            method="POST">
                                @csrf
                                @isset($discount) @method('put')
                                @else @method('post')
                                @endisset
                                <div class="mb-3 ">
                                    <label for="discount_code" class="form-label ">Tên mã <span class="text-danger text-small">*</span></label>
                                    <input type="text" name="discount_code" class="form-control
                                    @error('discount_code') 
                                        is-invalid
                                    @enderror" id="discount_code"
                                    @isset($discount)
                                        value="{{$discount->discount_code}}"
                                    @endisset
                                    placeholder="Nhập tên mã và không dấu (vd:giam20k,freeshiptoanquoc,...)"
                                    aria-describedby="discount_code">
                                    @error('discount_code')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="discount_price" class="form-label">Số tiền giảm(đ) <span class="text-danger text-sm">(*)</span></label>
                                    <input type="text" name="discount_price" class="form-control" 
                                    autocomplete="discount_price"
                                    @isset($discount)
                                        value="{{ $discount->discount_price }}"
                                    @endisset
                                    placeholder="Nhập số tiền giảm"
                                    id="discount_price">   
                                    @error('discount_price')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="discount_total" class="form-label">Số lượng</label>
                                    <input type="text" name="discount_total" class="form-control" 
                                    @isset($discount)
                                        value="{{$discount->discount_total}}"
                                    @endisset
                                    placeholder="Nhập số lượng mã"
                                    autocomplete="discount_total"
                                    id="discount_total">   
                                    @error('discount_total')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                          
                                <div class="row mb-3">
                                    <div class="col-lg-6 col-sm-12">
                                        <label for="start_date" class="form-label">Ngày bắt đầu</label>
                                        <input type="datetime-local" name="start_date" class="form-control" 
                                        @isset($discount)
                                            value="{{$discount->start_date}}"
                                        @endisset
                                        autocomplete="start_date"
                                        id="start_date">   
                                        @error('start_date')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 col-sm-12">
                                        <label for="end_date" class="form-label">Ngày kết thúc</label>
                                        <input type="datetime-local" name="end_date" class="form-control" 
                                        @isset($discount)
                                            value="{{$discount->end_date}}"
                                        @endisset
                                        autocomplete="end_date"
                                        id="end_date">   
                                        @error('end_date')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg-6">
                                        <label for="show_hide" class="form-label">Ẩn hiện (mặc định sẽ là Hiện)</label>
                                        <select class="form-select" name="show_hide" 
                                        @isset($discount)
                                            value="{{$discount->show_hide}}"
                                        @endisset
                                        id="show_hide">
                                            <option value='1' >Hiện</option>
                                            <option value='0' >Ẩn</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="discount_status" class="form-label">Trạng thái mã</label>
                                        <div class="form-control">
                                            <div class="form-check form-switch">
                                                <input 
                                                class="form-check-input" name="discount_status" @isset($discount) @checked($discount->status) @endisset type="checkbox" id="discount_status">
                                                <label class="form-check-label" for="discount_status">Kích hoạt </label>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 float-end">
                                    <button type="submit" class="btn btn-primary">
                                    @isset($discount) Sửa
                                    @else Thêm mới
                                    @endisset
                                    </button>

                                    @isset($discount) <a href="{{ route('discount.index') }}" class="btn btn-danger">Đóng</a>
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
    </div>
</div>
