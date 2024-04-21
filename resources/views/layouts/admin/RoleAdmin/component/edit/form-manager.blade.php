<div class="bg-light p-4 rounded" style="min-height: 85vh;">
    <div class="row ">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5>
                        @isset ($admin)Cập nhật quản trị viên <strong>{{$admin->name}}</strong>
                        @else Thêm mới quản trị viên    
                        @endisset 
                    </h5><hr>
                    <form 
                    class="row gap-3" action="
                    @isset($admin){{ route('admin.update') }}
                    @else {{ route('admin.store') }}
                    @endisset" method="post" enctype="multipart/form-data">
                        @csrf
                        @isset($admin) @method('patch') @endisset
                        
                        <div class="row">
                            @isset($admin)<input type="hidden" name='admin_id' value="{{$admin->id}}">@endisset
                            <div class="col-lg-2 col-md-4">
                                <div>
                                    @isset($admin->image_url)
                                        <img 
                                        class="img-fluid rounded-circle mb-2 image_selected" src="@isset($admin->image_url){{$admin->image_url}}@endisset" alt="avatar" />
                                    @endisset
                                    <div class="position-relative">
                                        <img 
                                        id="image_upload_preview" class="d-none img-fluid rounded-circle mb-2 w-auto"
                                        src="@isset($admin->image_url){{$admin->image_url}}@endisset" alt="avatar" />
                                        <button type="button" class="btn d-none btn-close btn-remove-image position-absolute top-0 right-0" ></button>
                
                                    </div>
                                    <label for="inputFile" style="cursor: pointer;" class=" @error('image_url','profileGuest') is-invalid @enderror">
                                        Hình đại diện
                                        <svg class="m-0" width="18px" height="18px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M15 13H9" stroke="#000000" stroke-width="1.5" stroke-linecap="round"></path> <path d="M12 10L12 16" stroke="#000000" stroke-width="1.5" stroke-linecap="round"></path> <path d="M19 10H18" stroke="#000000" stroke-width="1.5" stroke-linecap="round"></path> <path d="M2 13.3636C2 10.2994 2 8.76721 2.74902 7.6666C3.07328 7.19014 3.48995 6.78104 3.97524 6.46268C4.69555 5.99013 5.59733 5.82123 6.978 5.76086C7.63685 5.76086 8.20412 5.27068 8.33333 4.63636C8.52715 3.68489 9.37805 3 10.3663 3H13.6337C14.6219 3 15.4728 3.68489 15.6667 4.63636C15.7959 5.27068 16.3631 5.76086 17.022 5.76086C18.4027 5.82123 19.3044 5.99013 20.0248 6.46268C20.51 6.78104 20.9267 7.19014 21.251 7.6666C22 8.76721 22 10.2994 22 13.3636C22 16.4279 22 17.9601 21.251 19.0607C20.9267 19.5371 20.51 19.9462 20.0248 20.2646C18.9038 21 17.3433 21 14.2222 21H9.77778C6.65675 21 5.09624 21 3.97524 20.2646C3.48995 19.9462 3.07328 19.5371 2.74902 19.0607C2.53746 18.7498 2.38566 18.4045 2.27673 18" stroke="#000000" stroke-width="1.5" stroke-linecap="round"></path> </g></svg>
                                        <input 
                                        type='file' class="d-none" name="image_url" id="inputFile"/>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-10 col-md-8">
                                <div class="row">
                                    <div 
                                    class="col-lg-6 col-md-6 mb-3">
                                        <div class="form-floating">
                                            <input 
                                            type="text" name="name" class="form-control @error('name','profileGuest') is-invalid @enderror" id="name"
                                            value="@isset($admin->name){{$admin->name}}@else{{old('name')}}@endisset" autocomplete="name"
                                            >
                                            <label for="name">Tên đăng nhập</label>
                                        </div>
                                        @error('name','managerEdit')
                                        <div class="mb-1 text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div 
                                    class="col-lg-6 col-md-6 mb-3">
                                        <div class="form-floating">
                                            <input type="email" class="form-control @error('email','profileGuest') is-invalid @enderror" 
                                            id="email" name="email" value="@isset($admin->email) {{$admin->email}}  @else {{old('email')}} @endisset" autocomplete="email"
                                            >
                                            <label for="email">Email</label>
                                        </div>
                                        @error('email','managerEdit')
                                            <div class="mb-1 text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div 
                                    class="col-lg-12 col-md-12 mb-3">
                                        <div class="form-floating">
                                            <select name="role" class="form-control bg-white text-uppercase fw-bold" >
                                                @isset($roles)
                                                    @foreach ($roles as $role)
                                                        <option class="text-uppercase fw-bold" value="{{$role->id}}" 
                                                        @isset($admin) @if ($role->id == $admin->role){{"selected"}} @endif @endisset 
                                                        >{{$role->role_name}}</option>
                                                    @endforeach
                                                @endisset
                                            </select>                                        
                                            <label for="email">Quyền quản trị</label>

                                        </div>
                                    </div>
                                    @isset($admin)
                                        <div 
                                        class="col-lg-12 col-md-12">
                                            <div class="form-floating mb-3">
                                                <input 
                                                type="password" class="form-control 
                                                @error('current_password','managerEdit') is-invalid @enderror" id="floatingInput"
                                                name="current_password" autocomplete="current_password"
                                                >
                                                <label for="floatingInput">Mật khẩu cũ</label>
                                                @error('current_password','managerEdit')
                                                <div class="form-text text-danger">{{ $message }}</div>
                                                @enderror
                            
                                            </div>
                                        </div>
                                    @endisset
                                    <div 
                                    class="col-lg-12 col-md-12">
                                        <div class="form-floating mb-3">
                                            <input type="password" class="form-control
                                            @error('password','managerEdit') is-invalid @enderror" 
                                            id="floatingInput" name="password" autocomplete="password"
                                            
                                            >
                                            <label for="floatingInput">Mật khẩu</label>
                                            @error('password','managerEdit')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div 
                                    class="col-lg-12 col-md-12">
                                        <div class="form-floating mb-3">
                                            <input type="password" class="form-control
                                            @error('current_password','managerEdit') is-invalid @enderror"
                                            id="floatingInput" name="password_confirmation" autocomplete="password_confirmation"
                                            
                                            >
                                            <label for="floatingInput">Xác nhận mật khẩu</label>
                                            @error('password_confirmation','managerEdit')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-12">
                                <button 
                                type="submit" class="btn btn-primary">
                                @isset($admin)Cập nhật
                                @else Thêm mới    
                                @endisset
                                </button>
                                <a href="{{ route('role.index') }}" class="btn btn-secondary">Trở về</a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>



   