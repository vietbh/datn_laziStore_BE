<div class="modal fade" id="addNewsModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="true" aria-labelledby="addNewsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="addNewsModalLabel">
            @isset($new)
                Sửa tin tức <strong>{{$new->title}}</strong>
            @else
                Thêm tin tức
            @endisset
        </h5>
        @isset($new)
        <a href="{{ route('news.index') }}" class="btn-close" aria-label="Close">
        </a>
        @else
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        @endisset
        </div>
        <div class="modal-body p-0">
            <div class="container-fluid pt-4 px-4 mb-4" >
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-light rounded h-100 p-4 text-start">
                            <form 
                            @isset($new)
                                action="{{ route('news.update',['id'=>$new->id]) }}"
                            @else
                                action="{{ route('news.store') }}"
                            @endisset
                            method="POST" enctype="multipart/form-data">
                                @csrf
                                @isset($new)
                                @method('put')
                                @else
                                @method('post')
                                @endisset
                                <div class="row mb-3">
                                    <div class="col-sm-12 col-xl-6 mb-3">
                                        <label for="title" class="form-label ">Tiêu đề tin tức <span class="text-danger text-small">(*)</span></label>
                                        <input type="text" name="title" class="form-control @error('title') 
                                        is-invalid
                                        @enderror" id="title"
                                        @isset($new)
                                            value="{{$new->title}}"
                                        @endisset
                                        placeholder="Nhập tên tin tức (vd:Iphone15,Samsung A23,...)"
                                        aria-describedby="title">
                                        @error('title')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 col-xl-6 mb-3">
                                        <label for="seo_keywords" class="form-label">Từ khóa SEO<span class="text-danger text-small">(*)</span></label>
                                        <input type="text" name="seo_keywords" class="form-control" 
                                        @isset($new)
                                            value="{{$new->seo_keywords}}"
                                        @endisset
                                        placeholder="Vui lòng nhập trường này"
                                        id="seo_keywords">   
                                        @error('seo_keywords')
                                        <div id="seo_keywords" class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-12 col-xl-6 mb-3">
                                        <label for="author" class="form-label ">Tác giả<span class="text-danger text-small">(*)</span></label>
                                        <input class="form-control 
                                        @error('author') 
                                        is-invalid
                                        @enderror" 
                                        name="author" 
                                        @isset($new)
                                            value="{{$new->author}}"
                                        @endisset
                                        autocomplete="author"
                                        placeholder="Vui lòng nhập tên tác giả"
                                        id="author" />
                                        @error('author')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 col-xl-6 mb-3">
                                        <label for="categories_news_id" class="form-label ">Danh mục bài viết <span class="text-danger text-small">(*)</span></label>
                                        <select class="form-select  
                                        @error('categories_news_id') 
                                        is-invalid
                                        @enderror" name="categories_news_id" 
                                        @isset($new)
                                            value="{{$new->categories_news_id}}"
                                        @endisset
                                        id="categories_product_id">
                                            <option value="" selected disabled>Chọn danh mục </option>
                                            @foreach ($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('categories_product_id')
                                            <div id="categories_product_id" class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 col-xl-12 mb-3">
                                        <label for="tag_id" class="form-label ">Tag <span class="text-danger text-small">(*)</span></label>
                                        <!-- Multiple Select -->
                                        <select class="js-example-basic-multiple" name="tag_id[]" multiple="multiple">
                                            <option value="">Alabama</option>
                                            <option value="AL">Alabama</option>
                                            <option value="WY">Wyoming</option>
                                        </select>
                                        @error('tag_id')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror 
                                        @include('layouts.admin.News.multiSelect')
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-12 col-xl-6 mb-3">
                                        <label for="image_url" class="form-label ">Chọn hình ảnh <span class="text-danger text-small">(*)</span></label>
                                        <div class="d-flex justify-content-around">
                                            <input type="file" name="image_url"
                                            class="form-control 
                                            @error('image_url') 
                                                is-invalid
                                            @enderror"
                                            id="image_url"
                                            @isset($new)
                                                value="{{$new->image_url}}"
                                            @endisset
                                            aria-describedby="image_url">
                                            @error('image_url')
                                                <div id="image_url" class="form-text text-danger">{{ $message }}</div>
                                            @enderror
                                            <button type="button" class="btn btn-secondary ms-1">Thêm</button>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-xl-6 mb-3">
                                        <label for="show_hide" class="form-label">Trạng thái (mặc định sẽ là Hiện)</label>
                                        <select class="form-select" name="show_hide" 
                                        @isset($new)
                                            value="{{$new->show_hide}}"
                                        @endisset
                                        id="show_hide">
                                            <option value="1">Hiện</option>
                                            <option value="0">Ẩn</option>
                                        </select>    
                                    </div>
                                </div>    
                                <div class="row mb-3">
                                    <div class="col-sm-12 col-xl-12">
                                        <label for="description" class="form-label">Mô tả tin tức</label>
                                        <textarea name="description" 
                                        class="form-control ck-editor__editable_inline" 
                                        id="description">
                                            @isset($new)
                                                {{$new->description}}
                                            @endisset
                                        </textarea>
                                    </div>
                                </div>     
                                <div class=" mb-3 float-end">
                                    <button type="submit" class="btn btn-primary">
                                        @isset($new)
                                        Sửa
                                    @else
                                        Thêm mới
                                    @endisset
                                    </button>
                                    @isset($new)
                                        <a href="{{ route('news.index') }}" class="btn btn-danger">Đóng</a>
                                    @else
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Đóng</button>
                                    @endisset
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
@include('layouts.admin.News.ckeditor')
