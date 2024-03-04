@extends('admin')
@section('content')
    
        
    @if (session('success'))
        @include('layouts.admin.components.alert')
        <script type="module">
            setTimeout(() => {
                var myAlert = document.getElementById('alertSuccess')
                var bsAlert = new bootstrap.Alert(myAlert)
                bsAlert.close()
            }, 3000);
        </script>
    @endif
    
    @error('name')
    <script type="module"> 
        var myModal = new bootstrap.Modal(document.getElementById('addBrandsModal'), {
        keyboard: false
        })
        myModal.toggle();
        myModal.show();
    </script> 
    @enderror
    @error('country')
    <script type="module"> 
        var myModal = new bootstrap.Modal(document.getElementById('addBrandsModal'), {
        keyboard: false
        })
        myModal.toggle();
        myModal.show();
    </script>
    @enderror
    
    @isset($brand)
    <script type="module"> 
            var myModal = new bootstrap.Modal(document.getElementById('addBrandsModal'), {
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

   <!-- Recent Sales Start -->
   <div class="container-fluid pt-4 px-4">
       <div class="bg-light text-center rounded p-4">
           <div class="d-flex align-items-center justify-content-between mb-4">
               <h6 class="mb-0">Tất cả thương hiệu</h6>
               <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBrandsModal">
                    Thêm 
                </button>
            <!-- Modal -->
            @include('layouts.admin.components.brandModal')
            <!--End Modal -->
           </div>
           <div class="table-responsive" style="height: 100vh">
               <table class="table text-start align-middle table-bordered table-hover mb-0" >
                   <thead>
                       <tr class="text-dark">
                           <th scope="col"><input class="form-check-input" type="checkbox"></th>
                           <th scope="col">Ngày tạo</th>
                           <th scope="col">Tên thương hiệu</th>
                           <th scope="col">Quốc gia</th>
                           <th scope="col">Trạng thái</th>
                           <th scope="col" colspan="2">Action</th>
                       </tr>
                   </thead>
                   <tbody>
                    @foreach ($brands as $brand)
                        <tr>
                            <td><input class="form-check-input" type="checkbox"></td>
                            <td>{{$brand->created_at}}</td>
                            <td>{{$brand->name}}</td>
                            <td>{{$brand->country}}</td>
                            <td>{{$brand->show_hide ? 'Hiện':'Ẩn'}}</td>
                            <td>
                            <div class="d-flex justify-content-evenly">
                                <a class="btn btn-sm btn-primary" href="{{ route('brand.edit', ['id' => $brand->id]) }}">Edit</a>
                                <form action="{{ route('brand.delete', ['id' => $brand->id]) }}" method="POST">
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
       {{-- <div class="btn-toolbar float-end" role="toolbar">
       <div class="btn-group me-2" role="group" aria-label="Second group">
           <button type="button" class="btn btn-secondary"><<</button>
           <button type="button" class="btn btn-secondary">5</button>
           <button type="button" class="btn btn-secondary">6</button>
           <button type="button" class="btn btn-secondary">7</button>
           <button type="button" class="btn btn-secondary">>></button>
       </div>
       </div> --}}
   </div>
   <!-- Recent Sales End -->

@endsection