
<div class="container-fluid">
    <h6 class="mb-4">Cập nhật thông tin</h6>
    <form class="form d-block" action="{{ route('profileGuest.update') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <input type="hidden" name='user_id' value="{{$user->id}}">
        <input type="hidden" name='detailUser_id' value="{{$user->detailUser->first()->id}}">
        <div class="row">
            <div class="col-lg-2 col-md-4">
                <div>
                    @isset($user->image_url)
                        <img 
                        class="img-fluid rounded-circle mb-2 image_selected" src="@isset($user->image_url){{$user->image_url}}@endisset" alt="avatar" />
                    @endisset
                    <div class="position-relative">
                        <img 
                        id="image_upload_preview" class="d-none img-fluid rounded-circle mb-2 w-auto"
                        src="@isset($user->image_url){{$user->image_url}}@endisset" alt="avatar" />
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
                            value="@isset($user->name) {{$user->name}}  @else {{old('name')}} @endisset " autocomplete="name"
                            >
                            <label for="name">Tên đăng nhập</label>
                        </div>
                        @error('name','profileGuest')
                        <div class="mb-1 text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div 
                    class="col-lg-6 col-md-6 mb-3">
                        <div class="form-floating">
                            <input type="email" class="form-control @error('email','profileGuest') is-invalid @enderror" 
                            id="email" name="email" value="@isset($user->email) {{$user->email}}  @else {{old('email')}} @endisset" autocomplete="email"
                            >
                            <label for="email">Email</label>
                        </div>
                        @error('email','profileGuest')
                            <div class="mb-1 text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div 
                    class="col-lg-6 col-md-6 mb-3">
                        <div class="form-floating">
                            <input type="full_name" class="form-control @error('full_name','profileGuest') is-invalid @enderror" 
                            id="full_name" name="full_name" value="@if($user->detailUser->count()>0){{$user->detailUser->first()->full_name}}@else{{old('full_name')}}@endif" autocomplete="phone_number"
                            >
                            <label for="full_name">Họ và tên</label>
                        </div>
                        @error('full_name','profileGuest')
                            <div class="mb-1 text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div 
                    class="col-lg-6 col-md-6 mb-3">
                        <div class="form-floating">
                            <input type="number" class="form-control @error('phone_number','profileGuest') is-invalid @enderror" 
                            id="floatingInput" name="phone_number" value="@if($user->detailUser->count()>0){{$user->detailUser->first()->phone_number}}@else{{old('phone_number')}}@endif" autocomplete="phone_number"
                            >
                            <label for="floatingInput">Số điện thoại</label>
                        </div>
                        @error('phone_number','profileGuest')
                        <div class="mb-1 text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                   
                    <div class="col-lg-12 mb-3">
                        <div class="form-floating">
                            <textarea
                            class="form-control @error('address','profileGuest') is-invalid @enderror" 
                            placeholder="Nhập địa chỉ"
                            id="address" name="address" autocomplete="address" rows="4">@if($user->detailUser->count()>0) {{$user->detailUser->first()->address}} @else {{old('address')}} @endif </textarea>
                            <label for="address">Địa chỉ</label>
                        </div>
                        @error('address','profileGuest')
                            <div class="mb-1 text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div 
            class="col-lg-12">
                <button type="submit" class="btn btn-primary">Cập nhật</button>
                <a href="{{ route('guest.index') }}" class="btn btn-secondary">Thoát</a>
            </div>
        </div>
    </form>
        
</div>