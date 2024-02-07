@extends('admin')
@section('content')

@if (session('success'))
@include('layouts.admin.components.alert')
@endif
@if (session('error'))
@include('layouts.admin.components.alert')
@endif
@error('name')
<script type="module"> 
var myModal = new bootstrap.Modal(document.getElementById('addProductModal'), {
keyboard: false
})
myModal.toggle();
myModal.show();

</script>
@enderror
@error('name')
<script type="module"> 
var myModal = new bootstrap.Modal(document.getElementById('addProductModal'), {
keyboard: false
})
myModal.toggle();
myModal.show();

</script>
@enderror
@isset($product)
<script type="module"> 
    var myModal = new bootstrap.Modal(document.getElementById('addProductModal'), {
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
            <h6 class="mb-0">Tất cả sản phẩm</h6>
            <!-- Button trigger modal -->
             <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
                 Thêm sản phẩm
             </button>
         <!-- Modal -->
         @include('layouts.admin.components.proModal')
         <!--End Modal -->
        </div>
        <div class="table-responsive" style="height: 100vh">
            <table class="table text-start align-middle table-bordered table-hover mb-0" >
                <thead>
                    <tr class="text-dark">
                        <th scope="col"><input class="form-check-input" type="checkbox"></th>
                        <th scope="col">Ngày tạo</th>
                        <th scope="col">Tên sản phẩm</th>
                        <th scope="col">Hình ảnh</th>
                        <th scope="col" class="text-center" style="width: 45%">
                            <div class="row">
                                <div class="col-sm-12 col-lg-3 ">
                                    <p>Màu sắc</p>
                                </div>
                                <div class="col-sm-12 col-lg-5 ">
                                    <p>Giá bán</p>
                                </div>
                                <div class="col-sm-12 col-lg-4 ">
                                    <p>Số lượng</p> 
                                </div>
                            </div>
                        </th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col" colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                 @foreach ($products as $product)
                     <tr>
                         <td><input class="form-check-input" type="checkbox"></td>
                         <td>{{$product->created_at}}</td>
                         <td>{{$product->name}}</td>
                         <td><img src="{{ $product->image_url }}" class="rounded" width="100" height="100" alt=""/></td>
                        <td>
                            @foreach ($product->variations as $variation)
                                <div class="row p-1 text-center">
                                    <div class="col-sm-12 col-lg-3">
                                        <input type="color" class="rounded w-100" disabled value="{{ $variation->color_type }}"/>
                                    </div>
                                    <div class="col-sm-12 col-lg-5">
                                        <p>{{number_format($variation->price_sale*1000)}} <span style="font-size: 14px">vnđ</span></p>
                                    </div>
                                    <div class="col-sm-12 col-lg-4">
                                        <p>{{number_format($variation->quantity)}} <span style="font-size: 14px">chiếc</span></p>
                                    </div>
                                    <hr>
                                </div>
                            @endforeach 
                        </td>
                         <td>{{$product->show_hide=='show'?'Hiện':'Ẩn'}}</td>
                         <td>
                         <div class="d-flex justify-content-around">
                             <a class="btn btn-sm btn-primary" href="{{ route('product.edit', ['id' => $product->id]) }}">Detail</a>
                             <form action="{{ route('product.delete', ['id' => $product->id]) }}" method="POST">
                                 @csrf
                                 @method('delete')
                                 <button class="btn btn-sm btn-danger" type="submit">Xóa</button>
                             </form>
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