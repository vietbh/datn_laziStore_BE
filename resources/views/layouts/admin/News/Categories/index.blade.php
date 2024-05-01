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
                'Thứ tự'=>['position'=>'Nhập thứ tự hiện của danh mục (vd:1,2,3,...)'],
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
               <h4 class="mb-0">Tất cả danh mục tin tức</h4>
               <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoriesModal">
                    <i class="fas fa-plus me-1"></i> Thêm danh mục
                </button>
           </div>
           <div style="min-height: 75vh">
               <table class="table text-start align-middle table-striped table-hover mb-0 w-100" id="table-items">
                   <thead>
                       <tr class="text-dark">
                           <th scope="col">Action</th>
                           <th scope="col">Tên danh mục tin</th>
                           <th scope="col">Danh mục cha</th>
                           <th scope="col">Thứ tự</th>
                           <th scope="col">Trạng thái</th>
                           <th scope="col">Ngày tạo</th>
                       </tr>
                   </thead>
                   <tbody>
                    @foreach ($categories as $cat)
                        <tr title="{{$cat->name}}">
                            <td>
                                <div class="d-flex justify-content-evenly">
                                    @if ($cat->id != 1)
                                        <a class="btn btn-sm btn-primary" href="{{ route('news.cat.edit', ['id' => $cat->id]) }}">Edit</a>
                                        <a class="btn btn-sm btn-danger"  href="{{ route('news.cat.show', ['id' => $cat->id]) }}">Xóa</a>
                                    @endif
                                </div>
                            </td>
                            <td>{{$cat->created_at}}</td>
                            <td>{{$cat->name}}</td>
                            <td>{{$cat->parent ? $cat->parent->name : 'Trống'}}</td>
                            <td>{{$cat->position}}</td>
                            <td>{{$cat->show_hide ? 'Hiện' : 'Ẩn'}}</td>
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
    @include('layouts.admin.components.modalAdd')
    {{-- Modal Comfirm --}}
    @include('layouts.admin.components.comfirmModal')
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