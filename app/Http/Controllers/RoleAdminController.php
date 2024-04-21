<?php

namespace App\Http\Controllers;


use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password as RulesPassword;

class RoleAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $roles = Role::whereNot('role_name', 'guest')->get();
        $listManager = User::whereIn('role',$roles->pluck('id'))->get();
        return view('layouts.admin.RoleAdmin.index',compact('roles','listManager'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $roles = Role::whereNot('role_name', 'guest')->get();
        return view('layouts.admin.RoleAdmin.edit',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator = $request->validateWithBag('roleEdit',[
            'role_name' =>'required|unique:roles,role_name',
            'description' =>'max:255',
            // 'type_access'=>'array'
        ],[
            'role_name.required' => 'Vui lòng không để trống',
            'role_name.unique' => 'Đã tồn tại quyền này',
            'description.max' => 'Tối đa 255 ký tự',
        ]);
        Role::create($validator);
        return back()->with('success','Thêm mới quyền thành công');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $role = Role::findOrFail($id);
        $roles = Role::whereNot('role_name', 'guest')->get();
        return view('layouts.admin.RoleAdmin.edit',compact('role','roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $role = Role::findOrFail($id);
        $validator = $request->validateWithBag('roleEdit',[
            'role_name' =>'required|unique:roles,role_name,'.$id,
            'description' =>'max:255',
            'type_access'=>'array'
        ],[
            'role_name.required' => 'Vui lòng không để trống',
            'role_name.unique' => 'Đã tồn tại quyền này',
            'description.max' => 'Tối đa 255 ký tự',
        ]);
        $role->fill($validator);
        $role->save();
        return back()->with('success','Cập nhật quyền thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
        $role = Role::findOrFail($request->role_id);
        $role->delete();
        return redirect()->route('role.index')->with('Xóa quyền thành công');
    }

    // Manager
      /**
     * Show the form for editing the specified resource.
     */
    public function createManager()
    {
        //
        $roles = Role::whereNot('role_name', 'guest')->get();
        return view('layouts.admin.RoleAdmin.edit',compact('roles'));
    }
    public function storeManager(Request $request)
    {
        //
        $validator = $request->validateWithBag('managerEdit',[
            'name' => ['required', 'string', 'max:255','unique:'.User::class],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', RulesPassword::defaults()],
            'image_url'=>'image|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',
            'role'=>'numeric'
        ],[
            'name.required' =>'Vui lòng nhập trường này',
            'email.required' =>'Vui lòng nhập trường này',
            'password.required' =>'Vui lòng nhập trường này',
        ]);
        
        $admin = User::create([
            'name' => $validator['name'],
            'email' => $validator['email'],
            'password' => Hash::make($validator['password']),
            'email_verified_at' => now(),
            'role' => $validator['role']
        ]);
       
        $file = $request->file('image_url'); // Lấy file từ request    
        if ($file) {
            // Tiếp tục xử lý hoặc trả về đường dẫn đã lưu
            $path = $file->store('avatar_user', 'public'); // Lưu file vào thư mục 'folder_name'
            $url = asset(Storage::url($path));
            $admin->image_url = $url;        
            $admin->image_path = $path;   
            $admin->save();     
        }
        event(new Registered($admin));
        return back()->with('success','Thêm mới quản trị viên thành công');
    }
    public function editManager(string $id)
    {
        //
        $roles = Role::whereNot('role_name', 'guest')->get();
        $listManager = User::whereIn('role',$roles->pluck('id'))->get();
        $admin = User::find($id);
        return view('layouts.admin.RoleAdmin.edit',compact('listManager','roles','admin'));
    }
    public function updateManager(Request $request)
    {
        //
        $admin = User::findOrFail($request->admin_id);
        
        $validator = $request->validateWithBag('managerEdit',[
            'name'=>['required', Rule::unique(User::class,'name')->ignore($request->admin_id)->where(function ($query) use ($request) {
                return $query->where('name', $request->name);
            })],
            'email'=>['required','email', Rule::unique(User::class,'email')->ignore($request->admin_id)],
            'image_url'=>'image|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',
            'role'=> 'numeric'
        ],[
            'name.required'=>'Vui lòng không để trống',
            'name.unique'=>'Tên này đã tồn tại',
            'email.required'=>'Vui lòng không để trống',
            'email.email'=>'Vui lòng nhập đúng định dạng email',
            'email.unique'=>'Email này đã tồn tại',
            'image_url.image'=>'Vui lòng đúng định dạng file hình ảnh jpeg,jpg',
            'image_url.max'=>'Độ lớn tối đa của hình ảnh là 2048kb',
        ]);

        $file = $request->file('image_url'); // Lấy file từ request    
        if ($file) {
            // Tiếp tục xử lý hoặc trả về đường dẫn đã lưu
            $path = $file->store('avatar_user', 'public'); // Lưu file vào thư mục 'folder_name'
            $url = asset(Storage::url($path));
            $admin->image_url = $url;        
            $admin->image_path = $path;        
        }

        $admin->update($validator);
        return back()->with('success','Cập nhật quyền thành công');
    }
  
}
