<div class="table-responsive" style="height: 100vh">
    <table class="table text-start align-middle table-bordered table-hover mb-0" >
        <thead>
            <tr class="text-dark">
                <th scope="col">Action</th>
                <th scope="col">Ngày tạo</th>
                <th scope="col">Tên vai trò</th>
                <th scope="col">Mô tả</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($roles as $role)
                <tr>
                    <td>
                        <div 
                        class="d-flex justify-content-start">
                            <a 
                            class="btn btn-sm btn-primary me-2" href="{{ route('role.edit', ['id' => $role->id, 'tab'=>'role']) }}">Edit</a>
                            @if ($role->id != 1)
                                <form 
                                action="{{ route('role.delete') }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <input type="hidden" name="role_id">
                                    <button 
                                    class="btn btn-sm btn-danger" type="submit">Xóa</button>
                                </form>
                                
                            @endif
                        </div>
                    </td>
                    <td>{{ $role->created_at->format('d/m/Y')}}</td>
                    <td class="text-uppercase fw-bold">{{$role->role_name}}</td>
                    <td>{{$role->description ??'Không có' }}</td>
                </tr>
            @endforeach                      
        </tbody>
    </table>
</div>