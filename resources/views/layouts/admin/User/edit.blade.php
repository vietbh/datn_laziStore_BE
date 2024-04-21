@extends('admin')
@section('content')
   
   <!-- Sale & Revenue Start -->
   <div class="container-fluid pt-4 px-4">
        <div class="row">
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('guest.index') }}">Danh sách</a></li>
                <li class="breadcrumb-item active" aria-current="page">Chi tiết khách hàng</li>
                </ol>
            </nav>
        </div>
   </div>
   <!-- Sale & Revenue End -->

   <!-- Table Start -->
    <div class="container-fluid pt-4 px-1">
       <div class="text-center rounded" >  
            <div class="row">
                <div class="col-lg-12">
                    <div class="bg-light rounded h-100 p-4" style="min-height: 55vh; width: auto;">
                        <h6 class="mb-4 text-start">Chi tiết khách hàng <strong>{{$user->name}}</strong></h6>
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                              <button 
                              class="nav-link @if ($errors->updatePasswordUser->all() == [] && $errors->profileGuest->all() == []) active @endif" 
                              id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Tổng quan</button>
                            </li>
                            <li class="nav-item" role="presentation">
                              <button 
                              class="nav-link @if ($errors->profileGuest->all() != []) active @endif" 
                              id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Thông tin khách hàng</button>
                            </li>
                            <li class="nav-item " role="presentation">
                              <button 
                              class="nav-link @if ($errors->updatePasswordUser->all() != []) active @endif" 
                              id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Đổi mật khẩu</button>
                            </li>
                            {{-- <li class="nav-item " role="presentation">
                              <button 
                              class="nav-link @if ($errors->updatePasswordUser->all() != []) active @endif" 
                              id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Đổi mật khẩu</button>
                            </li> --}}
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div 
                            class="tab-pane fade @if ($errors->updatePasswordUser->all() == [] && $errors->profileGuest->all() == []) active show @endif" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                                @include('layouts.admin.User.component.profile',['user'=> $user])
                            </div>
                            <div 
                            class="tab-pane fade @if ($errors->profileGuest->all() != []) active show @endif" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
                                @include('layouts.admin.User.component.infomation',['user'=> $user])
                            </div>
                            <div 
                            class="tab-pane fade  @if ($errors->updatePasswordUser->all() != []) active show @endif" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">
                                @include('layouts.admin.User.component.changePassword',['user'=> $user])
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection