@extends('admin')
@section('content')
    <div class="container">
        
        <div class="card mt-5">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 my-2">
                        <div class="row">
                            <div 
                            class="col-lg-6 col-sm-6">
                                <h5 class="card-title">
                                    @isset($speci)
                                        Sửa thông số <strong>{{$speci->name}}</strong>
                                    @else
                                        Thêm thông số
                                    @endisset
                                </h5>          
                            </div>       
                            <div class="col-lg-6 col-sm-6">
                                <div class="d-flex justify-content-end">
                                    <a 
                                    href="{{ route('speci.index') }}">
                                        <button type="button" class="btn me-2 btn-close"></button>
                                    </a>  
    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="bg-light rounded h-100 p-3 text-start">
                            <form 
                                action="@isset($speci) {{ route('speci.update') }} @else {{ route('speci.store') }} @endisset"
                                method="post">
                                @csrf
                                @isset($speci) @method('patch')
                                @else  @method('post')
                                @endisset

                                <div class="row mb-3">
                                    <input type="text" name="speci_id" value="@isset($speci){{$speci->id}}@endisset" hidden>
                                    
                                    <div class="col-sm-12 col-xl-12 mb-3">                            
                                        <label 
                                        for="name" class="form-label">Tên thông số <span class="text-danger text-small">(*)</span></label>
                                        
                                        <textarea 
                                        type="text" class="form-control" name="name" rows="2" autocomplete="name"
                                        placeholder="Kích thước màn hình,bộ nhớ,..."
                                        id="name">@isset($speci){{$speci->name}}@else{{old('name')}}@endisset</textarea>
                                    
                                        @error('name')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
            
                                    </div>
                                    <div class="col-sm-12 col-xl-12 mb-3">
                                        
                                        <label 
                                        for="categories_product_id" class="form-label">Danh mục <span class="text-danger text-small">(*)</span></label>
                                        
                                        <select @disabled(true)
                                        class="form-select" name="categories_product_id" id="categories_product_id" aria-label="Default select example">
                                            @isset($categories)
                                                @foreach ($categories as $category)
                                                    <option 
                                                    value="{{$category->id}}" @selected($category->slug == request()->query('danh_muc',null))>
                                                        {{$category->name}}
                                                    </option>
                                                
                                                @endforeach
                                            @endisset
                                        </select>
            
                                    </div>
                                
                                </div>
                                <div class="col-sm-12 col-xl-12 mb-3">
                                    <div class="d-flex justify-content-end">
                                        @isset($speci)
                                            <button 
                                            type="submit" class="btn btn-sm btn-primary me-2">Sửa</button>
                                        @else
                                            <button
                                            type="submit" class="btn btn-sm btn-primary me-2">Thêm</button>
                                        @endisset
                                        <a 
                                        href="{{ route('speci.index') }}">
                                            <button
                                            type="button" class="float-right btn btn-sm btn-secondary me-2">Thoát</button>
                                        </a>                                            
            
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-8">
                        <div class="bg-white rounded h-100 p-2 text-start">
                            <div class="table-responsive mb-2" style="height: 70vh">
                                <div class="my-2">
                                    <form 
                                    action="@isset($speci){{ route('speci.edit', ['id'=>$speci->id]) }} @else {{ route('speci.create') }} @endisset" method="get">
                                    <label for="filter-category">Danh mục</label>
                                    <div class="d-flex">
                                        <select name="danh_muc" id="filter-category" class="form-select">
                                            @foreach ($categories as $category)
                                            <option value="{{$category->slug}}" @selected($category->slug == request()->query('danh_muc'))
                                                >{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                            <button type="submit" class="btn btn-outline-primary">Lọc</button>
                                            @csrf
                                        </div>
                                    </form>
                                </div>
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Action</th>
                                            <th scope="col">Tên thông số</th>
                                            <th scope="col">Danh mục</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @isset($specis)
                                            @forelse ($specis as $speciLoop)
                                                <tr>
                                                    <td>
                                                        <div 
                                                        class="d-flex">
                                                            <a  
                                                            class="me-2 btn btn-sm btn-primary @isset($speci)@if ($speci->id == $speciLoop->id) d-none @endif @endisset" href="{{ route('speci.edit', ['id' => $speciLoop->id,'danh_muc'=>request()->query('danh_muc',null)]) }}" title="Edit" >
                                                                <i class="far fa-edit"></i>
                                                            </a>
                                                            <form action="{{ route('speci.delete') }}" method="POST">
                                                                @csrf
                                                                @method('delete')
                                                                <input type="text" name="speci_id" value="{{$speciLoop->id}}" hidden>
                                                                <input type="text" name="danh_muc" value="{{request()->query('danh_muc',null)}}" hidden>
                                                                <button class="btn btn-sm btn-danger" type="submit" title="Xóa"><i class="far fa-trash-alt"></i></button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                    <td ><p>{{$speciLoop->name}}</p></td>
                                                    <td >
                                                        <p>
                                                        @isset($speciLoop->category){{$speciLoop->category->name}}
                                                        @else Không có 
                                                        @endisset
                                                        </p>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <th scope="col" class="text-center" colspan="4">Không có thông số nào</th>                                                               
                                                </tr>
            
                                            @endforelse
                                        @endisset
                                    </tbody>
                                </table>
                            </div>
                            @isset($paginate){{ $paginate->links('pagination::bootstrap-5') }}@endisset
                        </div>
                    </div>
                </div>
    
            </div>
        </div>
    </div>
@endsection