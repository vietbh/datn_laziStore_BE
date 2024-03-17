<script type="module">
    $(document).ready(function(){
        let data = JSON.parse('<?php echo isset($tagJson) ? $tagJson : '[]' ?>');
        console.log(data);
        $('.js-example-basic-multiple').select2({
            tags: "true",
            data: data,
            theme: "bootstrap-5",
            width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
            placeholder: $( this ).data( 'Chọn tag' ),
            dropdownCssClass: "select2--small",
        })
    });

</script> 