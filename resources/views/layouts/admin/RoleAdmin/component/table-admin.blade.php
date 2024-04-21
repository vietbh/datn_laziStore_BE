<div class="table-responsive" style="height: 100vh">
    <table class="table text-start align-middle table-bordered table-hover mb-0" >
        <thead>
            <tr class="text-dark">
                <th scope="col">Action</th>
                <th scope="col">Ngày tạo</th>
                <th scope="col">Tên quản trị</th>
                <th scope="col">Vai trò</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($listManager as $admin)
                <tr>
                    <td>
                        <div 
                        class="d-flex justify-content-evenly">
                            <a 
                            class="btn btn-sm btn-primary" href="{{ route('admin.edit', ['id' => $admin->id,'tab'=>'admin']) }}">Edit</a>
                            {{-- <form 
                            action="{{ route('role.delete') }}" method="POST">
                                @csrf
                                @method('delete')
                                <input type="hidden" name="">
                                <button class="btn btn-sm btn-danger" type="submit">Xóa</button>
                            </form> --}}
                        </div>
                    </td>
                    <td>{{$admin->created_at->format('d/m/Y')}}</td>
                    <td class="text-uppercase fw-bold">{{$admin->name}}</td>
                    <td>{{$admin->roleName($admin->role)->role_name }}</td>
                </tr>
            @endforeach                      
        </tbody>
    </table>
</div>