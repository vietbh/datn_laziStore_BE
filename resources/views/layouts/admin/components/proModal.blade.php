<div class="modal fade" id="addProductModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
            @isset($product)
                Sửa sản phẩm <strong>{{$product->name}}</strong>
            @else
                Thêm sản phẩm
            @endisset
        </h5>
        @isset($product)
        <a href="{{ route('product.index') }}" class="btn-close" aria-label="Close">
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
                            @isset($product)
                                action="{{ route('product.update',['id'=>$product->id]) }}"
                            @else
                                action="{{ route('product.store') }}"
                            @endisset
                            method="POST" enctype="multipart/form-data">
                                @csrf
                                @isset($product)
                                @method('put')
                                @else
                                @method('post')
                                @endisset
                                <div class="row mb-3">
                                    <div class="col-sm-12 col-xl-6 mb-3">
                                        <label for="name" class="form-label ">Tên sản phẩm <span class="text-danger text-small">(*)</span></label>
                                        <input type="text" name="name" class="form-control @error('name') 
                                        is-invalid
                                        @enderror" id="name"
                                        @isset($product)
                                            value="{{$product->name}}"
                                        @else
                                        value="{{old('name')}}"        
                                        @endisset
                                        placeholder="Nhập tên sản phẩm (vd:Iphone15,Samsung A23,...)"
                                        aria-describedby="name">
                                        @error('name')
                                        <div id="name" class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 col-xl-6 mb-3">
                                        <label for="seo_keywords" class="form-label">Từ khóa SEO<span class="text-danger text-small">(*)</span></label>
                                        <input type="text" name="seo_keywords" class="form-control" 
                                        @isset($product)
                                            value="{{$product->seo_keywords}}"
                                        @else
                                        value="{{old('seo_keywords')}}"        
                                        @endisset
                                        id="seo_keywords">   
                                        @error('seo_keywords')
                                        <div id="seo_keywords" class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-12 col-xl-6 mb-3">
                                        <label for="categories_product_id" class="form-label ">Danh mục sản phẩm <span class="text-danger text-small">(*)</span></label>
                                        <select class="form-select  
                                        @error('categories_product_id') 
                                        is-invalid
                                        @enderror" name="categories_product_id" 
                                        @isset($product)
                                            value="{{$product->categories_product_id}}"
                                        @else
                                        value="{{old('categories_product_id')}}"    
                                        @endisset
                                        id="categories_product_id">
                                            <option value="" selected disabled>Chọn danh mục sản phẩm</option>
                                            @foreach ($categories as $category)
                                                <option value="{{$category->id}}">{{$category->title}}</option>
                                            @endforeach
                                        </select>
                                        @error('categories_product_id')
                                            <div id="categories_product_id" class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 col-xl-6 mb-3">
                                        <label for="brand_id" class="form-label ">Thương hiệu <span class="text-danger text-small">(*)</span></label>
                                        <select class="form-select  
                                        @error('brand_id') 
                                        is-invalid
                                        @enderror" name="brand_id" 
                                        @isset($product)
                                            value="{{$product->brand_id}}"
                                        @else
                                        value="{{old('brand_id')}}"    
                                        @endisset
                                        id="brand_id">
                                            <option value="" selected disabled>Chọn thương hiệu sản phẩm</option>
                                            @foreach ($brands as $brand)
                                                <option value="{{$brand->id}}">{{$brand->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('brand_id')
                                            <div id="brand_id" class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-12 col-xl-6 mb-3">
                                        <label for="image_url" class="form-label ">Chọn hình ảnh <span class="text-danger text-small">(*)</span></label>
                                        <div class="d-flex justify-content-around">
                                            <input type="file" name="image_url" class="form-control @error('image_url') 
                                            is-invalid
                                            @enderror" id="image_url"
                                            @isset($product)
                                                value="{{$product->image_url}}"
                                            @else
                                            value="{{old('image_url')}}"        
                                            @endisset
                                            aria-describedby="image_url">
                                            @error('image_url')
                                                <div id="image_url" class="form-text text-danger">{{ $message }}</div>
                                            @enderror
                                            {{-- <button type="button" class="btn btn-secondary ms-1">Thêm</button> --}}
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-xl-6 mb-3">
                                        <label for="show_hide" class="form-label">Trạng thái (mặc định sẽ là Hiện)</label>
                                        <select class="form-select" name="show_hide" 
                                        autocomplete="off"
                                        @isset($product)
                                            value="{{$product->show_hide}}"
                                        @else
                                        value="{{old('show_hide')}}"    
                                        @endisset
                                        id="show_hide">
                                            <option value="show">Hiện</option>
                                            <option value="hide">Ẩn</option>
                                        </select>    
                                    </div>
                                </div>    
                                @include('layouts.admin.components.colorModal')
                                @include('layouts.admin.components.speciModal')    
                                <div class="row mb-3">
                                    <div class="col-sm-12 col-xl-12">
                                        <label for="description" class="form-label">Mô tả sản phẩm</label>
                                        <input name="description"
                                        id="description"
                                        class="form-control ck-editor__editable_inline" 
                                        @isset($product)
                                            value='{{$product->description}}'
                                        @endisset
                                        />
                                    </div>
                                </div>     
                                <div class="mb-3 float-end">
                                    <button type="submit" class="btn btn-primary">
                                        @isset($product)
                                        Sửa
                                    @else
                                        Thêm mới
                                    @endisset
                                    </button>
                                    @isset($product)
                                    <a href="{{ route('product.index') }}" class="btn btn-danger">
                                        Đóng
                                    </a>
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
<script type="module">
    ClassicEditor.create(document.querySelector('#description') , {language: 'vi'} )
    .then( editor => { editor.setData(''); } )
    .catch( error => {console.error( error )} );
    // add input color
const formColor = document.getElementById('formColor');

function createInputSection(inputId,color,price,price_sale,quantity) {
  return `
    <div id="i${inputId}">
      <hr/>
      <div class="row mb-3">
        <div class="col-sm-12 col-xl-3 mb-3">
          <label for="${color}" class="form-label">Màu sắc <span class="text-danger text-small">(*)</span></label>
          <input type="text" 
            class="form-control"
            value='${color}'
            disabled
            name="color_type"
            id="${color}">
        </div>
        <div class="col-sm-12 col-xl-3 mb-3">
          <label for="${price}" class="form-label ">Giá gốc(vnđ) <span class="text-danger text-small">(*)</span></label>
          <input type="text" class="form-control 
            id="${price}"
            value='${price}'
            name="price"
            disabled
            aria-describedby="price">
        </div>
        <div class="col-sm-12 col-xl-3 mb-3">
          <label for="${price_sale}" class="form-label ">Giá khuyến mãi(vnđ) <span class="text-danger text-small">(*)</span></label>
          <input type="text" class="form-control 
            id="${price_sale}"
            value='${price_sale}'
            name="price_sale"
            disabled
            aria-describedby="price_sale">
        </div>
        <div class="col-sm-12 col-xl-3 mb-3">
          <label for="${quantity}" class="form-label">Số lượng <span class="text-danger text-small">(*)</span></label>
          <div class="d-flex justify-content-around">
            <input
              type="text"
              class="form-control"
              value='${quantity}'
              disabled
              id="${quantity}"
              aria-describedby="quantity"/>
            <button type="button" class="btn-close btn-danger mt-2 ms-1 delete-color" data-input="${inputId}" aria-label="Close"></button>
          </div>
        </div>
      </div>
    </div>
  `;
}
let arrColors = [];
function createErrorSection(idError,message){
    return `<div id="message-${idError}" class="form-text text-danger"> ${message}</div>`;
}
let count = 0;
function addInput() {
    const arrColor = {};
    const idInput = ['color_type', 'price', 'price_sale', 'quantity'];
    let isEmpty = true; // Kiểm tra xem dữ liệu đầu vào có trống không hay không
    const inputSelectors = idInput.map(element => {
        return document.querySelector(`input[name=${element}]`);
    });

    inputSelectors.forEach((inputSelector,index,array) => {
        const input = document.querySelector(`#${inputSelector.name}`);
        if (inputSelector.value == '') {
            input.addEventListener('input',function(){
                const message = document.querySelector(`#message-${inputSelector.name}`);
                if(message)message.remove();    
            });
            if(count < array.length ){
                const errorSection = createErrorSection(inputSelector.name,'Vui lòng không bỏ trống trường này');            
                input.insertAdjacentHTML('afterend', errorSection);
                ++count;
            }   
        }else{
            arrColor[inputSelector.name] = inputSelector.value;
        } 
        let size = 0;
        size = Object.keys(arrColor).length;
        if(array.length === size){
            count = 0;
            isEmpty = false;
            inputSelectors.forEach(inputSelector=>inputSelector.value='');
        }
    });

    if (!isEmpty) {
        arrColors.push(arrColor);
        const inputSection = createInputSection(arrColors.length, arrColor.color_type, arrColor.price, arrColor.price_sale, arrColor.quantity);
        // document.querySelector('#initial-color').innerHTML = `Màu sản phẩm thứ ${arrColors.length+1}`;
        formColor.insertAdjacentHTML('afterbegin', inputSection);
        document.querySelector('input[name=colors]').value = JSON.stringify(arrColors);
    }
}
function deleteInput(inputId) {
      const inputElement = document.querySelector(`#i${inputId}`);
  if (inputElement) {
    // Xóa phần tử khỏi mảng arrColors
    const index = arrColors.findIndex(color => color.color_type === inputElement.querySelector('input[name=color_type]').value);
    if (index !== -1) {
      arrColors.splice(index, 1);
      inputElement.remove();
    }
  }
  // Cập nhật giá trị của input[name=colors]
  document.querySelector('input[name=colors]').value = JSON.stringify(arrColors);
}
formColor.addEventListener('click', function (event) {
    if (event.target.classList.contains('delete-color')) {
        const inputId = event.target.dataset.input;
        deleteInput(inputId);
    }
});
document.getElementById('addColor').addEventListener('click', addInput);
</script>
