@extends('admin')
@section('content')
    @if (session('success'))
        @include('layouts.admin.components.alert')
    @endif
    @if($errors->any())
        <script type="module"> 
            var myModal = new bootstrap.Modal(document.getElementById('addCategoriesModal'), {
            keyboard: false
            })
            myModal.toggle();
            myModal.show();
        </script>
    @endif   
    @php
        $modal = [
            'id'=>'addCategoriesModal',
            'title'=>'danh mục tin tức',
            'name'=>'',
            'param'=>'',
            'route'=>[
                'index'=>'news.cat.index',
                'store'=>'news.cat.store',
                'update'=>'news.cat.update',
                'delete'=>'news.cat.delete',
            ],
            'selections'=>[
                'Tên danh mục'=>['name'=>'Nhập tên của danh mục (vd:Sức khỏe,Công nghệ,...)'],
                'Thứ tự'=>['index'=>'Nhập thứ tự hiện của danh mục (vd:1,2,3,...)'],
            ],
            'inputSelect' =>[
                'Danh mục cha'=>['parent_id'=>'Chọn danh mục cha(Nếu có)']
            ],
        ];
    @endphp
    @isset($category)
        @php
            $model = $category;
        @endphp
        <script type="module"> 
            var myModal = new bootstrap.Modal(document.getElementById('addCategoriesModal'), {
            keyboard: false
            })
            myModal.toggle();
            myModal.show();
        </script>
    @endisset
    @isset($categoryDelete)
        @php
            $modal['name']=$categoryDelete->name;
            $modal['param']=$categoryDelete->id;
            $model = $categoryDelete;
        @endphp
        <script type="module"> 
            var myModal = new bootstrap.Modal(document.getElementById('comfirmModal'), {
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
               <h6 class="mb-0">Tất cả danh mục tin tức</h6>
               <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoriesModal">
                    <i class="fas fa-plus me-1"></i> Thêm danh mục
                </button>
            <!-- Modal -->
            @include('layouts.admin.components.modalAdd')
            {{-- Modal Comfirm --}}
            @include('layouts.admin.components.comfirmModal')
            <!--End Modal -->
           </div>
           <div class="table-responsive" style="height: 100vh">
               <table class="table text-start align-middle table-bordered table-hover mb-0" >
                   <thead>
                       <tr class="text-dark">
                           <th scope="col">Ngày tạo</th>
                           <th scope="col">Tên danh mục tin</th>
                           <th scope="col">Danh mục cha</th>
                           <th scope="col">Slug</th>
                           <th scope="col">Thứ tự</th>
                           <th scope="col">Trạng thái</th>
                           <th scope="col" colspan="2">Action</th>
                       </tr>
                   </thead>
                   <tbody>
                    @foreach ($categories as $category)
                        <tr title="{{$category->name}}">
                            <td>{{$category->created_at}}</td>
                            <td>{{$category->name}}</td>
                            <td>{{$category->parent ? $category->parent->name : 'Trống'}}</td>
                            <td>{{$category->slug}}</td>
                            <td>{{$category->index}}</td>
                            <td>{{$category->show_hide ? 'Hiện' : 'Ẩn'}}</td>
                            <td>
                                <div class="d-flex justify-content-evenly">
                                    @if ($category->id != 1)
                                        <a class="btn btn-sm btn-primary" href="{{ route('news.cat.edit', ['id' => $category->id]) }}">Edit</a>
                                        <a class="btn btn-sm btn-danger"  href="{{ route('news.cat.show', ['id' => $category->id]) }}">Xóa</a>
                                    @endif
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