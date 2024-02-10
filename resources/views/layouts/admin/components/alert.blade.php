<div class="position-fixed top-25 end-0 me-2 mt-3 alert {{session('error')?'alert-danger':'alert-success'}} alert-dismissible fade show p-3" id="alertSuccess" role="alert">
    <i class="fa fa-exclamation-circle me-2"></i>
        {{session('success')}}
        {{session('error')}}
</div>
<script type="module">
    setTimeout(() => {
        var myAlert = document.getElementById('alertSuccess')
        var bsAlert = new bootstrap.Alert(myAlert)
        bsAlert.close()
    }, 3000);
</script>
