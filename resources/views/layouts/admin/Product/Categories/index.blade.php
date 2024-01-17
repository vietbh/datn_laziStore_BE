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

   <!-- Recent Sales Start -->
   <div class="container-fluid pt-4 px-4">
       <div class="bg-light text-center rounded p-4">
           <div class="d-flex align-items-center justify-content-between mb-4">
               <h6 class="mb-0">Tất cả danh mục sản phẩm</h6>
               <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoriesModal">
                    Thêm danh mục
                </button>
            <!-- Modal -->
            @include('layouts.admin.Product.Categories.components.addCatModal')
            <!--End Modal -->
           </div>
           <div class="table-responsive" style="height: 30rem">
               <table class="table text-start align-middle table-bordered table-hover mb-0" >
                   <thead>
                       <tr class="text-dark">
                           <th scope="col"><input class="form-check-input" type="checkbox"></th>
                           <th scope="col">Date</th>
                           <th scope="col">Invoice</th>
                           <th scope="col">Customer</th>
                           <th scope="col">Amount</th>
                           <th scope="col">Status</th>
                           <th scope="col">Action</th>
                       </tr>
                   </thead>
                   <tbody>
                       <tr>
                           <td><input class="form-check-input" type="checkbox"></td>
                           <td>01 Jan 2045</td>
                           <td>INV-0123</td>
                           <td>Jhon Doe</td>
                           <td>$123</td>
                           <td>Paid</td>
                           <td><a class="btn btn-sm btn-primary" href="">Detail</a></td>
                       </tr>
                      
                       <tr>
                           <td colspan="12" >
                            <div class="btn-toolbar float-end" role="toolbar">
                                <div class="btn-group me-2" role="group" aria-label="Second group">
                                    <button type="button" class="btn btn-secondary"><<</button>
                                    <button type="button" class="btn btn-secondary">5</button>
                                    <button type="button" class="btn btn-secondary">6</button>
                                    <button type="button" class="btn btn-secondary">7</button>
                                    <button type="button" class="btn btn-secondary">>></button>
                                </div>
                            </div>
                           </td>
                       </tr>
                   </tbody>
               </table>
           </div>
       </div>
   </div>
   <!-- Recent Sales End -->

@endsection