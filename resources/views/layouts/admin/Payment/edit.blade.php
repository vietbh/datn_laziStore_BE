@extends('admin')
@section('content')
 <!-- Sale & Revenue Start -->
 <div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-line fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Số lượng</p>
                    <h6 class="mb-0">{{$order->count_items}}</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-bar fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Tổng tiền</p>
                    <h6 class="mb-0">{{number_format($order->total,'2',',','.')}}đ</h6>
                </div>
            </div>
        </div>
        {{-- <div class="col-sm-6 col-xl-3">
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
            <h4 class="mb-0">Chi tiết mã đơn <span class="fs-5">{{$order->order_number}}</span></h4>
            
        </div>
        <div class="row" style="min-height: 50vh;">
            <div class="col-sm-12 col-xl-12" >
                <div class="bg-light rounded h-100 ">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                                aria-selected="true">Thông tin khách hàng</button>
                            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-profile" type="button" role="tab"
                                aria-controls="nav-profile" aria-selected="false">Sản phẩn</button>
                            <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-contact" type="button" role="tab"
                                aria-controls="nav-contact" aria-selected="false">Thanh toán</button>
                        </div>
                    </nav>
                    <div class="tab-content pt-3" id="nav-tabContent">
                        <div 
                        class="tab-pane fade show active row" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <div class="col-12">
                                <div class="bg-light rounded h-100 p-4">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Họ và tên</th>
                                                    <th scope="col">Số điện thoại</th>
                                                    <th scope="col">Địa chỉ</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>{{$order->full_name}}</td>
                                                    <td>{{$order->phone_number}}</td>
                                                    <td>{{$order->address}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                        <div 
                        class="tab-pane fade row" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <div 
                            class="col-12">
                                <div 
                                class="bg-light rounded h-100 p-4">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Tên sản phẩm</th>
                                                    <th scope="col">Giá</th>
                                                    <th scope="col">Số lượng</th>
                                                    <th scope="col">Tổng cộng</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($order->orderItems as $orderItem)

                                                    <tr>
                                                        <td class="text-wrap w-50">{{$orderItem->productVariation->product->name}} | <span>{{$orderItem->productVariation->color_type}}</span> </td>
                                                        <td>{{number_format($orderItem->price,'2',',','.')}}đ</td>
                                                        <td>{{$orderItem->quantity}}</td>
                                                        <td>{{number_format($orderItem->amount,'2',',','.')}}đ</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div 
                        class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                            <div 
                            class="col-12">
                                <div 
                                class="bg-light rounded h-100 p-4">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Mã thanh toán</th>
                                                    <th scope="col">Phương thức</th>
                                                    <th scope="col">Mã app thanh toán</th>
                                                    <th scope="col">Tổng cộng</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-wrap w-50">{{$order->payment->payment_number}}</td>
                                                    <td>{{$order->payment->payment_method}}</td>
                                                    <td>
                                                        @if ($order->payment->payment_momo_link){{$order->payment->payment_momo_link}}
                                                        @elseif ($order->payment->payment_qr_code){{$order->payment->payment_qr_code}}
                                                        @else Không có
                                                        @endif
                                                    </td>
                                                    <td>{{number_format($order->payment->total,'2',',','.')}}đ</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection