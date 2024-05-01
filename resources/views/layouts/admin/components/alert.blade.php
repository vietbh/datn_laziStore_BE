<div class="position-fixed top-25 end-0 mt-4 me-2" style="z-index: 99999;">
    <div class="me-2 mt-5 alert {{session('error') ? 'alert-danger' : 'alert-success' }} alert-dismissible fade show" id="alert" role="alert">
        @if (session('success')) <i class="fas fa-check-circle"></i> {{session('success')}}
        @else <i class="fa fa-exclamation-circle me-2"></i> {{session('error')}}
        @endif
        <button type="button" class="btn-close btn-sm text-sm" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>

