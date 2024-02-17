@extends('admin')
@section('content')
    @if (session('success')||session('error'))
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
    @isset($category)
        <script type="module">
            var myModal = new bootstrap.Modal(document.getElementById('addCategoriesModal'), {
                keyboard: false
            })
            myModal.toggle();
            myModal.show();
        </script>
    @endisset
    @php
        $modal = [
            'id'=>'addTagsModal',
            'title'=>'tag tin tức',
            'name'=>'',
            'param'=>'',
            'route'=>[
                'index'=>'news.tag.index',
                'store'=>'news.tag.store',
                'update'=>'news.tag.update',
                'delete'=>'news.tag.delete',
            ],
            'selections'=>[
                'Tên Tag tin tức'=>['name'=>'Nhập tên của tag tin tức (vd:Sức khỏe,Công nghệ,...)'],
                'Thứ tự'=>['index'=>'Nhập thứ tự hiện của tag (vd:1,2,3,...)'],
            ],
        ];
    @endphp

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
                <h6 class="mb-0">Tất cả tag tin tức</h6>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTagsModal">
                    <i class="fas fa-plus me-1"></i> Thêm Tag
                </button>
                <!-- Modal -->
                @include('layouts.admin.components.modalAdd')
                <!--End Modal -->
            </div>
            <div class="table-responsive" style="height: 100vh">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">Ngày tạo</th>
                            <th scope="col">Tên Tag</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Thứ tự</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col" colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tags as $tag)
                            @php
                                $modal['name']=$tag->name;
                                $modal['param']=$tag->id;
                            @endphp
                            <tr title="{{$tag->name}}">
                                <td>{{$tag->created_at}}</td>
                                <td>{{$tag->name}}</td>
                                <td>{{$tag->slug}}</td>
                                <td>{{$tag->index}}</td>
                                <td>{{$tag->show_hide ? 'Hiện' : 'Ẩn'}}</td>
                                <td>
                                    <div class="d-flex justify-content-evenly">
                                        <a class="btn btn-sm btn-primary" href="{{ route('news.tag.edit', ['id' => $tag->id]) }}">Edit</a>
                                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#comfirmModal{{$tag->id}}">
                                            Xóa
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @include('layouts.admin.components.comfirmModal')
                        @endforeach                      
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <!-- Table Cate End -->
@endsection
