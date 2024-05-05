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
               <h4 class="mb-0">Tất cả tin tức</h4>
               <a href="{{ route('news.create') }}" class="btn btn-primary"><i class="fas fa-plus me-1"></i> Thêm tin tức</a>
           </div>
            {{-- <div class="container-fluid">
            @include('layouts.admin.News.component.filter',['categories'=>$categories])
            </div> --}}
           <div style="min-height: 80vh">
               <table class="table text-start align-middle table-bordered table-hover mb-0" id="table-items">
                   <thead>
                       <tr class="text-dark">
                           <th scope="col">Action</th>
                           <th scope="col">Tên tin tức</th>
                           <th scope="col">Danh mục</th>
                           <th scope="col">Tác giả</th>
                           <th scope="col">Số lượng tag</th>
                           <th scope="col">Trạng thái</th>
                       </tr>
                   </thead>
                   <tbody>
                        @forelse ($news as $n)
                            <tr title="{{$n->title}}">
                                <td>
                                    <div class="d-flex">
                                        <a class="btn btn-sm btn-primary me-2" href="{{ route('news.edit', ['id' => $n->id]) }}" title="Edit"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('news.delete') }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <input type="text" name="news_id" id="" value="{{$n->id}}" hidden>
                                            <button class="btn btn-sm btn-danger" type="submit" title="Delete"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </div>
                                </td>
                                <td class="text-wrap">{{$n->title}}</td>
                                <td><span class="badge bg-success text-capitalize">{{$n->category->name}}</span></td>
                                <td><span class="badge bg-primary">{{$n->author}}</span></td>
                                <td><span class="badge bg-primary">{{$n->tags()->count()}}</span></td>
                                <td><span class="badge bg-primary">{{$n->show_hide ? 'Hiện' : 'Ẩn'}}</span></td>
                            </tr>
                        @empty
                            <tr><th colspan="10" class="text-center m-3">Không tìm thấy kết quả</th></tr>
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