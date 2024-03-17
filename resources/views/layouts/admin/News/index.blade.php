@extends('admin')
@section('content')
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
               <h5 class="mb-0">Tất cả tin tức</h5>
               <a href="{{ route('news.create') }}" class="btn btn-primary"><i class="fas fa-plus me-1"></i> Thêm tin tức</a>
           </div>
           <div class="table-responsive" style="height: 80vh">
               <table class="table text-start align-middle table-bordered table-hover mb-0" >
                   <thead>
                       <tr class="text-dark">
                           <th scope="col">Tên tin tức</th>
                           <th scope="col">Danh mục</th>
                           <th scope="col">Tác giả</th>
                           <th scope="col">Số lượng tag</th>
                           <th scope="col">Trạng thái</th>
                           <th scope="col" colspan="2">Action</th>
                       </tr>
                   </thead>
                   <tbody>
                        @foreach ($news as $n)
                            <tr title="{{$n->title}}">
                                <td>{{$n->title}}</td>
                                <td>{{$n->category->name}}</td>
                                <td>{{$n->author}}</td>
                                <td><button class='btn btn-primary'>{{count($n->tags)}}</button></td>
                                <td>{{$n->show_hide ? 'Hiện' : 'Ẩn'}}</td>
                                <td>
                                <div class="d-flex justify-content-evenly">
                                    <a class="btn btn-sm btn-primary" href="{{ route('news.edit', ['id' => $n->id]) }}">Detail</a>
                                    <form action="{{ route('news.delete', ['id' => $n->id]) }}" method="POST">
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
           <div class="mb-2">
               {{ $news->links('pagination::bootstrap-5') }}
           </div>
       </div>
   </div>
   <!-- Table Cate End -->
@endsection 