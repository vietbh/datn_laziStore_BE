@extends('admin')
@section('content')
    @include('layouts.admin.components.js',['errors' => $errors,'edit'=>$shippingProvider ?? null, 'modal'=>'addShippingProviderModal'])
    {{-- @if($errors->any())
        <script type="module"> 
            let myModal = new bootstrap.Modal(document.getElementById('addSlideModal'), {
            keyboard: false
            })
            myModal.toggle();
            myModal.show();
        </script>
    @endif
    @if (isset($slide))
        <script type="module"> 
            let myModal = new bootstrap.Modal(document.getElementById('addSlideModal'), {
            keyboard: false
            })
            myModal.toggle();
            myModal.show();
        </script>
    @endif --}}
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
               <h4 class="mb-0">Danh sách nhà vận chuyển</h4>
               <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addShippingProviderModal">
                    Thêm nhà vận chuyển
                </button>
           </div>
           <div class="table-responsive" style="height: 80vh">
               <table class="table text-start align-middle table-bordered table-hover mb-0" >
                   <thead>
                       <tr class="text-dark">
                           <th scope="col">Action</th>
                           <th scope="col">Nhà vận chuyển</th>
                           <th scope="col">Khu vực</th>
                           <th scope="col">Phí vận chuyển</th>
                       </tr>
                   </thead>
                   <tbody>
                    @foreach ($shippingProviders as $ship)
                        <tr>
                            <td>
                                <div class="d-flex">
                                    <a class="btn btn-sm btn-primary me-2" href="{{ route('shipping.edit', ['id' => $ship->id]) }}" title="Edit"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('shipping.delete', ['id' => $ship->id]) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-sm btn-danger" type="submit" title="Xóa"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </div>
                            </td>
                            <td>{{$ship->name}}</td>
                            <td>{{$ship->address}}</td>
                            <td>{{number_format($ship->shipping_cost,'0',',','.') }}đ</td>
                        </tr>
                    @endforeach                      
                   </tbody>
               </table>
           </div>
           
       </div>
   </div>
   <!-- Table Cate End -->
@endsection
@section('modal')
    @include('layouts.admin.components.shippingProviderModal',['modal'=>'addShippingProviderModal'])
@endsection