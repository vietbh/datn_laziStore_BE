@extends('admin')
@section('content')
    @if($errors->any())
        <script type="module">
            var myModal = new bootstrap.Modal(document.getElementById('addTagsModal'), {
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
                <h4 class="mb-0">Tất cả tag tin tức</h4>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTagsModal"><i class="fas fa-plus me-1"></i>Thêm Tag</button>
            </div>
            <div style="min-height: 73vh;">
                <table class="table text-start align-middle table-bordered table-hover mb-0" id="table-items">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">Action</th>
                            <th scope="col">Tên Tag</th>
                            <th scope="col">Thứ tự</th>
                            <th scope="col">Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        @isset($tags)
                            @foreach ($tags as $tag)
                                <tr title="{{$tag->name}}">
                                    <td>
                                        @if ($tag->id != 1)
                                            <div class="d-flex">
                                                <a href="{{ route('news.tag.edit', ['id' => $tag->id]) }}" class="btn btn-sm btn-primary me-2" title="Edit"><i class="fas fa-edit"></i></a>
                                                <form action="{{ route('news.tag.delete') }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <input type="text" name="tag_id" value="{{$tag->id}}" hidden id="">
                                                    <button class="btn btn-sm btn-danger" type="submit" title="Delete"><i class="fas fa-trash-alt"></i></button>
                                                </form>
                                                {{-- <a href="{{ route('news.tag.show', ['id'=>$tag->id]) }}" class="btn btn-sm btn-danger" title="Delete" ><i class="fas fa-trash-alt"></i></a> --}}
                                            </div>
                                        @endif
                                    </td>
                                    <td>{{$tag->name}}</td>
                                    <td><span class="badge bg-primary">{{$tag->position}}</span></td>
                                    <td><span class="badge bg-primary">{{$tag->show_hide ? 'Hiện' : 'Ẩn'}}</span></td>
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
@section('modal')
    <!-- Modal -->
    @include('layouts.admin.components.modalAdd')
    @include('layouts.admin.components.comfirmModal')
    <!--End Modal -->
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