@extends('admin')
@section('content')
    @if($errors->any())
        <script type="module"> 
            var myModal = new bootstrap.Modal(document.getElementById('addCategoriesModal'), {
            keyboard: false
            })
            myModal.toggle();
            myModal.show();
        </script>
    @endif    
    @isset($category)
        <script type="module"> 
                var myModal = new bootstrap.Modal(document.getElementById('addCategoriesModal'), {
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
               <h6 class="mb-0">Tất cả danh mục sản phẩm</h6>
               <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoriesModal">
                    Thêm danh mục
                </button>
           </div>
           <div class="table-responsive" style="height: 65vh">
               <table class="table text-start align-middle table-bordered table-hover mb-0" >
                   <thead>
                       <tr class="text-dark">
                           <th scope="col">Tên danh mục</th>
                           <th scope="col">Tên danh mục cha</th>
                           <th scope="col">Thứ tự</th>
                           <th scope="col">Trạng thái</th>
                           <th scope="col" colspan="2">Action</th>
                       </tr>
                   </thead>
                   <tbody>
                    @foreach ($categories as $cat)
                        <tr>
                            <td>{{$cat->name}}</td>
                            <td>{{$cat->parent ? $cat->parent->name : 'Trống'}}</td>
                            <td>{{$cat->position}}</td>
                            <td>{{$cat->show_hide ? 'Hiện' : 'Ẩn'}}</td>
                            <td>
                            <div class="d-flex justify-content-evenly">
                                @if ($cat->id !== 1)
                                    <a class="btn btn-sm btn-primary" href="{{ route('product.cat.edit', ['id' => $cat->id]) }}">Edit</a>
                                    <form action="{{ route('product.cat.delete', ['id' => $cat->id]) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-sm btn-danger" type="submit">Xóa</button>
                                    </form>
                                @endif
                            </div>
                            </td>
                        </tr>
                    @endforeach                      
                   </tbody>
               </table>
           </div>
           <div class="mb-2">
            {{ $categories->links('pagination::bootstrap-5') }}
            </div>
        </div>
   </div>
   <!-- Table Cate End -->

@endsection
@section('modal')
    <!-- Modal -->
    @include('layouts.admin.components.catProModal')
    <!--End Modal -->
@endsection