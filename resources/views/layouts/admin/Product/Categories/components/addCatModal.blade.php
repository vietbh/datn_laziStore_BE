<div class="modal fade " id="addCategoriesModal" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Thêm danh mục sản phẩm</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-0">
            <div class="container-fluid pt-4 px-4 mb-4" >
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-light rounded h-100 p-4 text-start">
                            <form action="{{ route('store', ['id'=>1]) }}" >
                                @csrf
                                <div class="mb-3 ">
                                    <label for="title" class="form-label ">Tên danh mục <span class="text-danger text-small">*</span></label>
                                    <input type="text" name="title" class="form-control" id="title"
                                        aria-describedby="title">
                                    {{-- <div id="title" class="form-text">We'll never share your email with anyone else.
                                    </div> --}}
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Miêu tả về danh mục (nếu có)</label>
                                    <input type="text" name="description" class="form-control" id="description">
                                </div>
                                <div class="mb-3">
                                    <label for="show_hide" class="form-label">Trạng thái (mặc định sẽ là Hiện)</label>
                                    <select class="form-select" name="show_hide" id="show_hide">
                                        <option value="show">Hiện</option>
                                        <option value="hide">Ẩn</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Thêm mới</button>
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Đóng</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
