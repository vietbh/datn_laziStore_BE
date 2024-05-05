@extends('admin')
@section('content') 
    @if($errors->any())
        <script type="module"> 
            var myModal = new bootstrap.Modal(document.getElementById('addCategoriesModal'), {
            keyboard: false
            })
            myModal.toggle();
            myModal.show();
        </script>
    @endif
    
    @isset ($contact)
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
               <h4 class="mb-0">Danh sách tư vấn</h4>
               <!-- Button trigger modal -->
                {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoriesModal">
                    Thêm danh mục
                </button> --}}
            <!-- Modal -->
            {{-- @include('layouts.admin.components.catProModal') --}}
            <!--End Modal -->
           </div>
           <div class="table-responsive" style="height: 100vh">
               <table class="table text-start align-middle table-bordered table-hover mb-0" >
                   <thead>
                       <tr class="text-dark">
                           <th scope="col">Action</th>
                           <th scope="col">Họ và Tên</th>
                           <th scope="col">Email</th>
                           <th scope="col">Số điện thoại</th>
                           <th scope="col">Tiêu đề</th>
                           <th scope="col">Ngày gửi</th>
                       </tr>
                   </thead>
                   <tbody>
                        @foreach ($contacts as $cont)
                            <tr>
                                <td>
                                    <div class="d-flex justify-content-evenly">
                                        <a class="btn btn-sm btn-primary" href="{{ route('product.cat.edit', ['id' => $cont->id]) }}"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('product.cat.delete', ['id' => $cont->id]) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-sm btn-danger" type="submit"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </div>
                                </td>
                                <td>{{$cont->fullname}}</td>
                                <td>{{$cont->email}}</td>
                                <td>{{$cont->phone_number}}</td>
                                <td>{{$cont->title}}</td>
                                <td><span class="badge bg-primary">{{$cont->datetime_create->format('d/m/Y')}}</span></td>
                            </tr>
                        @endforeach                      
                   </tbody>
               </table>
           </div>
       </div>
   </div>
   <!-- Table Cate End -->

@endsection