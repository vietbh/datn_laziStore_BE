@extends('admin')
@section('content')
   <!-- Sale & Revenue Start -->
   <div class="container-fluid pt-4 px-4">
       <div class="row g-4">
           <div class="col-sm-6 col-xl-6">
               <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                   <i class="fa fa-chart-area fa-3x text-primary"></i>
                   <div class="ms-3">
                       <p class="mb-2">Quyền quản trị</p>
                       <h6 class="mb-0">{{$roles->count()}}</h6>
                   </div>
               </div>
           </div>
           <div class="col-sm-6 col-xl-6">
               <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                   <i class="fa fa-chart-pie fa-3x text-primary"></i>
                   <div class="ms-3">
                       <p class="mb-2">Quản trị viên</p>
                       <h6 class="mb-0">{{$listManager->count()}}</h6>
                   </div>
               </div>
           </div>
       </div>
   </div>
   <!-- Sale & Revenue End -->

   <!-- Table Cate Start -->
   <div class="container-fluid pt-4 px-4">
       <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h4 class="mb-0">Danh sách vai trò truy cập</h4>
            </div>
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button 
                    class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Danh sách quyền</button>
                    <button 
                    class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Danh sách quản trị viên</button>
                    {{-- <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</button> --}}
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div 
                class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
                    <div class="container-fluid mt-1 mb-3">
                        <div class="d-flex justify-content-end">
                            <a class="btn btn-sm btn-primary" href="{{ route('role.create',['tab'=>'role']) }}">Thêm mới quyền</a>

                        </div>
                    </div>
                    @include('layouts.admin.RoleAdmin.component.table-role',['roles'=>$roles])
                </div>
                <div 
                class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
                    <div class="container-fluid mt-1 mb-3">
                        <div class="d-flex justify-content-end">
                            <a class="btn btn-sm btn-primary" href="{{ route('admin.create',['tab'=>'admin']) }}">Thêm quản trị viên</a>

                        </div>
                    </div>
                    @include('layouts.admin.RoleAdmin.component.table-admin',['listManager'=>$listManager])
                    
                </div>
            </div>
            
           
       </div>
   </div>
   <!-- Table Cate End -->

@endsection