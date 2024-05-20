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
           <div style="min-height: 75vh">
               <table class="table text-start align-middle table-bordered table-hover mb-0" id="table-items">
                   <thead>
                       <tr class="text-dark">
                           <th scope="col">Action</th>
                           <th scope="col">Mã giảm giá</th>
                           <th scope="col">Số lượng</th>
                           <th scope="col">Hẹn thời gian</th>
                           <th scope="col">Trạng thái hoạt động</th>
                           <th scope="col">Thời gian</th>
                           <th scope="col">Ẩn hiện</th>
                       </tr>
                   </thead>
                   <tbody>
                    @isset($discounts)
                        @foreach ($discounts as $dis)
                            <tr>
                                <td>
                                    <div class="d-flex ">
                                        <a class="btn btn-sm btn-primary me-2" href="{{ route('discount.edit', ['id' => $dis->id]) }}" title="Edit"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('discount.delete', ['id' => $dis->id]) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-sm btn-danger" type="submit" title="Xóa"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </div>
                                </td>
                                <td class="text-success">{{$dis->discount_code}}</td>
                                <td><span class="badge bg-primary">{{$dis->discount_total}}</span></td>
                                <td class="text-capitalize">
                                    @if ($dis->discount_now) <span class="badge bg-success">Kích hoạt</span>
                                    @else <span class="badge bg-secondary">Không </span>
                                    @endif
                                </td>
                                <td class="text-capitalize">
                                    @if ($dis->discount_now) 
                                        @if ($dis->discount_status) <span class="badge bg-success">Mở</span>
                                        @else <span class="badge bg-danger">Khóa</span>
                                        @endif
                                    @else <span class="badge bg-secondary">Không</span>
                                    @endif
                                  
                                </td>
                                <td>
                                    @if ($dis->discount_now)
                                        @php
                                            Carbon\Carbon::setLocale("vi");
                                            $startDateTime = Carbon\Carbon::parse($dis->start_date,'Asia/Ho_Chi_Minh');
                                            $endDateTime = Carbon\Carbon::parse($dis->end_date,'Asia/Ho_Chi_Minh');
                                            $currentDate = Carbon\Carbon::now('Asia/Ho_Chi_Minh');                                 
                                            $remainingTimeStart = $startDateTime->diff($currentDate);
                                            $remainingTimeEnd = $endDateTime->diff($currentDate);
                                        @endphp
                                        @if ($remainingTimeStart->invert !== 0)
                                            <div class="d-flex p-1">
                                                <span class="fw-bold">Mã sẽ được mở vào {{$startDateTime->diffForHumans($currentDate)}} </span>
                                            </div>
                                        @else
                                            @if ($remainingTimeEnd->invert === 0) <span class="fw-bold text-danger">Hết hạn</span>
                                            @else <span class="fw-bold text-dark">Mã sẽ bị khóa vào {{$endDateTime->diffForHumans($currentDate)}}</span>                                            
                                            @endif
                                        @endif
                                    @else
                                        <span class="text-danger">Không kích hoạt thời gian hẹn</span>
                                    @endif
                                 
                                </td>
                                <td> <span class="badge bg-primary">{{$dis->show_hide ? 'Hiện' : 'Ẩn'}}</span></td>

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