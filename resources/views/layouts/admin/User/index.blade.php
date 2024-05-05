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
                <h4 class="mb-0">Danh sách khách hàng</h4>
                <!-- Modal -->
                {{-- @include('layouts.admin.components.catProModal') --}}
                <!--End Modal -->
            </div>
            <div style="min-height: 75vh">
                <table class="table text-start align-middle table-bordered table-hover mb-0" id="table-items">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">Action</th>
                            <th scope="col">Tên khách hàng</th>
                            <th scope="col">Hình đại diện</th>
                            <th scope="col">Email</th>
                            <th scope="col">Xác minh email</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Ngày tạo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr title="{{ $user->name }}">
                                <td>
                                    <div class="d-flex">
                                        <a class="btn btn-sm btn-primary"
                                            href="{{ route('guest.edit', ['id' => $user->id]) }}">Detail</a>
                                    </div>
                                </td>
                                <td>{{ $user->name }}</td>
                                <td class="d-flex justify-content-center">
                                    @isset($user->image_url)
                                        <img src="{{ asset('storage/' . $user->image_path) }}" loading="lazy"
                                            class="rounded-circle" width="80" height="80" alt="{{ $user->image_url }}" />
                                    @else
                                        <span class="badge bg-secondary">Chưa có hình ảnh</span>
                                    @endisset
                                </td>
                                <td>{{ $user->email }}</td>
                                <td><span
                                        class="{{ $user->email_verified_at ? 'text-success' : 'text-danger' }} ">{{ $user->email_verified_at ? $user->email_verified_at->format('d/m/Y') : 'Chưa xác thực' }}</span>
                                </td>
                                <td><span
                                        class="badge bg-{{ $user->user_status ? 'success' : 'danger' }}">{{ $user->user_status ? 'online' : 'offline' }}</span>
                                </td>
                                <td><span class="badge bg-primary">{{ $user->created_at->format('d/m/Y') }}</span></td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="11">
                                    <p class="fw-bold">Không có khách hàng nào</p>
                                </td>
                            </tr>
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
        $(document).ready(function() {

            $('#table-items').DataTable({
                columnDefs: [{
                    targets: 1,
                    className: 'noVis'
                }],
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

        });
    </script>
@endsection
