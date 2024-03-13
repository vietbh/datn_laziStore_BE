<div class="position-fixed top-25 end-0">
    <div class="d-block me-2 mt-3 alert {{session('error') ? 'alert-danger' : 'alert-success' }} alert-dismissible fade show p-3" id="alert" role="alert">
        <div class="d-flex align-items-center">
            <i class="fa fa-exclamation-circle me-2"></i>
            {{session('success')}}
            {{session('error')}}
        </div>
    </div>
</div>

