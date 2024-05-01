@extends('admin')
@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h4 class="mb-0">Tất cả thông số</h4>
                <a href="{{ route('speci.create') }}" class="btn btn-primary">
                    Thêm thông số
                </a>
            </div>
            {{-- <div class="container-fluid">
                @include('layouts.admin.Product.Specification.filter', [
                    'categories' => $categories,
                ])
            </div> --}}
            <div style="min-height: 75vh">
                <table class="table text-start align-middle table-bordered table-hover mb-0" id="table-items">
                    <thead>
                        <tr>
                            <th scope="col">Action</th>
                            <th scope="col">Tên thông số</th>
                            <th scope="col">Danh mục</th>
                        </tr>
                    </thead>
                    <tbody>
                        @isset($specis)
                            @forelse ($specis as $speci)
                                <tr>
                                    <td>
                                        <div 
                                        class="d-flex">
                                            <a  
                                            class="me-2" href="{{ route('speci.edit', ['id' => $speci->id]) }}" title="Edit" >
                                                <button 
                                                class="btn btn-sm btn-primary"><i class="far fa-edit"></i></button>
                                            </a>
                                            <form action="{{ route('speci.delete') }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <input type="text" name="speci_id" value="{{$speci->id}}" hidden>
                                                <button class="btn btn-sm btn-danger" type="submit" title="Xóa"><i class="far fa-trash-alt"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                    <td ><p>{{$speci->name}}</p></td>
                                    <td><p>@isset($speci->category){{$speci->category->name}} @else Không có @endisset</p></td>
                                </tr>
                            @empty
                                <tr>
                                    <th scope="col" class="text-center" colspan="3">Không có thông số nào</th>                                                               
                                </tr>

                            @endforelse
                        @else
                            <tr>
                                <th scope="col" class="text-center" colspan="3">Chưa có thông số nào</th>                                                               
                            </tr>
                        @endisset
                    </tbody>
                </table>
            </div>
            @isset($paginate)
                {{ $paginate->links('pagination::bootstrap-5') }}
            @endisset
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