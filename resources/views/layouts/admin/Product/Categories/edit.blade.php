@extends('admin')
@section('content')

        <!-- Form Start -->
        <div class="container-fluid pt-4 px-4" style="height: 40rem">
            <div class="row g-4">
                <div class="col-sm-12 col-xl-12">
                    <div class="bg-light rounded h-100 p-4">
                        <div class="d-flex justify-content-between ">
                            <h6 class="mb-4">Thêm danh mục sản phẩm</h6>
                            <h6 class="mb-4 float-right"><a href="{{ route('categories-product') }}" class="link"> Quay lại danh mục</a></h6>
                        </div>
                        <form action="" class="row gap-4">
                            @csrf
                            <div class="mb-3 col-sm-12 col-xl-6">
                                <label for="exampleInputEmail1" class="form-label">Tên danh mục</label>
                                <input type="email" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="title">
                                {{-- <div id="title" class="form-text">We'll never share your email with anyone else.
                                </div> --}}
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Miêu tả về danh mục(nếu có)</label>
                                <input type="password" class="form-control" id="exampleInputPassword1">
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Check me out</label>
                            </div>
                            <button type="submit" class="btn btn-primary">Sign in</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Form End -->

@endsection