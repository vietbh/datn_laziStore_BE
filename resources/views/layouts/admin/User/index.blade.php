@extends('admin')
@section('content')
   
   <!-- Sale & Revenue Start -->
   <div class="container-fluid pt-4 px-4">
       <div class="row g-4">
           <div class="col-sm-6 col-xl-3">
               <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                   <i class="fa fa-chart-line fa-3x text-primary"></i>
                   <div class="ms-3">
                       <p class="mb-2">Today Sale</p>
                       <h6 class="mb-0">$1234</h6>
                   </div>
               </div>
           </div>
           <div class="col-sm-6 col-xl-3">
               <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                   <i class="fa fa-chart-bar fa-3x text-primary"></i>
                   <div class="ms-3">
                       <p class="mb-2">Total Sale</p>
                       <h6 class="mb-0">$1234</h6>
                   </div>
               </div>
           </div>
           <div class="col-sm-6 col-xl-3">
               <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                   <i class="fa fa-chart-area fa-3x text-primary"></i>
                   <div class="ms-3">
                       <p class="mb-2">Today Revenue</p>
                       <h6 class="mb-0">$1234</h6>
                   </div>
               </div>
           </div>
           <div class="col-sm-6 col-xl-3">
               <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                   <i class="fa fa-chart-pie fa-3x text-primary"></i>
                   <div class="ms-3">
                       <p class="mb-2">Total Revenue</p>
                       <h6 class="mb-0">$1234</h6>
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
               <h4 class="mb-0">Danh sách khách hàng</h4>
            <!-- Modal -->
            {{-- @include('layouts.admin.components.catProModal') --}}
            <!--End Modal -->
           </div>
           <div class="table-responsive" style="height: 100vh">
               <table class="table text-start align-middle table-bordered table-hover mb-0" >
                   <thead>
                       <tr class="text-dark">
                           <th scope="col">Action</th>
                           <th scope="col">Tên khách hàng</th>
                           <th scope="col">Hình đại diện</th>
                           <th scope="col">Email</th>
                           <th scope="col">Xác minh email</th>
                           <th scope="col">Trạng thái</th>
                           <th scope="col">Ngày tạo</th>
                       </tr>
                   </thead>
                   <tbody>
                    @foreach ($users as $user)
                        <tr title="{{$user->name}}">
                            <td>
                                <div class="d-flex justify-content-evenly">
                                    <a class="btn btn-sm btn-primary" href="{{ route('guest.edit', ['id' => $user->id]) }}">Detail</a>
                                </div>
                            </td>
                            <td>{{$user->name}}</td>
                            <td>@isset($user->image_url)<img src="{{$user->image_url}}" loading="lazy" class="rounded-circle" width="100" height="100" alt="{{$user->image_url}}"/>
                                @else Chưa có hình ảnh
                                @endisset
                            </td>
                            <td>{{$user->email}}</td>
                            <td><span class="badge {{$user->email_verified_at ? "bg-success" : "bg-danger"}} ">{{$user->email_verified_at ? $user->email_verified_at->format('d/m/Y') : "Chưa kích hoạt"}}</span></td>
                            <td><span class="badge bg-success">{{$user->status}}</span></td>
                            <td><span class="badge bg-success">{{$user->created_at ? $user->created_at->format('d/m/Y'): "Chưa kích hoạt"}}</span></td>
                        </tr>
                    @endforeach                      
                   </tbody>
               </table>
           </div>
           
       </div>
   </div>
   <!-- Table Cate End -->

@endsection