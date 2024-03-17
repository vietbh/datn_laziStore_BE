
<div class="modal fade" id="addBrandsModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                @isset($brand)
                    Sửa danh mục sản phẩm {{$brand->name}}
                @else
                    Thêm danh mục sản phẩm
                @endisset
            </h5>
            @isset($brand)
                <a href="{{ route('brand.index') }}" class="btn-close" aria-label="Close">
                </a>
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
                            @isset($brand)
                                action="{{ route('brand.update',['id'=>$brand->id]) }}"
                            @else
                                action="{{ route('brand.store') }}"
                            @endisset
                            method="POST">
                                @csrf
                                @isset($brand)
                                    @method('put')
                                @else
                                    @method('post')
                                @endisset
                                <div class="mb-3">
                                    <label for="name" class="form-label ">Tên danh mục <span class="text-danger text-small">*</span></label>
                                    <input type="text" 
                                    name="name"
                                     class="form-control @error('name') 
                                    is-invalid
                                    @enderror" 
                                    id="name"
                                    @isset($brand)
                                        value="{{$brand->name}}"
                                    @endisset
                                    placeholder="Nhập tên của danh mục (vd:Đồng hồ,Laptop,...)"
                                    autocomplete="name"
                                    aria-describedby="name">
                                    @error('name')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="country" class="form-label">Quốc gia(*)</label>
                                    <input type="text" name="country" class="form-control" 
                                    @isset($brand)
                                        value="{{$brand->country}}"
                                    @else
                                        value="{{old('country')}}"
                                    @endisset
                                    placeholder="Nhập thứ tự hiện của danh mục"
                                    autocomplete="country"
                                    id="country">   
                                    @error('country')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="position" class="form-label">Thứ tự (Mặc định là 1)</label>
                                    <input type="number" name="position" class="form-control" 
                                    @isset($brand)
                                        value="{{$brand->position}}"
                                    @else
                                        value="{{old('position')}}"
                                    @endisset
                                    placeholder="Nhập thứ tự hiện của danh mục"
                                    autocomplete="position"
                                    id="position">   
                                    @error('position')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="show_hide" class="form-label">Trạng thái (mặc định sẽ là Hiện)</label>
                                    <select class="form-select" name="show_hide" 
                                    @isset($brand)
                                        value="{{$brand->show_hide}}"
                                    @endisset
                                    id="show_hide">
                                        <option value="1">Hiện</option>
                                        <option value="0">Ẩn</option>
                                    </select>
                                </div>
                                <div class="mb-3 float-end">
                                    <button type="submit" class="btn btn-primary">
                                        @isset($brand)
                                            Sửa
                                        @else
                                            Thêm mới
                                        @endisset
                                    </button>
                                    @isset($brand)
                                        <a href="{{ route('brand.index') }}" class="btn btn-danger">
                                            Đóng
                                        </a>
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
