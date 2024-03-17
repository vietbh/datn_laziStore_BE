
<div class="modal fade" id="addPolicyModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">
                @isset($policy)
                    Sửa chính sách {{$policy->name}}
                @else
                    Thêm chính sách
                @endisset
            </h5>
            @isset($policy)
                <a href="{{ route('policy.index') }}" class="btn-close" aria-label="Close"></a>
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
                            @isset($policy)
                                action="{{ route('policy.update',['id'=>$policy->id]) }}"
                            @else
                                action="{{ route('policy.store') }}"
                            @endisset
                            method="POST">
                                @csrf
                                @isset($policy)
                                    @method('put')
                                @else
                                    @method('post')
                                @endisset
                                <div class="mb-3">
                                    <label for="name" class="form-label ">Tên chính sách <span class="text-danger text-small">*</span></label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                                    id="name"
                                    @isset($policy)
                                        value="{{$policy->name}}"
                                    @endisset
                                    placeholder="Nhập tên (vd:Chính sách bảo mật,Laptop,...)"
                                    autocomplete="name"
                                    aria-describedby="name">
                                    @error('name')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="value" class="form-label ">Nội dung <span class="text-danger text-small">*</span></label>
                                    <input type="text" name="value" class="form-control @error('value') is-invalid @enderror" 
                                    id="value"
                                    @isset($policy)
                                        value="{{$policy->value}}"
                                    @endisset
                                    placeholder="Nhập tên (vd:Chính sách bảo mật,Laptop,...)"
                                    autocomplete="value"
                                    aria-describedby="value">
                                    @error('value')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="position" class="form-label">Thứ tự của danh mục (Mặc định là 1)</label>
                                    <input type="number" name="position" class="form-control @error('position')invalid @enderror" 
                                    @isset($policy)
                                        value="{{$policy->position}}"
                                    @else
                                        value="1"
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
                                    @isset($policy)
                                        value="{{$policy->show_hide}}"
                                    @endisset
                                    id="show_hide">
                                        <option value="1">Hiện</option>
                                        <option value="0">Ẩn</option>
                                    </select>
                                </div>
                                <div class="mb-3 float-end">
                                    <button type="submit" class="btn btn-primary">
                                        @isset($policy)
                                            Sửa
                                        @else
                                            Thêm mới
                                        @endisset
                                    </button>
                                    @isset($policy)
                                        <a href="{{ route('policy.index') }}" class="btn btn-danger">Đóng </a>
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
