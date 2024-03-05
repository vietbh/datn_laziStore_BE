@extends('admin')
@section('content')

@if (session('success') || session('error'))
    @include('layouts.admin.components.alert')
@endif
@if($errors->any())
    <script type="module"> 
    var myModal = new bootstrap.Modal(document.getElementById('addProductModal'), {
    keyboard: false
    })
    myModal.toggle();
    myModal.show();
    </script>
@endif
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
           {{-- <div class="col-sm-6 col-xl-3">
               <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                   <i class="fa fa-chart-line fa-3x text-primary"></i>
                   <div class="ms-3">
                       <p class="mb-2">Số lượng </p>
                       <h6 class="mb-0">$1234</h6>
                   </div>
               </div>
           </div> --}}
           <div class="col-sm-6 col-xl-4">
               <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                   <i class="fa fa-chart-bar fa-3x text-primary"></i>
                   <div class="ms-3">
                       <p class="mb-2">Thương hiệu</p>
                       <h6 class="mb-0">{{count($brands)}}</h6>
                   </div>
               </div>
           </div>
           <div class="col-sm-6 col-xl-4">
               <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                   <i class="fa fa-chart-area fa-3x text-primary"></i>
                   <div class="ms-3">
                       <p class="mb-2">Danh mục</p>
                       <h6 class="mb-0">{{count($categories)}}</h6>
                   </div>
               </div>
           </div>
           <div class="col-sm-6 col-xl-4">
               <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                   <i class="fa fa-chart-pie fa-3x text-primary"></i>
                   <div class="ms-3">
                       <p class="mb-2">Tổng sản phẩm</p>
                       <h6 class="mb-0">{{count($products)}} sản phẩm</h6>
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
             {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
                 Thêm sản phẩm
            </button> --}}
            <a href="{{ route('product.create') }}" class="btn btn-primary">
                Thêm sản phẩm
            </a>
         <!-- Modal -->
         {{-- @include('layouts.admin.components.proModal') --}}
         <!--End Modal -->
        </div>
        <div class="table-responsive" style="height: 100vh">
            <table class="table text-start align-middle table-bordered table-hover mb-0" >
                <thead>
                    <tr class="text-dark">
                        <th scope="col">Tên sản phẩm</th>
                        <th scope="col">Danh mục</th>
                        <th scope="col" class="text-center">
                            <div class="row">
                                <div class="col-sm-12 col-lg-3 p-0">Hình ảnh</div>
                                <div class="col-sm-12 col-lg-3 p-0">Màu sắc</div>
                                <div class="col-sm-12 col-lg-3 p-0">Giá bán</div>
                                <div class="col-sm-12 col-lg-3 p-0">Số lượng</div>
                            </div>
                        </th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                 @foreach ($products as $product)
                     <tr title="{{$product->name}}">
                         <td>{{$product->name}}</td>
                         <td>{{$product->category->name}}</td>
                        <td>
                            @foreach ($product->variations as $variation)
                                <div class="row p-2 text-center">
                                    <div class="col-sm-12 col-lg-3">
                                        <img src="{{ $variation->image_url }}" loading="lazy" class="rounded" width="100" height="100" alt="{{ $product->image_url }}"/>
                                    </div>
                                    <div class="col-sm-12 col-lg-3 d-flex align-items-center">
                                        <p class="text-uppercase">{{ $variation->color_type }}</p>
                                    </div>
                                    <div class="col-sm-12 col-lg-3 d-flex align-items-center">
                                        <p>{{number_format($variation->price_sale)}} <span style="font-size: 14px">vnđ</span></p>
                                    </div>
                                    <div class="col-sm-12 col-lg-3 d-flex align-items-center">
                                        <p>{{number_format($variation->quantity)}} <span style="font-size: 14px">chiếc</span></p>
                                    </div>
                                </div>
                            @endforeach 
                        </td>
                         <td>{{$product->show_hide ? 'Hiện':'Ẩn'}}</td>
                         <td>
                         <div class="d-flex justify-content-around">
                             <a class="btn btn-sm btn-primary " href="{{ route('product.edit', ['id' => $product->id]) }}" title="Detail">Detail</a>
                             <form action="{{ route('product.delete', ['id' => $product->id]) }}" method="POST">
                                 @csrf
                                 @method('delete')
                                 <button class="btn btn-sm btn-danger" type="submit" title="Xóa">Xóa</button>
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