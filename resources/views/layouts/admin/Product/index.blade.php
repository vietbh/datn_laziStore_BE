@extends('admin')
@section('content')
   <!-- Sale & Revenue Start -->
   <div class="container-fluid pt-4 px-4">
       <div class="row g-4">
      
           <div class="col-sm-6 col-xl-4">
               <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                   <i class="fa fa-chart-bar fa-3x text-primary"></i>
                   <div class="ms-3">
                       <p class="mb-2">Thương hiệu</p>
                       <h6 class="mb-0">{{count($brands)}}</h6>
                   </div>
               </div>
           </div>
           <div class="col-sm-6 col-xl-4">
               <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                   <i class="fa fa-chart-area fa-3x text-primary"></i>
                   <div class="ms-3">
                       <p class="mb-2">Danh mục</p>
                       <h6 class="mb-0">{{count($categories)}}</h6>
                   </div>
               </div>
           </div>
            <div 
            class="col-sm-6 col-xl-4">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-pie fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Tổng sản phẩm</p>
                        <h6 class="mb-0">{{ $productsCount}} sản phẩm</h6>
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
                <h4 class="mb-0">Tất cả sản phẩm</h4>
                <a href="{{ route('product.create') }}" class="btn btn-primary">
                    Thêm sản phẩm
                </a>
            </div>
            <div class="">                
                {{-- @include('layouts.admin.Product.filter',['categories'=>$categories,'brands'=>$brands]) --}}
                {{-- @isset($paginate)
                    <div class="d-flex justify-start">
                        <p class="m-0">
                            <select class="form-select m-0" name="size_page" id="size_page" data-action="{{ route('product.index', ['size_page'=>'']) }}">
                                <option value="10" @selected(request()->query('size_page') == 10)>10</option>
                                <option value="25" @selected(request()->query('size_page') == 25)>25</option>
                                <option value="50" @selected(request()->query('size_page') == 50)>50</option>
                                <option value="{{$paginate->total()}}" @selected(request()->query('size_page') == $paginate->total())>All</option>
                            </select>
                        </p>
                    </div>
                @endisset --}}
             
            </div>
            <div style="min-height: 75vh;">
                <table class="table text-start align-middle table-bordered table-hover mb-0 w-100" id="table-items" >
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">Action</th>
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">Danh mục</th>
                            <th scope="col" class="text-center">Số lượng màu</th>
                            <th scope="col" class="text-center">Loại sản phẩm</th>
                            <th scope="col" class="text-center">Số lượng</th>
                            <th scope="col">Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                        <tr title="{{$product->name}}">
                                <td>
                                    <div class="d-flex justify-content-around">
                                        <a 
                                        class="btn btn-sm btn-primary me-2" href="{{ route('product.edit', ['id' => $product->id]) }}" title="Edit"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('product.delete', ['id' => $product->id]) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button 
                                            class="btn btn-sm btn-danger" type="submit" title="Xóa"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </div>
                                </td>
                                <td>{{$product->name}}</td>
                                <td>{{$product->category->name}}</td>
                                <td><button class="btn btn-sm badge btn-primary">{{count($product->variations)}}</button></td>
                                <td>
                                    <button 
                                    class="btn btn-sm badge btn-primary {{$product->product_type_hot ? '' : 'd-none'}}">Hot</button>
                                    <button 
                                    class="btn btn-sm badge btn-primary {{$product->product_type_new ? '' : 'd-none'}}">New</button>
                                </td>
                                <td><span class="badge bg-primary">{{$product->variations()->sum('quantity')}} sản phẩm</span></td>
                                <td>@if($product->show_hide) <span class="badge bg-primary">Hiện</span>
                                @else <span class="badge bg-secondary">Ẩn</span>
                                @endif</td>
                            </tr>
                        @empty
                            <tr><th class="text-center my-4" colspan="10">Không tìm thấy sản phẩm nào</th></tr>
                        @endforelse                     
                    </tbody>
                </table>
            </div>        
            {{-- @isset($paginate)
                {{ $paginate->links('pagination::bootstrap-5') }}
            @endisset --}}
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
            border-bottom: 1px solid rgba(150, 150, 150, 0.5);
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
            $('#size_page').bind('change',function(e){
                e.preventDefault();
                const sizePage = $(this).val();
                let url = $(this).data('action')+sizePage
                location.href = url;
            });
            
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
                            'spacer',
                            {
                                extend: 'copyHtml5',
                                exportOptions: {
                                    columns: [0, ':visible']
                                },
                            },
                            'spacer',
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