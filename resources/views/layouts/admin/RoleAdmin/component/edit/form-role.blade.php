<div class="bg-light p-4 rounded" style="min-height: 85vh;">
    <div class="row ">
        <div class="col-lg-5">
            <div class="card">
                <div class="card-body">
                    <h5>
                    @isset ($role)Chỉnh sửa quyền <strong>{{$role->role_name}}</strong>
                    @else Thêm mới quyền    
                    @endisset </h5>
                    <hr>
                    <form 
                    class="row g-3" action="@isset ($role){{ route('admin.update') }} 
                    @else {{ route('admin.store') }} 
                    @endisset " method="POST">
                        @csrf
                        @isset ($role) @method('patch')                            
                        @endisset
                        
                        <div class="col-md-12">
                            <label for="role_name" class="form-label">Tên quyền</label>
                            <input 
                            type="text" name="role_name" class="form-control  @error('role_name','roleEdit') is-invalid @enderror" id="role_name"
                            value="@isset($role->role_name){{$role->role_name}}@endisset"
                            aria-describedby="role_name" autocomplete="role_name">
                            @error('role_name','roleEdit')
                                <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        {{-- <div class="col-md-12">
                            
                            <label for="type_access" class="form-label">Mức độ truy cập</label>
                            <span class="text-wrap">@isset($role->type_access){{$role->type_access}}@endisset</span>
                            <select name="type_access[]" class="js-example-basic-multiple" id="type_access" multiple>
                                <option value="edit_product">Chỉnh sửa sản phẩm(edit_product)</option>
                                <option value="edit_new">Chỉnh sửa tin tức(edit_new)</option>
                                <option value="root">Truy cập toàn bộ(root)</option>
                            </select>
                        </div> --}}
                        <div class="col-md-12">
                            <label for="description" class="form-label">Mô tả</label>
                            <textarea
                            name="description" class="form-control" id="description" autocomplete="description"
                            aria-describedby="description">@isset($role->description){{$role->description}}@else{{old('description')}}@endisset</textarea>
                            @error('description','roleEdit')
                                <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                       
                        <div class="col-12">
                            <button class="btn btn-primary me-2" type="submit">Xác nhận</button>
                            <a class="btn btn-secondary" href="{{ route('role.index') }}">Trở về</a>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <div class="col-lg-7">
            @include('layouts.admin.RoleAdmin.component.table-role',['roles'=>$roles]);
        </div>
    </div>
</div>

<script type="module">
    $(document).ready(function(){
        let data = JSON.parse('<?php echo isset($role->type_access) ? $role->type_access : '[]' ?>');
        let selectElement = $('.js-example-basic-multiple');

        $('.js-example-basic-multiple').select2({
            tags: "true",
            data: data,
            theme: "bootstrap-5",
            language: "es",
            allowClear: true,
            width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
            placeholder: $( this ).data( 'Chọn tag' ),
            dropdownCssClass: "select2--small",
        });
        selectElement.val(selectedValues).trigger('change');
    });

</script> 