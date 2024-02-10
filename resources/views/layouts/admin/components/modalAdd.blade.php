
<div class="modal fade" id="{{$modalName}}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" 
aria-labelledby="{{$modalName}}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">
                @isset($table)
                    Sửa {{$title}} {{$brand->name}}
                @else
                    Thêm {{$title}}
                @endisset
            </h5>
            @isset($table)
                <a href="{{ route('table.index') }}" class="btn-close" aria-label="Close"></a>
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
                            @isset($table)
                                action="{{ route('table.update',['id'=>$table->id]) }}"
                            @else
                                action="{{ route('table.store') }}"
                            @endisset
                            method="POST">
                                @csrf
                                @isset($table)
                                @method('put')
                                @else
                                @method('post')
                                @endisset
                                @isset($inputs)
                                    @foreach ($inputs as $input)
                                    <div class="mb-3">
                                        <label for="name" class="form-label ">Tên thương hiệu <span class="text-danger text-small">*</span></label>
                                        <input type="text" name="name" class="form-control @error('name') 
                                        is-invalid
                                        @enderror" id="name"
                                        @isset($brand)
                                            value="{{$brand->name}}"
                                        @endisset
                                        placeholder="Nhập tên thương hiệu (vd:Apple,Samsung,...)"
                                            aria-describedby="name">
                                            @error('name')
                                                <div id="name" class="form-text text-danger">{{ $message }}</div>
                                            @enderror
                                    </div>
                                    @endforeach
                                @endisset
                                <div class="mb-3">
                                    <label for="show_hide" class="form-label">Trạng thái (mặc định sẽ là Hiện)</label>
                                    <select class="form-select" name="show_hide" 
                                    @isset($table)
                                        value="{{$table->show_hide}}"
                                    @endisset
                                    id="show_hide">
                                        <option value="show">Hiện</option>
                                        <option value="hide">Ẩn</option>
                                    </select>
                                </div>
                                <div class="mb-3 float-end ">
                                    <button type="submit" class="btn btn-primary">
                                        @isset($table)
                                        Sửa
                                    @else
                                        Thêm mới
                                    @endisset
                        
                                    </button>
                                    @isset($table)
                                    <a href="{{ route('table.index') }}" class="btn btn-danger">
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
