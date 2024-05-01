<div class="mb-3 row">
    <!-- Split dropstart button -->
       <div class="col-lg-8">
           <div class="btn-group d-flex justify-content-start">
               <div class="btn-group dropend" role="group">
                   <button type="button" class="btn btn-sm btn-outline-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                       Bộ lọc
                   </button>

                   <ul class="dropdown-menu" style="min-width: 100vh">
                       <li>
                           <div class="container p-3">
                               <form class="row gy-1 mt-2" action="{{ route('speci.filter') }}" method="get">
                                   @csrf
                                   <div class="col-md-6 col-lg-6 mb-3">
                                       <div class="form-floating">
                                           <select 
                                           class="form-select" autocomplete="name" name="name" id="name">
                                               <option value="">Chọn</option>
                                               <option value="ASC"  @if (request()->get('name') == 'ASC') selected @endif>Từ A-Z</option>
                                               <option value="DESC" @if (request()->get('name') == 'DESC') selected @endif>Từ Z-A</option>
                                           </select>
                                           <label for="name">Tên</label>
                                       </div>
                                   </div>
                                   <div class="col-md-6 col-lg-6 mb-3">
                                       <div class="form-floating">
                                           <select
                                           class="form-select" autocomplete="category" name="category" value="{{request()->get('category')}}" id="category">
                                               <option value="">Chọn</option>
                                               @foreach ($categories as $category)
                                                    <option
                                                    value="{{$category->name}}"  @if (request()->get('category') == $category->name) selected @endif>{{$category->name}}</option>
                                                   
                                               @endforeach
                                           </select>
                                           <label for="category">Danh mục</label>
                                       </div>
                                     </div>
                                 
                                    <div class="col-md-12 col-lg-12">
                                       <button type="submit" class="btn btn btn-primary"><i class="fas fa-filter"></i></button>
                                       <a href="{{ route('speci.index') }}" class="btn btn btn-danger">Bỏ lọc</a>
                                    </div>
                               </form>
                           </div>
                       </li>
                       
                   </ul>
               </div>
     
           </div>
       </div>
       <div class="col-lg-4">
           <form class="d-flex justify-content-end" action="{{ route('speci.filter') }}" method="get">
               @csrf
               <div class="col-md-12">
                    <div class="input-group">
                        <input type="text" class="form-control border-0 " name="search" value="{{request()->get('search')}}" placeholder="Tìm kiếm">
                        <button type="submit" class="btn btn-sm btn-white bg-white">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M11 6C13.7614 6 16 8.23858 16 11M16.6588 16.6549L21 21M19 11C19 15.4183 15.4183 19 11 19C6.58172 19 3 15.4183 3 11C3 6.58172 6.58172 3 11 3C15.4183 3 19 6.58172 19 11Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                        </button>

                    </div>
               </div>
           </form>
       </div>
   </div>