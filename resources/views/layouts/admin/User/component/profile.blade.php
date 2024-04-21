<div class="container-fluid ">
    <div class="row g-4 mb-4">
        <div class="col-sm-6 col-md-6 col-lg-4">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-line fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Tổng chi</p>
                    <h6 class="mb-0">{{number_format($user->orders->sum('total'),'0',',','.')}}đ</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-4">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-bar fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Đơn hàng </p>
                    <h6 class="mb-0">{{$user->orders->count()}}</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-4">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-area fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Số Items</p>
                    <h6 class="mb-0">{{$user->orders->sum('count_items')}}</h6>
                </div>
            </div>
        </div>
        {{-- <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-pie fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Total Revenue</p>
                    <h6 class="mb-0">$1234</h6>
                </div>
            </div>
        </div> --}}
    </div>
</div>