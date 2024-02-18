<div class="modal fade" id="{{$modal['id']}}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="true" aria-labelledby="{{$modal['id']}}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">
                @isset($model)
                    Sửa {{$modal['title']}}
                @else
                    Thêm {{$modal['title']}}
                @endisset
            </h5>
            @isset($model)
                <a href="{{ route($modal['route']['index']) }}" class="btn-close" aria-label="Close"></a>
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
                            @isset($model)
                                action="{{ route($modal['route']['update'],['id'=>$model->id]) }}"
                            @else
                                action="{{ route($modal['route']['store']) }}"
                            @endisset
                            method="POST">
                                @csrf
                                @isset($model)
                                    @method('put')
                                @else
                                    @method('post')
                                @endisset
                                @isset($modal)
                                    @foreach ($modal['selections'] as $label =>$v)
                                         @foreach ($v as $name => $place)
                                            <div class="mb-3">
                                                <label for="name" class="form-label ">{{$label}} <span class="text-danger text-small">*</span></label>
                                                <input type="text" name="{{$name}}" class="form-control 
                                                @error($name) 
                                                    is-invalid
                                                @enderror"
                                                id="{{$name}}"
                                                @isset($model)
                                                    value="{{$model->$name}}"
                                                @else
                                                    value="{{old($name)}}"
                                                @endisset
                                                placeholder="{{$place}}"
                                                autocomplete="{{$name}}"
                                                aria-describedby="{{$name}}">
                                                @error($name)
                                                    <div class="form-text text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>        
                                        @endforeach
                                    @endforeach
                                @endisset
                                @isset($modal['inputSelect'])
                                    @foreach ($modal['inputSelect'] as $label =>$v)
                                        @foreach ($v as $name => $place)
                                            <div class="mb-3">
                                                <label for="{{$name}}" class="form-label">{{$label}}</label>
                                                <select class="form-select" 
                                                name="{{$name}}" 
                                                @isset($modal['model'])
                                                    value="{{$modal['model']->parent_category_id}}"
                                                @endisset
                                                autocomplete="{{$name}}"
                                                id="{{$name}}">
                                                    <option value='' selected>{{$place}}</option>
                                                    @isset($categories_parent)
                                                        @foreach ($categories_parent as $category_parent)
                                                            <option value="{{$category_parent->id}}">{{$category_parent->name}}</option>
                                                        @endforeach
                                                    @endisset
                                                </select>
                                            </div>
                                        @endforeach
                                    @endforeach
                                @endisset
                                <div class="mb-3">
                                    <label for="show_hide" class="form-label">Trạng thái (mặc định sẽ là Hiện)</label>
                                    <select class="form-select" name="show_hide" 
                                    @isset($model)
                                        value="{{$model->show_hide}}"
                                    @else
                                        value="{{old('show_hide')}}"
                                    @endisset
                                    id="show_hide">
                                        <option value="1">Hiện</option>
                                        <option value="0">Ẩn</option>
                                    </select>
                                </div>
                                <div class="mb-3 float-end ">
                                    <button type="submit" class="btn btn-primary">
                                        @isset($model)
                                            Sửa
                                        @else
                                            Thêm mới
                                        @endisset
                                    </button>
                                    @isset($model)
                                        <a href="{{ route($modal['route']['index']) }}" class="btn btn-danger">Đóng</a>
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
