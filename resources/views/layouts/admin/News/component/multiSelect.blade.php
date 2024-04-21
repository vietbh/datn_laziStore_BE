<script type="module">
    $(document).ready(function(){
        let data = JSON.parse('<?php echo isset($tags) ? $tags : '[]' ?>');
        $('.js-example-basic-multiple').select2({
            tags: "true",
            data: data,
            theme: "bootstrap-5",
            language: "es",
            allowClear: true,
            width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
            placeholder: $( this ).data( 'Chọn tag' ),
            dropdownCssClass: "select2--small",
        });
    });

</script> 
