<?php

namespace App\Http\Controllers;

use App\Models\SlideAds;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SlideAdsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $slides = SlideAds::orderBy('position')->get();
        return view('layouts.admin.SlideAds.index',compact('slides'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, SlideAds $slideAds)
    {
        //mimes:jpg, png, jpeg, jfif|
        $request->validate([
            'title' => 'required',
            'image_url' => 'required|image|max:2048|dimensions:min_width=100,min_height=100,max_width=1280,max_height=1280',
            'content' => 'required',
            'link' => 'url|nullable',
            'position'=>'required|min:1|max:99999|numeric',
        ],[
            
            'title.required'=>'Vui lòng không bỏ trống trường này.',
            'content.required'=>'Vui lòng không bỏ trống trường này.',
            'link.url'=>'Vui lòng nhập dạng link vd(https://....).',
            'position.required'=>'Vui lòng không bỏ trống trường này.',
            'position.min' => 'Nhập số lớn hơn hoặc bằng 1.',
            'position.max' => 'Nhập số nhỏ hơn 99999.',
            'position.numeric' => 'Vui lòng nhập số.',
            'image_url.required'=>'Vui lòng không bỏ trống trường này.',
            'image_url.image' => 'Chỉ cho phép file hình hoặc gif.',
            'image_url.max' => 'Chỉ cho phép kích thước tối đa 2048Kb.',
        ]);
        $file = $request->file('image_url'); // Lấy file từ request    
        if ($file) {
            // Tiếp tục xử lý hoặc trả về đường dẫn đã lưu
            $path = $file->store('images_slide', 'public'); // Lưu file vào thư mục 'folder_name'
            $url = asset(Storage::url($path));
            $slideAds->image_path = $path;
            $slideAds->image_url = $url;
        }
        $slideAds->title = $request->title;
        $slideAds->content = $request->content ?? '';
        $slideAds->link = $request->link ?? '';
        $slideAds->position = $request->position;
        $slideAds->show_hide = $request->show_hide;
        $slideAds->save();
        return redirect()->route('slide.index')->with('success','Thêm mới slide thành công');

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $slide = SlideAds::findOrFail($id);
        $slides = SlideAds::orderBy('position')->orderByDesc('created_at')->paginate(10);
        return view('layouts.admin.SlideAds.index',compact('slides','slide'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //mimes:jpg, png, jpeg, jfif|
        $slideAds = SlideAds::findOrFail($id); 
        $request->validate([
            'title' => 'required',
            'image_url' => 'image|max:2048|dimensions:min_width=100,min_height=100,max_width=1280,max_height=1280',
            'content' => 'nullable',
            'link' => 'url|nullable',
            'position'=>'nullable|min:1|max:99999|numeric',
        ],[
            'title.required'=>'Vui lòng không bỏ trống trường này.',
            'content.required'=>'Vui lòng không bỏ trống trường này.',
            'link.url'=>'Vui lòng nhập dạng link vd(https://....).',
            'position.required'=>'Vui lòng không bỏ trống trường này.',
            'position.min' => 'Nhập số lớn hơn hoặc bằng 1.',
            'position.max' => 'Nhập số nhỏ hơn 99999.',
            'position.numeric' => 'Vui lòng nhập số.',
            'image_url.image' => 'Chỉ cho phép file hình hoặc gif.',
            // 'image_url.mimes' => 'Chỉ cho phép file có đuôi là jpg, png, jpeg, jfif.',
            'image_url.max' => 'Chỉ cho phép kích thước tối đa 2048Kb.',
        ]);
        $file = $request->file('image_url'); // Lấy file từ request    
        if ($file) {
            // Tiếp tục xử lý hoặc trả về đường dẫn đã lưu
            $path = $file->store('images_slide', 'public'); // Lưu file vào thư mục 'folder_name'
            $url = asset(Storage::url($path));
            $slideAds->image_path = $path;
            $slideAds->image_url = $url;
        }
        $slideAds->title = $request->title;
        $slideAds->content = $request->content ?? '';
        $slideAds->link = $request->link ?? '';
        $slideAds->position = $request->position;
        $slideAds->show_hide = $request->show_hide;
        $slideAds->update();
        return redirect()->route('slide.index')->with('success','Cập nhật slide thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
        $slideAds = SlideAds::findOrFail($request->slider_id);
        $path = $slideAds->image_path; // Đường dẫn tới file cần xóa trong thư mục 'public'
        if(!Storage::exists('public/'. $path)){
            return redirect()->route('slide.index')->with('error','Xóa hình ảnh không thành công!');
        };
        $slideAds->delete();
        return redirect()->route('slide.index',['id' => $slideAds->id])->with('success','Xóa thành công!');
    }
}
