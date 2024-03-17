@extends('admin')
@section('content')
    @if($errors->any())
        <script type="module"> 
            var myModal = new bootstrap.Modal(document.getElementById('addPolicyModal'), {
            keyboard: false
            })
            myModal.toggle();
            myModal.show();
        </script>
    @endif
    
    @if(isset($policy))
        <script type="module"> 
                var myModal = new bootstrap.Modal(document.getElementById('addPolicyModal'), {
                keyboard: false
                })
                myModal.toggle();
                myModal.show();
        </script>
    @endif
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
               <h4 class="mb-0">Danh sách chính sách</h4>
               <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPolicyModal">
                    Thêm chính sách
                </button>
           </div>
           <div class="table-responsive" style="height: 90vh">
               <table class="table text-start align-middle table-bordered table-hover mb-0" >
                   <thead>
                       <tr class="text-dark">
                           <th scope="col">Tên chính sách</th>
                           <th scope="col">Nội dung</th>
                           <th scope="col">Thứ tự</th>
                           <th scope="col">Trạng thái</th>
                           <th scope="col" colspan="2">Action</th>
                       </tr>
                   </thead>
                   <tbody>
                    @foreach ($policies as $poli)
                        <tr>
                            <td>{{$poli->name}}</td>
                            <td>{{$poli->value}}</td>
                            <td>{{$poli->position}}</td>
                            <td>{{$poli->show_hide ? 'Hiện' : 'Ẩn'}}</td>
                            <td>
                            <div class="d-flex justify-content-evenly">
                                <a class="btn btn-sm btn-primary" href="{{ route('policy.edit', ['id' => $poli->id]) }}">Edit</a>
                                <form action="{{ route('policy.delete', ['id' => $poli->id]) }}" method="POST">
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
@section('modal')
    <!-- Modal -->
        @include('layouts.admin.components.policyModal')
    <!--End Modal -->
@endsection