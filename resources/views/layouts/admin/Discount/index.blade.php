@extends('admin')
@section('content')
@if($errors->any())
    <script type="module"> 
        let myModal = new bootstrap.Modal(document.getElementById('addDiscModal'), {
        keyboard: false
        })
        myModal.toggle();
        myModal.show();
    </script>
@endif
@isset($discount)
    <script type="module"> 
        let myModal = new bootstrap.Modal(document.getElementById('addDiscModal'), {
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
               <h4 class="mb-0">Danh sách mã giảm giá</h4>
               <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDiscModal">
                    Thêm mã giảm giá
                </button>
           </div>
           <div class="table-responsive" style="height: 90vh">
               <table class="table text-start align-middle table-bordered table-hover mb-0" >
                   <thead>
                       <tr class="text-dark">
                           <th scope="col">Mã giảm giá</th>
                           <th scope="col">Số lượng</th>
                           <th scope="col">Status</th>
                           <th scope="col">Thời gian</th>
                           <th scope="col">Trạng thái</th>
                           <th scope="col" colspan="2">Action</th>
                       </tr>
                   </thead>
                   <tbody>
                    @isset($discounts)
                        @foreach ($discounts as $dis)
                            <tr>
                                <td>{{$dis->discount_code}}</td>
                                <td>{{$dis->discount_total}}</td>
                                <td class="text-uppercase">{{$dis->status}}</td>
                                <td>
                                    @if ($dis->status != 'active')
                                        <span class="text-warning">Chưa được kích hoạt</span>
                                    @else
                                        @php
                                            $startDateTime = Carbon\Carbon::parse($dis->start_date);
                                            $endDateTime = Carbon\Carbon::parse($dis->end_date);
                                            $currentDate = Carbon\Carbon::now();                                        
                                            $remainingTimeStart = $currentDate->diff($startDateTime);
                                            $remainingTimeEnd = $currentDate->diff($endDateTime);
                                        @endphp
                                        @if ($remainingTimeStart->days > 0 || $remainingTimeStart->h > 0 || $remainingTimeStart->i > 0)
                                            <div class="d-flex p-1">
                                                <span class="fw-bold">Hiệu lực sau {{ $remainingTimeStart->days.' ngày'}} 
                                                    {{$remainingTimeStart->h == 0 ? '' : '- '.$remainingTimeStart->h.' giờ'}}
                                                    {{$remainingTimeStart->i == 0 ? '' : '- '.$remainingTimeStart->i.' phút'}} </span>
                                            </div>
                                        @else
                                            <div class="d-flex p-1">
                                                <span class=" fw-bold text-danger">Hết hiệu lực sau {{ $remainingTimeEnd->days.' ngày'}} {{$remainingTimeEnd->h == 0 ? '' : '- '.$remainingTimeEnd->h.' giờ'}} </span>
                                            </div>
                                        @endif
                                    @endif
                                </td>
                                <td>{{$dis->show_hide ? 'Hiện' : 'Ẩn'}}</td>
                                <td>
                                <div class="d-flex justify-content-evenly">
                                    <a class="btn btn-sm btn-primary" href="{{ route('discount.edit', ['id' => $dis->id]) }}">Edit</a>
                                    <form action="{{ route('discount.delete', ['id' => $dis->id]) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-sm btn-danger" type="submit">Xóa</button>
                                    </form>
                                </div>
                                </td>
                            </tr>
                        @endforeach                      
                    @endisset
                   </tbody>
               </table>
           </div>
           
       </div>
   </div>
   <!-- Table Cate End -->
@endsection
@section('modal')
    <!-- Modal -->
        @include('layouts.admin.components.discountModal')
    <!--End Modal -->
@endsection