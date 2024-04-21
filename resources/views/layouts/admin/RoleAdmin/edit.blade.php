@extends('admin')
@section('content')
    @php
        $tab = request()->tab;
    @endphp

    <div class="container-fluid">
        <div class="mt-2 mb-4">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li 
                    class="breadcrumb-item"><a href="{{ route('role.index') }}">Danh sách quyền</a></li>
                    @if ($tab == 'role') 
                        @isset($role)
                            <li class="breadcrumb-item active" aria-current="page">Chỉnh sửa quyền truy cập</li>
                        @else
                            <li 
                            class="breadcrumb-item active" aria-current="page">Thêm mới
                            </li>
                        @endisset
                    @endif
                    
                    @if ($tab == 'admin')
                        @isset($admin)
                            <li 
                            class="breadcrumb-item active" aria-current="page">Chỉnh sửa quản trị viên
                            </li>
                        @else
                            <li 
                            class="breadcrumb-item active" aria-current="page">Thêm mới
                            </li>
                        @endisset
                    @endif
                </ol>
            </nav>

        </div>

        <div class="container-fluid mt-3 p-4">
            @if ($tab == 'role')
                @isset($role)
                    @include('layouts.admin.RoleAdmin.component.edit.form-role', ['role' => $role])
                @else
                    @include('layouts.admin.RoleAdmin.component.edit.form-role')
                @endisset
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                </div>
            @endif
            @if ($tab == 'admin')
                @isset($admin)
                    @include('layouts.admin.RoleAdmin.component.edit.form-manager', [
                        'admin' => $admin,
                    ])
                @else
                    @include('layouts.admin.RoleAdmin.component.edit.form-manager')
                @endisset
            @endif
        </div>
    </div>
@endsection
