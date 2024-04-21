<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\DetailUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
        $user = User::findOrFail($request->user_id);
        $validator = $request->validateWithBag('profileGuest',[
            'name'=>['required', Rule::unique(User::class,'name')->ignore($request->user_id)->where(function ($query) use ($request) {
                return $query->where('name', $request->name);
            })],
            'email'=>['required','email', Rule::unique(User::class,'email')->ignore($request->user_id)],
            'image_url'=>'image|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',
            'full_name'=>'required|string',
            'phone_number'=>['required','size:10'],
            'address'=>'required|string'         
        ],[
            'name.required'=>'Vui lòng không để trống',
            'name.unique'=>'Tên này đã tồn tại',
            'email.required'=>'Vui lòng không để trống',
            'email.email'=>'Vui lòng nhập đúng định dạng email',
            'email.unique'=>'Email này đã tồn tại',
            'image_url.image'=>'Vui lòng đúng định dạng file hình ảnh jpeg,jpg',
            'image_url.max'=>'Độ lớn tối đa của hình ảnh là 2048kb',
            'full_name.required'=>'Vui lòng không để trống',
            'full_name.string'=>'Vui lòng nhập đầy đủ họ và tên',
            'phone_number.required'=>'Vui lòng không để trống',
            'phone_number.size'=>'Vui lòng nhập 10 số ',
            'address.required'=>'Vui lòng không để trống',
            'address.string'=>'Vui lòng nhập đúng địa chỉ',
        ]);
       
        $file = $request->file('image_url'); // Lấy file từ request    
        if ($file) {
            // Tiếp tục xử lý hoặc trả về đường dẫn đã lưu
            $path = $file->store('avatar_user', 'public'); // Lưu file vào thư mục 'folder_name'
            $url = asset(Storage::url($path));
            $user->image_url = $url;        
            $user->image_path = $path;        
        }

        $user->update($validator);
        $validator['user_id'] = $user->id;
        $detailUser = $user->detailUser()->find($request->detailUser_id);
        $detailUser->fill($validator);
        $detailUser->save();
        return back()->with('success','Cập nhật thông tin thành công');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
