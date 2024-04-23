@extends('admin')
@section('content')
   <!-- Sale & Revenue Start -->
   <div class="container-fluid pt-4 px-4">
       <div class="row g-4">
           <div class="col-sm-6 col-xl-3">
               <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                   <i class="fa fa-chart-line fa-3x text-primary"></i>
                   <div class="ms-3">
                       <p class="mb-2">Số lượng đơn</p>
                       <h6 class="mb-0">{{$orders->count()}}</h6>
                   </div>
               </div>
           </div>
           {{-- <div class="col-sm-6 col-xl-3">
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
           </div> --}}
       </div>
   </div>
   <!-- Sale & Revenue End -->

   <!-- Table Cate Start -->
    <div class="container-fluid pt-4 px-4">
       <div class="bg-light text-center rounded p-4">
           <div class="d-flex align-items-center justify-content-between mb-4">
               <h4 class="mb-0">Danh sách đơn hàng</h4>
           </div>
           <div class="table-responsive" style="height: 100vh">
               <table class="table text-start align-middle table-bordered table-hover mb-0" >
                   <thead>
                       <tr class="text-dark">
                           <th scope="col" >Action</th>
                           <th scope="col">Khách hàng</th>
                           <th scope="col">Số điện thoại</th>
                           {{-- <th scope="col">Địa chỉ</th> --}}
                           <th scope="col">Số lượng sản phẩm</th>
                           <th scope="col">Tổng tiền</th>
                           <th scope="col">Trạng thái</th>
                           <th scope="col" colspan="2">Thời gian tạo</th>
                       </tr>
                   </thead>
                   <tbody>
                    @forelse ($orders as $order)                        
                        <tr>
                            <td>
                            <div class="d-flex justify-content-evenly">
                                <a class="btn btn-sm btn-primary" href="{{ route('payment.edit', ['id' => $order->id]) }}">Detail</a>
                                {{-- <form action="{{ route('product.cat.delete', ['id' => $order->id]) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-sm btn-danger" type="submit">Xóa</button>
                                </form> --}}
                            </div>
                            </td>
                            <td>{{$order->full_name}}</td>
                            <td>{{$order->phone_number}}</td>
                            {{-- <td>{{$order->address}}</td> --}}
                            <td>{{$order->count_items}}</td>
                            <td>{{number_format($order->total, 0, ',', '.')}}đ</td>
                            <td>@isset(($order->payment)){{$order->payment->status}}@endisset</td>
                            <td>{{ \Carbon\Carbon::parse($order->time_create)->isoFormat('HH') }} giờ : {{ \Carbon\Carbon::parse($order->time_create)->isoFormat('mm') }} phút</td>
                            <td>{{ \Carbon\Carbon::parse($order->date_create)->isoFormat('D/MM/Y')}}</td>
                            
                        </tr>
                    @empty
                        <td colspan="10"><h3 class="text-center">Không có đơn hàng nào</h3></td>
                    @endforelse                         
                   </tbody>
               </table>
           </div>
           {{ $orders->links() }} 
       </div>
   </div>
   <!-- Table Cate End -->

@endsection