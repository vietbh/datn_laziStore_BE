<script >
    $(document).ready(function() {
        let data = <?php echo isset($tags) ? $tags : '[]' ?>;
        
        $('#tagId').select2({
            tags: true,
            data: data,
            theme: 'bootstrap-5',
            language: 'es',
            allowClear: true,
            cache: true,
            width: $(this).data('width') || $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: 'Chọn tag cho tin tức',
            dropdownCssClass: 'select2--small'
        })
        .on('select2:unselecting', function(e) {
            const tagId = e.params.args.data.id;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });
            $.ajax({
                url: "{{route('news.tag.remove')}}",
                method:"POST",
                data:{
                    tag_id:tagId,
                    news_id: {{isset($new) ? $new->id : '[]'}},
                    _token:" {{ csrf_token() }}"
                },
                cache:true
            }).done(function(jsonData){
                let result = JSON.parse(jsonData);
                console.log(result);
            })
        });
        
    });

</script> 
