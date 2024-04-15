@extends('admin')
@section('content')
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
                       <h6 class="mb-0">{{ count($brands) }}</h6>

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
            <a href="{{ route('product.create') }}" class="btn btn-primary">
                Thêm sản phẩm
            </a>
        </div>
        <div class="table-responsive" style="height: 90vh">
            <table class="table text-start align-middle table-bordered table-hover mb-0" >
                <thead>
                    <tr class="text-dark">
                        <th scope="col">Tên sản phẩm</th>
                        <th scope="col">Danh mục</th>
                        <th scope="col" class="text-center">Số lượng màu</th>
                        <th scope="col" class="text-center">Sản phẩm hot</th>
                        <th scope="col" class="text-center">Sản phẩm mới</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                 @foreach ($products as $product)
                     <tr title="{{$product->name}}">
                        <td>{{$product->name}}</td>
                        <td>{{$product->category->name}}</td>
                        <td><button class="btn btn-sm btn-primary">{{count($product->variations)}}</button></td>
                        <td><button class="btn btn-sm btn-secondary {{$product->product_type_hot ? '' : 'd-none'}}">Hot</button></td>
                        <td><button class="btn btn-sm btn-secondary {{$product->product_type_new ? '' : 'd-none'}}">New</button></td>
                         <td>{{$product->show_hide ? 'Hiện':'Ẩn'}}</td>
                         <td>
                         <div class="d-flex justify-content-around">
                             <a class="btn btn-sm btn-primary " href="{{ route('product.edit', ['id' => $product->id]) }}" title="Detail">Sửa</a>
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
        {{ $products->links('pagination::bootstrap-5') }}
    </div>
    </div>
<!-- Table Cate End -->

@endsection