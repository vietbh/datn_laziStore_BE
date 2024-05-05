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
           <div style="min-height: 75vh">
               <table class="table text-start align-middle table-bordered table-hover mb-0" id="table-items">
                   <thead>
                       <tr class="text-dark">
                           <th scope="col" >Action</th>
                           <th scope="col">Khách hàng</th>
                           <th scope="col">Số điện thoại</th>
                           <th scope="col">Số lượng sản phẩm</th>
                           <th scope="col">Tổng tiền</th>
                           <th scope="col">Trạng thái</th>
                           <th scope="col">Thời gian tạo</th>
                       </tr>
                   </thead>
                   <tbody>
                        @forelse ($orders as $order)                        
                            <tr>
                                <td>
                                    <div class="d-flex">
                                        <a 
                                        class="btn btn-sm btn-primary me-2" href="{{ route('payment.edit', ['id' => $order->id]) }}"><i class="fas fa-edit"></i></a>
                                        {{-- <form action="{{ route('product.cat.delete', ['id' => $order->id]) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-sm btn-danger" type="submit">Xóa</button>
                                        </form> --}}
                                    </div>
                                </td>
                                <td>{{$order->full_name}}</td>
                                <td>{{$order->phone_number}}</td>
                                <td><span class="badge bg-primary">{{$order->count_items}}</span></td>
                                <td>{{number_format($order->total, 0, ',', '.')}}đ</td>
                                <td>
                                    @isset($order->payment)
                                    @if ($order->payment->status =='pending') <span class="badge bg-warning">{{$order->payment->status}}</span>
                                    @elseif ($order->payment->status =='in_progress') <span class="badge bg-primary">{{$order->payment->status}}</span>
                                    @else <span class="badge bg-success">{{$order->payment->status}}</span>
                                    @endif    
                                    @endisset
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <span class="badge bg-primary me-2">
                                        {{ \Carbon\Carbon::parse($order->time_create)->isoFormat('h') }} giờ : {{ \Carbon\Carbon::parse($order->time_create)->isoFormat('mm') }} phút {{ \Carbon\Carbon::parse($order->time_create)->isoFormat('A') }}   
                                        </span>
                                        
                                        <span class="badge bg-primary">
                                        {{ \Carbon\Carbon::parse($order->date_create)->diffForHumans()}}    
                                        </span>

                                    </div>
                                </td>
                                
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10"><h3 class="text-center">Không có đơn hàng nào</h3></td>
                            </tr>
                        @endforelse                         
                   </tbody>
               </table>
           </div>
        
       </div>
   </div>
   <!-- Table Cate End -->

@endsection
@section('css')
    <style rel="stylesheet">
        div.dt-button-collection {
            width: 400px;
        }
        
        div.dt-button-collection button.dt-button {
            display: inline-block;
            width: 32%;
        }
        div.dt-button-collection button.buttons-colvis {
            display: inline-block;
            width: 49%;
        }
        div.dt-button-collection h3 {
            margin-top: 5px;
            margin-bottom: 5px;
            font-weight: 100;
            border-bottom: 1px solid rgba(181, 181, 181, 0.5);
            font-size: 1em;
            padding: 0 1em;
        }
        div.dt-button-collection h3.not-top-heading {
            margin-top: 10px;
        }
    </style>
@endsection
@section('js')
    <script type="text/javascript">
        $(document).ready(function(){
            
            $('#table-items').DataTable({
                columnDefs: [
                    {
                        targets: 1,
                        className: 'noVis'
                    }
                ],
                layout: {
                    topStart: {
                        buttons: [
                            'pageLength',
                            {
                                extend: 'copyHtml5',
                                exportOptions: {
                                    columns: [0, ':visible']
                                },
                            },
                            {
                                text: 'Setting',
                                extend: 'collection',
                                className: 'custom-html-collection',
                                buttons: [
                                    '<h3>Export</h3>',
                                    'pdf','excel','csv','print',
                                    '<h3 class="not-top-heading">Column Visibility</h3>',
                                    'colvisRestore',
                                    'columnsToggle',
                                ],
                            },
                          
                        ]
                    }
                }
            });
     
        });
     
    </script>
@endsection