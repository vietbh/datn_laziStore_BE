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
    @isset($tag)
        @php
            $model = $tag;
        @endphp
        <script type="module">
            setTimeout(() => {
                var myModal = new bootstrap.Modal(document.getElementById('addTagsModal'),{
                    keyboard: false
                })
                myModal.toggle();
                myModal.show();
            }, 0);
        </script>
    @endisset
    @isset($tagDelete)
        @php
            $modal['name']=$tagDelete->name;
            $modal['param'] = $tagDelete->id;
        @endphp
        <script type="module">
            setTimeout(() => {
                var myModal = new bootstrap.Modal(document.getElementById('comfirmModal'),{
                    keyboard: false
                })
                myModal.toggle();
                myModal.show();
            },0);
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
                <h6 class="mb-0">Tất cả tag tin tức</h6>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTagsModal"><i class="fas fa-plus me-1"></i>Thêm Tag</button>
                <!-- Modal -->
                @include('layouts.admin.components.modalAdd')
                @include('layouts.admin.components.comfirmModal')
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
                        @isset($tags)
                            @foreach ($tags as $tag)
                                <tr title="{{$tag->name}}">
                                    <td>{{$tag->created_at}}</td>
                                    <td>{{$tag->name}}</td>
                                    <td>{{$tag->slug}}</td>
                                    <td>{{$tag->index}}</td>
                                    <td>{{$tag->show_hide ? 'Hiện' : 'Ẩn'}}</td>
                                    <td>
                                        <div class="d-flex justify-content-evenly">
                                            <a href="{{ route('news.tag.edit', ['id' => $tag->id]) }}" class="btn btn-sm btn-primary" id="edit">Edit</a>
                                            <a href="{{ route('news.tag.show', ['id'=>$tag->id]) }}" class="btn btn-sm btn-danger" id="delete" >Xóa</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach                      
                        @endisset
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <!-- Table Cate End -->
@endsection
