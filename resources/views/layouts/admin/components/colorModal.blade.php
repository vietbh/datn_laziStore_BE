<script type="module"> 
    var myModal = new bootstrap.Modal(document.getElementById('addProductColorModal'), {
    keyboard: false
    })

    function closeModalColor(){
        return myModal.hide();
    };

    document.getElementById('closeColor').addEventListener('click', closeModalColor);
    document.getElementById('submitColor').addEventListener('click', closeModalColor);
    // add input color
    // Vanilla JavaScript
    let id = 1;
    let arrId = [];
    const formColor = document.getElementById('formColor');
    function createInputSection(inputId) {
    return `
        <div class="${inputId}" id="inputColor">
        <h6>Chọn màu ${inputId}</h6>
        <hr/>
        <div class="row mb-3">
            <div class="col-sm-12 col-xl-3 mb-3">
                    <label for="color_type" class="form-label">Màu sắc <span class="text-danger text-small">(*)</span></label>
                    <input type="color" class="form-control h-50" name="color_type"
                    @isset($product)
                    value="{{$product->color_type}}"
                    @endisset
                    id="color_type">
                </div>
                <div class="col-sm-12 col-xl-3 mb-3">
                    <label for="price" class="form-label ">Giá gốc(vnđ) <span class="text-danger text-small">(*)</span></label>
                    <input type="text" name="price" class="form-control @error('price') 
                    is-invalid
                    @enderror" id="price"
                    @isset($product)
                        value="{{$product->price}}"
                    @endisset
                    placeholder="Nhập giá tiền (vd:300=300.000đ)"
                        aria-describedby="price">
                        @error('price')
                            <div id="price" class="form-text text-danger">{{ $message }}</div>
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
                            <div id="price_sale" class="form-text text-danger">{{ $message }}</div>
                        @enderror
                </div>
                <div class="col-sm-12 col-xl-3 mb-3">
                    <label for="quantity" class="form-label">Số lượng <span class="text-danger text-small">(*)</span></label>
                    <div class="d-flex justify-content-around">
                        <input type="text" name="quantity" class="form-control h-55 @error('quantity') 
                        is-invalid
                        @enderror" id="quantity"
                        @isset($product)
                            value="{{$product->quantity}}"
                        @endisset
                        placeholder="Nhập giá tiền (vd:300=300.000đ)"
                            aria-describedby="quantity">
                            @error('quantity')
                                <div id="quantity" class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        <button type="button" class="btn-close mt-2 ms-1 delete-color" data-input="${inputId}" aria-label="Close"></button>
                    </div>
                </div>
        </div>
        </div>
    `;
    }
    function addInput() {
    const inputId = `i${++id}`;
    const inputSection = createInputSection(inputId);
    formColor.insertAdjacentHTML('beforeend', inputSection);
    }

    function deleteInput(inputId) {
    const inputElement = document.querySelector(`.${inputId}`);
    if (inputElement) {
        inputElement.remove();   
    }
    }

    formColor.addEventListener('click', function(event) {
    if (event.target.classList.contains('delete-color')) {
        const inputId = event.target.dataset.input;
        deleteInput(inputId);
    }
    });
    //Jquery
    // $()=document
    document.getElementById('addColor').addEventListener('click', addInput);
</script>

<div class="modal fade" id="addProductColorModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    @isset($product)
                        Sửa màu sản phẩm <strong>{{$product->name}}</strong>
                    @else
                        Thêm màu sắc
                    @endisset
                </h5>
                <button type="button" class="float-right btn btn-primary w-10 me-2" id="addColor">Thêm màu</button>
            {{-- <button type="button" class="btn-close" name="closeColor" aria-label="Close"></button> --}}
            </div>
            <div class="modal-body p-0">
                <div class="container-fluid pt-4 px-4 mb-4" >
                    <div class="row g-4">
                        <div class="col-sm-12 col-xl-12">
                            <div class="bg-light rounded h-100 p-4 text-start">
                                    <div class="row mb-3">
                                        <div class="col-sm-12 col-xl-3 mb-3">
                                            <label for="color_type" class="form-label">Màu sắc <span class="text-danger text-small">(*)</span></label>
                                            <input type="color" class="form-control" name="color_type"
                                            @isset($product)
                                            value="{{$product->color_type}}"
                                            @endisset
                                            id="color_type">
                                            @error('color_type')
                                            <div id="color_type" class="form-text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-sm-12 col-xl-3 mb-3">
                                            <label for="price" class="form-label ">Giá gốc(vnđ) <span class="text-danger text-small">(*)</span></label>
                                            <input type="text" name="price" class="form-control @error('price') 
                                            is-invalid
                                            @enderror" id="price"
                                            @isset($product)
                                                value="{{$product->price}}"
                                            @endisset
                                            placeholder="Nhập giá tiền (vd:300=300.000đ)"
                                                aria-describedby="price">
                                                @error('price')
                                                    <div id="price" class="form-text text-danger">{{ $message }}</div>
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
                                                    <div id="price_sale" class="form-text text-danger">{{ $message }}</div>
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
                                                    <div id="quantity" class="form-text text-danger">{{ $message }}</div>
                                                @enderror
                                        </div>
    
                                    </div>
                                    <div id="formColor"></div>
                                    <div class="mb-3 d-flex justify-content-center">
                                        <button type="button" class="btn btn-primary w-25 me-2" id="submitColor">Xác nhận</button>
                                        <button type="button" class="btn btn-danger w-25" id="closeColor">Đóng</button>
                                    </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

