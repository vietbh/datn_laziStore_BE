@if ($errors->any())
    <script type="module">
        let myModal = new bootstrap.Modal(document.getElementById('{{$modal}}'), {
            keyboard: false
        })
        myModal.toggle();
        myModal.show();
    </script>
@endif
@if (isset($edit))
    <script type="module">
        let myModal = new bootstrap.Modal(document.getElementById('{{$modal}}'), {
            keyboard: false
        })
        myModal.toggle();
        myModal.show();
    </script>
@endif
