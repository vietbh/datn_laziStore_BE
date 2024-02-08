<script type="module">
    ClassicEditor.create(document.querySelector('#description') , {
    language: 'vi',
    ckfinder: {
        uploadUrl: '{{route('ckeditor.upload',['_token'=>csrf_token()])}}'
    },
    toolbar: {
        items: [  
            'fontfamily', 'fontsize', '|',
            'heading', '|',        
            'alignment', '|',
            'fontColor', 'fontBackgroundColor', '|',
            'bold', 'italic', 'underline', 'subscript', 'superscript', '|',
            'link', '|',
            'outdent', 'indent', '|',
            'bulletedList', 'numberedList', 'todoList', '|',
            'code', 'codeBlock', '|',
            'insertTable', '|',
            'uploadImage', '|',
            'ckfinder',
            'undo', 'redo'
        ],
        shouldNotGroupWhenFull: true
    },
    heading: {
        options: [
            { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
            { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
            { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
            { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
            { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
            { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
            { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
        ]
    },
    fontFamily: {
        options: [
            'default',
            'Arial, Helvetica, sans-serif',
            'Courier New, Courier, monospace',
            'Georgia, serif',
            'Lucida Sans Unicode, Lucida Grande, sans-serif',
            'Tahoma, Geneva, sans-serif',
            'Times New Roman, Times, serif',
            'Trebuchet MS, Helvetica, sans-serif',
            'Verdana, Geneva, sans-serif'
        ],
        supportAllValues: true
    },
    fontSize: {
        options: [ 10, 12, 14, 'default', 18, 20, 22 ],
        supportAllValues: true
    }
    })
    .then( editor => { editor.setData(''); })
    .catch( error => {console.error( error )} );
    // add input color
    const formColor = document.getElementById('formColor');
    let arrColors = [];
    let count = 0;
    document.getElementById('addColor').addEventListener('click', addInput);
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
    function createErrorSection(idError,message){
        return `<div id="message-${idError}" class="form-text text-danger"> ${message}</div>`;
    }
    function addInput() {
        const arrColor = {};
        const idInput = ['color_type', 'price', 'price_sale', 'quantity'];
        let isEmpty = true; 
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
        document.querySelector('input[name=colors]').value = JSON.stringify(arrColors);
    }
    formColor.addEventListener('click', function (event) {
        if (event.target.classList.contains('delete-color')) {
            const inputId = event.target.dataset.input;
            deleteInput(inputId);
        }
    });
</script>
