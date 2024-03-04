@extends('admin')
@section('content')
    @if (session('success'))
        @include('layouts.admin.components.alert')
    @endif
    @if($errors->any())
    <script type="module"> 
            var myModal = new bootstrap.Modal(document.getElementById('addCategoriesModal'), {
            keyboard: false
            })
            myModal.toggle();
            myModal.show();
    </script>
    @endif
    @isset($user)
    <script type="module"> 
            var myModal = new bootstrap.Modal(document.getElementById('addCategoriesModal'), {
            keyboard: false
            })
            myModal.toggle();
            myModal.show();
    </script>
    @endisset
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
                           {{-- <th scope="col">Ngày tạo</th> --}}
                           <th scope="col">Tên khách hàng</th>
                           <th scope="col">Hình đại diện</th>
                           <th scope="col">Email</th>
                           <th scope="col">Vai trò</th>
                           {{-- <th scope="col">Trạng thái</th> --}}
                           <th scope="col" colspan="2">Action</th>
                       </tr>
                   </thead>
                   <tbody>
                    @foreach ($users as $user)
                        <tr title="{{$user->name}}">
                            {{-- <td>{{$user->created_at}}</td> --}}
                            <td>{{$user->name}}</td>
                            <td><img src="{{ asset('public/'.$user->image_url) }}" loading="lazy" class="w-100" width="100" height="100" alt="{{$user->image_url}}"/></td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->role == 0 ? 'Quản trị':'Khách hàng'}}</td>
                            {{-- <td>{{$user->show_hide=='show'?'Hiện':'Ẩn'}}</td> --}}
                            <td>
                                <div class="d-flex justify-content-evenly">
                                    <a class="btn btn-sm btn-primary" href="{{ route('product.cat.edit', ['id' => $user->id]) }}">Detail</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach                      
                   </tbody>
               </table>
           </div>
           
       </div>
   </div>
   <!-- Table Cate End -->

@endsection