<div class="container-fluid">
    <h6 class="mb-4">Đổi mật khẩu</h6>
    <form class="form" action="{{ route('passwordUser.update') }}" method="post">
        <div class="row">
            @csrf
            @method('put')
            <input type="hidden" name="user_id" value="{{$user->id}}">
            <div 
            class="col-lg-12 col-md-12">
                <div class="form-floating mb-3">
                    <input 
                    type="password" class="form-control 
                    @error('current_password','updatePasswordUser') is-invalid @enderror" id="floatingInput"
                    name="current_password" autocomplete="current_password"
                    >
                    <label for="floatingInput">Mật khẩu cũ</label>
                    @error('current_password','updatePasswordUser')
                    <div class="form-text text-danger">{{ $message }}</div>
                    @enderror

                </div>
            </div>
            <div 
            class="col-lg-12 col-md-12">
                <div class="form-floating mb-3">
                    <input type="password" class="form-control
                    @error('password','updatePasswordUser') is-invalid @enderror" 
                    id="floatingInput" name="password" autocomplete="password"
                    
                    >
                    <label for="floatingInput">Mật khẩu mới</label>
                    @error('password','updatePasswordUser')
                    <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div 
            class="col-lg-12 col-md-12">
                <div class="form-floating mb-3">
                    <input type="password" class="form-control
                    @error('current_password','updatePasswordUser') is-invalid @enderror"
                    id="floatingInput" name="password_confirmation" autocomplete="password_confirmation"
                    
                    >
                    <label for="floatingInput">Xác nhận mật khẩu</label>
                    @error('password_confirmation','updatePasswordUser')
                    <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div 
            class="col-lg-12">
                <button type="submit" class="btn btn-primary">Xác nhận</button>
                <a href="{{ route('guest.index') }}" class="btn btn-secondary">Thoát</a>
            </div>
        </div>
    </form>
        
</div>