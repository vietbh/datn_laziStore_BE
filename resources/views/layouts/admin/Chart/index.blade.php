@extends('admin')
@section('content')
    <!-- Sale & Revenue Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-line fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Today Sale</p>
                        <h6 class="mb-0">$1234</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-bar fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Total Sale</p>
                        <h6 class="mb-0">$1234</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-area fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Today Revenue</p>
                        <h6 class="mb-0">$1234</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-pie fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Total Revenue</p>
                        <h6 class="mb-0">$1234</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Sale & Revenue End -->

    <!-- Table Cate Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h4 class="mb-0">Thống kê </h4>
            </div>
            {{--  --}}
            <div class="mb-4">
                <!-- Chart Start -->
                <div class="container-fluid pt-4 px-4">
                    <div class="row g-4 bg-white">
                        <div class="col-sm-12 col-xl-12">
                            <h5>Thống kê sản phẩm</h5>    
                        </div>
                        {{-- <div class="col-sm-12 col-xl-6">
                            <div class="bg-light rounded h-100 p-4">
                                <h6 class="mb-4">Single Line Chart</h6>
                                <canvas id="line-chart"></canvas>
                            </div>
                        </div>
                        <div class="col-sm-12 col-xl-6">
                            <div class="bg-light rounded h-100 p-4">
                                <h6 class="mb-4">Multiple Line Chart</h6>
                                <canvas id="salse-revenue"></canvas>
                            </div>
                        </div> --}}
                        <div class="col-sm-12 col-xl-6">
                            <div class=" rounded h-100 p-4">
                                <h6 class="mb-4">Sản phẩm theo danh mục</h6>
                                <canvas id="pie-chart"></canvas>
                            </div>
                        </div>
                        <div class="col-sm-12 col-xl-6">
                            <div class=" rounded h-100 p-4">
                                <h6 class="mb-4">Tin tức theo danh mục</h6>
                                <canvas id="doughnut-chart"></canvas>
                            </div>
                        </div>
                        <div class="col-sm-12 col-xl-12">
                            <div class="bg-light rounded h-100 p-4">
                                <h6 class="mb-4">Multiple Bar Chart</h6>
                                <canvas id="worldwide-sales"></canvas>
                            </div>
                        </div>
                  
                    </div>
                </div>
                <!-- Chart End -->
            </div>
            {{--  --}}
            <div class="col-sm-12 col-xl-12">
                <h5>Đơn hàng</h5>
                <div class="mt-3 mb-1">
                    <div class="row">
                            
                    </div>                    
                </div>
                <div style="min-height: 70vh">
                    <table class="table text-start align-middle table-bordered table-hover mb-0" id="table-items">
                        <thead>
                            <tr class="text-dark">
                                <th scope="col">Mã đơn</th>
                                <th scope="col">Tên khách hàng</th>
                                <th scope="col">Tổng đơn</th>
                                <th scope="col">Ngày mua</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    {{-- <td><input class="form-check-input" type="checkbox"></td> --}}
                                    <td>{{$order->order_number}}</td>
                                    <td>{{$order->full_name}}</td>
                                    <td>{{number_format($order->total,0,',','.')}}đ</td>
                                    <td>{{\Carbon\Carbon::parse($order->date_create)->format('d/m/Y') }}</td>
                                </tr>
                            @endforeach                      
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
    <!-- Table Cate End -->
@endsection
@section('css')
    <style rel="stylesheet">
        div.dt-button-collection {
            width: 400px;
        }

        div.dt-button-collection button.dt-button {
            display: inline-block;
            width: 32%;
        }

        div.dt-button-collection button.buttons-colvis {
            display: inline-block;
            width: 49%;
        }

        div.dt-button-collection h3 {
            margin-top: 5px;
            margin-bottom: 5px;
            font-weight: 100;
            border-bottom: 1px solid rgba(181, 181, 181, 0.5);
            font-size: 1em;
            padding: 0 1em;
        }

        div.dt-button-collection h3.not-top-heading {
            margin-top: 10px;
        }
    </style>
@endsection
@section('js')
    <script type="text/javascript">
        function generatePastelColor() {
            var r = Math.floor(Math.random() * 128) + 128;
            var g = Math.floor(Math.random() * 128) + 128;
            var b = Math.floor(Math.random() * 128) + 128;

            var hexColor = '#' + rgbToHex(r, g, b);
            return hexColor;
        }

        function rgbToHex(r, g, b) {
            var red = r.toString(16).padStart(2, '0');
            var green = g.toString(16).padStart(2, '0');
            var blue = b.toString(16).padStart(2, '0');
            return red + green + blue;
        }

        $(document).ready(function() {
            $('#table-items').DataTable({
                columnDefs: [{
                    targets: 1,
                    className: 'noVis'
                }],
                layout: {
                    topStart: {
                        buttons: [
                            'pageLength',
                            {
                                extend: 'copyHtml5',
                                exportOptions: {
                                    columns: [0, ':visible']
                                },
                            },
                            {
                                text: 'Setting',
                                extend: 'collection',
                                className: 'custom-html-collection',
                                buttons: [
                                    '<h3>Export</h3>',
                                    'pdf', 'excel', 'csv', 'print',
                                    '<h3 class="not-top-heading">Column Visibility</h3>',
                                    'colvisRestore',
                                    'columnsToggle',
                                ],
                            },

                        ]
                    }
                }
            });
            // 
           
            // Pie Chart
            $.ajax({
                url: "{{ route('chart.product.data') }}",
                method: "GET",
                cache: true,
                timeout: 30000
            }).done(function(jsonData){
                var ctx4 = $("#pie-chart").get(0).getContext("2d");
                const dataset = {
                    label: 'Dữ liệu',
                    data: jsonData,
                    backgroundColor: [],
                    borderColor: [],
                    borderWidth: 1
                };
                
                // Tạo màu sắc ngẫu nhiên cho từng tùy chỉnh dữ liệu
                for (let i = 0; i < jsonData.length; i++) {
                    const color = generatePastelColor();
                    dataset.backgroundColor.push(color);
                    dataset.borderColor.push(color);
                }
            
                var myChart4 = new Chart(ctx4, {
                    type: "pie",
                    data: {
                        labels:jsonData.map((value, index, array) => value._id),

                        datasets: [dataset]
                    },
                    options: {
                        parsing: {
                            key: '_value'
                        },
                        responsive: true
                    }
                });
            });

            // Doughnut Chart
            $.ajax({
                url: "{{ route('chart.news.data') }}",
                method: "GET",
                cache: true,
                timeout: 30000
            }).done(function(jsonData){
                var ctx6 = $("#doughnut-chart").get(0).getContext("2d");
                const dataset = {
                    label: 'Dữ liệu',
                    data: jsonData,
                    backgroundColor: [],
                    borderColor: [],
                    borderWidth: 1
                };
                
                // Tạo màu sắc ngẫu nhiên cho từng tùy chỉnh dữ liệu
                for (let i = 0; i < jsonData.length; i++) {
                    const color = generatePastelColor();
                    dataset.backgroundColor.push(color);
                    dataset.borderColor.push(color);
                }
            
                var myChart4 = new Chart(ctx6, {
                    type: "doughnut",
                    data: {
                        labels:jsonData.map((value, index, array) => value._id),
                        datasets: [ dataset]
                    },
                    options: {
                        parsing: {
                            key: '_value'
                        },
                        responsive: true
                    }
                });
            });

        });
    </script>
@endsection
