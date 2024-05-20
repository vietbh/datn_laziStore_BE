@extends('admin')
@section('content')
<div class="container-fluid pt-4">
    <div class="mt-2 mb-4">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('news.index') }}">Danh sách tin tức</a></li>
              <li class="breadcrumb-item active" aria-current="page">Cập nhật tin tức</li>
            </ol>
        </nav>
    </div>
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
          <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Tin tức</button>
          {{-- @isset($new)
            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Tag</button>  
          @endisset --}}
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
        <div class="bg-light">
            <div class="modal-body p-0">
                <div class="container-fluid pt-4 px-4 mb-4">
                    <div class="row ms-3">
                        <h5>
                            @isset($new)
                                Sửa tin tức <strong>{{$new->title}}</strong>
                            @else
                                Thêm tin tức
                            @endisset
                        </h5>
                    </div>
                    <div class="row g-4">
                        <div class="col-sm-12 col-xl-12">
                            <div class="bg-light rounded h-100 p-4 text-start">
                                <form 
                                action="@isset($new) {{ route('news.update',['id'=>$new->id]) }} @else {{ route('news.store') }} @endisset"
                                method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @isset($new) @method('put')
                                    @else @method('post')
                                    @endisset
                                    <div class="row mb-3">
                                        <div class="col-sm-12 col-xl-6 mb-3">
                                            <label for="title" class="form-label ">Tiêu đề tin tức <span class="text-danger text-small">(*)</span></label>
                                            <input 
                                            type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title"
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
                                            <input 
                                            type="text" name="seo_keywords" class="form-control" 
                                            @isset($new) value="{{$new->seo_keywords}}" @endisset
                                            placeholder="Vui lòng nhập trường này"
                                            id="seo_keywords">   
                                            @error('seo_keywords')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-sm-12 col-xl-12">
                                            <label for="sub_title" class="form-label">Mô tả ngắn<span class="text-danger text-small">(*)</span></label>
                                            <textarea 
                                            name="sub_title" class="form-control" id="sub_title" placeholder="Nhập mô tả ngắn" rows="3">@isset($new){{$new->sub_title}}@else{{old('sub_title')}}@endisset</textarea>
                                            @error('sub_title')
                                                <div class="form-text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-12 col-xl-6 mb-3">
                                            <label for="author" class="form-label ">Tác giả<span class="text-danger text-small">(*)</span></label>
                                            <input 
                                            class="form-control @error('author') is-invalid @enderror" name="author" 
                                            @isset($new) value="{{$new->author}}" @endisset
                                            autocomplete="author"
                                            placeholder="Vui lòng nhập tên tác giả"
                                            id="author" />
                                            @error('author')
                                                <div class="form-text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-sm-12 col-xl-6 mb-3">
                                            <label for="categories_news_id" class="form-label ">Danh mục bài viết <span class="text-danger text-small">(*)</span></label>
                                            <select 
                                            class="form-select  
                                            @error('categories_news_id')is-invalid @enderror" name="categories_news_id" 
                                            id="categories_news_id">
                                                @foreach ($categories as $category)
                                                    <option 
                                                    value="{{$category->id}}" @isset($new) @selected($new->categories_news_id == $category->id) @endisset>{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('categories_news_id')
                                                <div  class="form-text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="col-sm-12 col-xl-12 mb-3">
                                            <label for="tagId" class="form-label">Tag</label>
                                            <!-- Multiple Select -->
                                            <select class="js-example-basic-multiple" id="tagId" name="tag_id[]" multiple>
                                                @isset($new)
                                                    @foreach ($new->tags as $tag)
                                                        <option value="{{$tag->tag->id}}" selected>{{$tag->tag->name}}</option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-12 col-xl-12 mb-3">
                                            @isset($new)
                                                <div class="mb-3"><img class="img_fluid" width='250' src="{{$new->image_url}}" alt=""></div>
                                            @endisset
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
                                                <button type="button" class="btn btn-secondary ms-1">Thêm</button>
                                            </div>
                                            @error('image_url')
                                                <div class="form-text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-sm-12 col-xl-12 mb-3">
                                            <label for="show_hide" class="form-label">Trạng thái (mặc định sẽ là Hiện)</label>
                                            <select class="form-select" name="show_hide" id="show_hide">
                                                <option 
                                                value="1" @isset($new) @selected($new->show_hide) @endisset >Hiện</option>
                                                <option
                                                value="0" @isset($new) @selected(!$new->show_hide) @endisset >Ẩn</option>
                                            </select>    
                                        </div>
                                    </div>    
                                    <div class="row mb-3">
                                        <div class="col-sm-12 col-xl-12">
                                            <label for="description" class="form-label">Mô tả tin tức</label>
                                            <textarea name="description" 
                                            class="form-control ck-editor__editable_inline" 
                                            id="description">
                                                @isset($new){{$new->description}} @endisset
                                            </textarea>
                                        </div>
                                    </div>     
                                    <div class=" mb-3 float-end">
                                        <button type="submit" class="btn btn-primary">
                                            @isset($new) Sửa
                                            @else Thêm mới
                                            @endisset
                                        </button>
                                        <a href="{{ route('news.index') }}" class="btn btn-danger">Đóng</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0"></div> --}}
    </div>
</div>
@endsection
@section('js')
@include('layouts.admin.News.component.multiSelect')
@include('layouts.admin.News.component.ckeditor')
@endsection