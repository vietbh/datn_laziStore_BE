<?php

namespace App\Http\Controllers;

use App\Models\SlideAds;
use Carbon\Carbon;
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
        if($request->slide_now === 'on') {
            $arrayRequired = array(
                'title' => 'required',
                'image_url' => 'image|max:2048|dimensions:min_width=100,min_height=100,max_width=1280,max_height=1280',
                'content' => 'nullable',
                'link' => 'nullable',
                'position'=>'nullable|min:1|max:99999|numeric',
                'start_date' =>'required|date|after_or_equal:today',
                'end_date' =>'required|date|after_or_equal:start_date',
            );
        }
        else {
            $arrayRequired = array(
               'title' => 'required',
               'image_url' => 'image|max:2048|dimensions:min_width=100,min_height=100,max_width=1280,max_height=1280',
               'content' => 'nullable',
               'link' => 'nullable',
               'position'=>'nullable|min:1|max:99999|numeric',
           );
        }
        $request->validate($arrayRequired,[
            'title.required'=>'Vui lòng không bỏ trống trường này.',
            'content.required'=>'Vui lòng không bỏ trống trường này.',
            'position.required'=>'Vui lòng không bỏ trống trường này.',
            'position.min' => 'Nhập số lớn hơn hoặc bằng 1.',
            'position.max' => 'Nhập số nhỏ hơn 99999.',
            'position.numeric' => 'Vui lòng nhập số.',
            'image_url.image' => 'Chỉ cho phép file hình hoặc gif.',
            'image_url.max' => 'Chỉ cho phép kích thước tối đa 2048Kb.',
            'start_date.required' => 'Vui lòng không bỏ trống trường này.',
            'start_date.date' => 'Phải là dạng năm-tháng-ngày.',
            'start_date.after_or_equal' => 'Ngày bắt đầu phải lớn hơn ngày hiện tại.',
            'end_date.required' => 'Vui lòng không bỏ trống trường này.',
            'end_date.date' => 'Phải là dạng năm-tháng-ngày.',
            'end_date.after_or_equal' => 'Ngày kết thúc phải lớn hơn ngày bắt đầu.',
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
        $slideAds->slide_area = $request->slide_area;
        $slideAds->slide_now = $request->slide_now == 'on' ? true : false;
        if($request->slide_now !== 'on'){
            $slideAds->slide_status = false;
        }else{
            $slideAds->start_date = Carbon::parse($request->start_date)->toDateTimeString();
            $slideAds->end_date = Carbon::parse($request->end_date)->toDateTimeString();
        }
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
        $slideAds = SlideAds::findOrFail($id);
        if($request->slide_now === 'on') {
            $arrayRequired = array(
                'title' => 'required',
                'image_url' => 'image|max:2048|dimensions:min_width=100,min_height=100,max_width=1280,max_height=1280',
                'content' => 'nullable',
                'link' => 'nullable',
                'position'=>'nullable|min:1|max:99999|numeric',
                'start_date' =>'required|date|after_or_equal:today',
                'end_date' =>'required|date|after_or_equal:start_date',
            );
        }
        else {
            $arrayRequired = array(
               'title' => 'required',
               'image_url' => 'image|max:2048|dimensions:min_width=100,min_height=100,max_width=1280,max_height=1280',
               'content' => 'nullable',
               'link' => 'nullable',
               'position'=>'nullable|min:1|max:99999|numeric',
           );
        }
        $request->validate($arrayRequired,[
            'title.required'=>'Vui lòng không bỏ trống trường này.',
            'content.required'=>'Vui lòng không bỏ trống trường này.',
            'position.required'=>'Vui lòng không bỏ trống trường này.',
            'position.min' => 'Nhập số lớn hơn hoặc bằng 1.',
            'position.max' => 'Nhập số nhỏ hơn 99999.',
            'position.numeric' => 'Vui lòng nhập số.',
            'image_url.image' => 'Chỉ cho phép file hình hoặc gif.',
            'image_url.max' => 'Chỉ cho phép kích thước tối đa 2048Kb.',
            'start_date.required' => 'Vui lòng không bỏ trống trường này.',
            'start_date.date' => 'Phải là dạng năm-tháng-ngày.',
            'start_date.after_or_equal' => 'Ngày bắt đầu phải lớn hơn ngày hiện tại.',
            'end_date.required' => 'Vui lòng không bỏ trống trường này.',
            'end_date.date' => 'Phải là dạng năm-tháng-ngày.',
            'end_date.after_or_equal' => 'Ngày kết thúc phải lớn hơn ngày bắt đầu.',
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
        $slideAds->slide_area = $request->slide_area;
        $slideAds->slide_now = ($request->slide_now == 'on' ? true : false);
        if(empty($request->slide_now)){
            $slideAds->slide_status = false;
        }else{
            $slideAds->start_date = Carbon::parse($request->start_date)->toDateTimeString();
            $slideAds->end_date = Carbon::parse($request->end_date)->toDateTimeString();
        }
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
