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
                            <th></th>
                            <th scope="col">Action</th>
                            <th scope="col">Tên thông số</th>
                            <th scope="col">Danh mục</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($specis as $speci)
                            <tr>
                                <th>{{$speci->id}}</th>
                                <td>
                                    <div class="d-flex">
                                        <a class="me-2" href="{{ route('speci.edit', ['id' => $speci->id]) }}"
                                            title="Edit">
                                            <button class="btn btn-sm btn-primary"><i class="far fa-edit"></i></button>
                                        </a>
                                        <form action="{{ route('speci.delete') }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <input type="text" name="speci_id" value="{{ $speci->id }}" hidden>
                                            <button class="btn btn-sm btn-danger" type="submit" title="Xóa"><i
                                                    class="far fa-trash-alt"></i></button>
                                        </form>
                                    </div>
                                </td>
                                <td>
                                    <p>{{ $speci->name }}</p>
                                </td>
                                <td>
                                    <p>
                                        @isset($speci->category)
                                            {{ $speci->category->name }}
                                        @else
                                            Không có
                                        @endisset
                                    </p>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <th scope="col" class="text-center" colspan="12">Không có thông số nào</th>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('css')
    <link type="text/css" href="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/css/dataTables.checkboxes.css"
        rel="stylesheet" />

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
    <script type="text/javascript"
        src="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/js/dataTables.checkboxes.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            $('#table-items').DataTable({
                columnDefs: [{
                    'targets': 0,
                    'checkboxes': {
                        'selectRow': true
                    }
                }],
                select: {
                    'style': 'multi'
                },
                order: [
                    [1, 'asc']
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
                                    'pdf', 'excel', 'csv', 'print',
                                    '<h3 class="not-top-heading">Column Visibility</h3>',
                                    'colvisRestore',
                                    'columnsToggle',
                                ],
                            },

                        ]
                    }
                }
            });
            $('#frm-example').on('submit', function(e) {
                var form = this;

                var rows_selected = table.column(0).checkboxes.selected();

                // Iterate over all selected checkboxes
                $.each(rows_selected, function(index, rowId) {
                    // Create a hidden element
                    $(form).append(
                        $('<input>')
                        .attr('type', 'hidden')
                        .attr('name', 'id[]')
                        .val(rowId)
                    );
                });
            });
        });
    </script>
@endsection
