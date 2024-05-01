@extends('admin')
@section('content')
@php
    $tab = request()->query('tab');
@endphp
    <div class="container-fluid mt-5 mb-5" style="height: 85vh">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('product.edit', ['id'=>$product->id]) }}">Sản phẩm {{$product->name}}</a></li>
              <li class="breadcrumb-item active" aria-current="page">Thêm thông số sản phẩm</li>
            </ol>
        </nav>
        <div class="card bg-light">
            <div class="card-body p-1 m-3">
                <div class="container">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                          <button class="nav-link active " id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Thông số sản phẩm</button>
                          {{-- <button class="nav-link @if($tab == 'speci') active @endif" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Thông số setting</button> --}}
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h5 class="card-title my-3">
                                        @isset($productSpecification)
                                            Sửa thông số {{$productSpecification->speci->name}}
                                        @else
                                            Thêm thông số {{$product->name}}
                                        @endisset
                                    </h5>                 
                                </div>
                                <div class="col-sm-6 col-xl-4">
                                    <div class="bg-white rounded h-100 p-3 text-start">
                            
                                        <form 
                                        action="@isset($productSpecification) {{ route('specifi.update') }} @else {{ route('specifi.store') }} @endisset"
                                        method="post">
                                            @csrf
                                            @isset($productSpecification) @method('put')
                                            @else @method('post')
                                            @endisset
                                            <div class="row mb-3">
                                                <div 
                                                class="col-sm-12 col-xl-12 mb-3">
                                                    <input 
                                                    type="text" value="{{$product->id}}" name="product_id" hidden>
                                                    @isset($productSpecification) <input type="text" value="{{$productSpecification->id}}" name="product_speci_id" hidden> @endisset
                                                    <label 
                                                    for="speci_id" class="form-label">Tên thông số <span class="text-danger text-small">(*)</span></label>
                                                        
                                                    <select 
                                                    class="js-example-basic-single form-control" name="speci_id" id="speci_id">
                                                        @isset($specis)
                                                            @foreach ($specis as $speci)
                                                                <option 
                                                                value="{{$speci->id}}" @isset($productSpecification) @selected($productSpecification->speci_id == $speci->id) @endisset>
                                                                    {{$speci->name}} ({{$speci->category->name}})
                                                                </option>
                                                            
                                                            @endforeach
                                                        @endisset
                                                      </select>     

                                                    @error('speci_id')
                                                        <div class="form-text text-danger">{{ $message }}</div>
                                                    @enderror

                                                </div>

                                                <div 
                                                class="col-sm-12 col-xl-12 mb-3">
                                                    <label for="value" class="form-label ">Giá trị thông số <span class="text-danger text-small">(*)</span></label>
                                                    
                                                    <textarea 
                                                    type="text" class="form-control @error('value')is-invalid @enderror" name="value" rows="1" autocomplete="value"
                                                    placeholder="Kích thước màn hình,bộ nhớ,..." id="value">@isset($productSpecification){{$productSpecification->value}}@else{{old('value')}}@endisset</textarea>
                                                   
                                                    @error('value')
                                                        <div class="form-text text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div 
                                                class="col-sm-12 col-xl-12 mb-3">
                                                    <div 
                                                    class="card">
                                                        <div 
                                                        class="card-body pt-1 bg-light">
                                                            <h6 
                                                            class="fw-normal mb-3">Các setting khác</h6>
                                                            <div 
                                                            class="d-flex justify-content-start">
                                                                <div 
                                                                class="form-check form-switch">
                                                                    <input 
                                                                    class="form-check-input" type="checkbox" name="type_speci" autocomplete="off" id="type_speci" 
                                                                    @isset($productSpecification)
                                                                    @checked($productSpecification->type_speci)
                                                                    @endisset >
                                                                    <label 
                                                                    class="form-check-label" for="type_speci">Thông số đặc biệt</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div 
                                                class="col-sm-12 col-xl-12 mb-3">
                                                    <label 
                                                    for="rep_speci_product_id" class="form-label">Thông số chung</label>
                                                    <select disabled
                                                    class="js-example-basic-single form-control" name="rep_speci_product_id" id="rep_speci_product_id">
                                                        <option value="" selected>Không có</option>
                                                        @isset($products)
                                                            @foreach ($products as $product)
                                                                <option 
                                                                value="{{$product->id}}" @isset($productSpecification) {{$productSpecification->product_id == $product->id ? 'selected':''}} @endisset >{{$product->name}}</option>
                                                            
                                                            @endforeach
                                                        @endisset

                                                    </select>                                         
                                                   
                                                </div>

                                                <div 
                                                class="col-sm-12 col-xl-12 mb-3">
                                                    <label 
                                                    for="position" class="form-label ">Thứ tự</label>
                                                    
                                                    <input 
                                                    type="number" name="position" class="form-control
                                                    @error('position') is-invalid @enderror" id="position"
                                                    @isset($productSpecification) value="{{$productSpecification->position}}"
                                                    @else value="{{old('position') ?? 1}}"
                                                    @endisset
                                                    autocomplete="position"
                                                    placeholder="Nhập thứ tự hiển thị"
                                                    aria-describedby="position" />
                                                    @error('position')
                                                        <div class="form-text text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div 
                                                class="col-sm-12 col-xl-12 mb-3">
                                                    <label 
                                                    for="show_hide" class="form-label">Ẩn hiện (mặc định sẽ là Hiện)</label>
                                                    
                                                    <select
                                                    class="form-select" name="show_hide" autocomplete="show_hide"
                                                    id="show_hide">
                                                        <option value="1" @isset($productSpecification) @selected(!$productSpecification->show_hide) @endisset>Hiện</option>
                                                        <option value="0" @isset($productSpecification) @selected(!$productSpecification->show_hide) @endisset>Ẩn</option>
                                                    </select>    
                                                </div>

                                                <div 
                                                class="col-sm-12 col-xl-12 mb-3">
                                                    <div class="d-flex justify-content-end">
                                                        @isset($productSpecification)
                                                            <button type="submit" class="btn btn-primary me-2">Sửa</button>
                                                            <a href="{{ route('specifi.create',['idProduct' => $product->id]) }}">
                                                                <button type="button" class="float-right btn btn-secondary me-2">Đóng</button>
                                                            </a>                                            
                                                        @else
                                                            @if($productSpecificationCount > 0)
                                                                <a href="{{ route('varia.create',['id' => $product->id ]) }}">
                                                                    <button type="button" class="float-right btn btn-sm btn-success me-2">Màu sản phẩm</button>
                                                                </a>                                            
                                                                <a href="{{ route('product.index') }}">
                                                                    <button type="button" class="float-right btn btn-sm btn-secondary me-2">Đóng</button>
                                                                </a>                                            
                                                            @endif
                                                            <button type="submit" class="btn @if($productSpecificationCount > 0) btn-sm @endif btn-primary me-2">Thêm</button>
                                                        @endisset
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-xl-8">
                                    <div class="bg-white rounded h-100 p-2 text-start">
                                        <div class="table-responsive">
                                            <div class="mt-2 mb-2">
                                                <div class="row mb-2">
                                                    <label for="danh_muc" class="mb-2">Danh mục thông số</label>
                                                    <div class="col-12">
                                                        <div class="d-flex">
                                                            <select
                                                            class="form-select me-1" autocomplete="danh_muc" name="danh_muc" data-action="@isset($productSpecification) {{ route('specifi.edit', ['id' => $productSpecification->id,'danh_muc'=>'']) }}
                                                            @else {{ route('specifi.create',['idProduct' => $product->id,'danh_muc'=>'']) }} @endisset"  id="danh_muc">
                                                                @foreach ($categories as $category)
                                                                    <option
                                                                    value="{{$category->slug}}" 
                                                                    @selected(request()->get('danh_muc') == $category->slug)>{{$category->name}}<small>({{$category->specis()->count()}})</small>                                                                        
                                                                    </option>                                                            
                                                                @endforeach
                                                            </select>
    
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <table class="table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th scope="col" class="text-start">Action</th>
                                                        <th scope="col">Tên</th>
                                                        <th scope="col">Giá trị</th>
                                                        {{-- <th scope="col">Thông số thuộc</th> --}}
                                                        <th scope="col">Loại</th>
                                                        <th scope="col">Ẩn Hiện</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @isset($productSpecifications)
                                                        @forelse ($productSpecifications as $productSpeci)
                                                            <tr>
                                                                <td>
                                                                    <div class="d-flex justify-content-evenly">
                                                                        <a class="@isset($productSpecification){{$productSpeci->id == $productSpecification->id ? 'd-none' : ''}} @endisset" href="{{ route('specifi.edit', ['id' => $productSpeci->id,'danh_muc'=>request()->get('danh_muc')]) }}" title="Edit"  >
                                                                            <button class="btn btn-sm btn-primary">
                                                                                <i class="fas fa-edit"></i>
                                                                            </button>
                                                                        </a>
                                                                        <form action="{{ route('specifi.delete', ['id' => $productSpeci->id]) }}" method="POST">
                                                                            @csrf
                                                                            @method('delete')
                                                                            <button class="btn btn-sm btn-danger" type="submit" title="Xóa"><i class="fas fa-trash-alt"></i></button>
                                                                        </form>
                                                                    </div>
                                                                </td>
                                                                <td ><p class="text-capitalize">{{$productSpeci->speci->name}} <span class="badge bg-primary text-sm">({{$productSpeci->speci->category->name}})</span></p></td>
                                                                <td ><p class="text-capitalize">{{ $productSpeci->value }}</p></td>
                                                                {{-- <td><p>
                                                                    @foreach ($products as $product)
                                                                        @if ($product->id == $productSpeci->rep_speci_product_id){{ $product->name }} @break @endif
                                                                        @if ($productSpeci->rep_speci_product_id == null) {{'Không có'}} @break @endif
                                                                    @endforeach
                                                                    
                                                                </p></td> --}}
                                                                <td ><p><span class="badge bg-primary">{{$productSpeci->type_speci ? 'Đặc biệt' : 'Chung' }}</span></p></td>
                                                                <td ><p><span class="badge bg-primary">{{$productSpeci->show_hide ? 'Hiện' : 'Ẩn' }}</span></p></td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="11" class="text-center"><p class="fw-medium">Không có thông số nào</p></td>
                                                            </tr>
                                                        @endforelse
                                                    @else
                                                        <thead>
                                                            <tr>
                                                                <th scope="col" class="text-start">Action</th>
                                                                <th scope="col">Tên</th>
                                                                <th scope="col">Giá trị</th>
                                                                <th scope="col">Thông số thuộc</th>
                                                                <th scope="col">Ẩn Hiện</th>
                                                                <hr>
                                                            </tr>
                                                        </thead>
                                                    @endisset
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
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
            $('#danh_muc').bind('change',function(){
                const danhMuc = $(this).val();
                let url = $(this).data('action')+danhMuc
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
                            {
                                extend: 'copyHtml5',
                                exportOptions: {
                                    columns: [0, ':visible']
                                }
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
                                ]
                            },
                          
                        ]
                    }
                }
            });
     
        });
     
    </script>
@endsection