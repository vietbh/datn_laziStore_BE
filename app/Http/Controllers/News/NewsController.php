<?php

namespace App\Http\Controllers\News;

use App\Models\News;
use App\Models\TagsNews;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CategoriesNews;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $news = News::all();
        $tags = TagsNews::all();
        $categories = CategoriesNews::all();
        return view('layouts.admin.News.index',compact('news','tags','categories'));
    }

    public function store(Request $request, News $news)
    {
        $request->validate([
            'title' => 'required|unique:'.News::class,
            'seo_keywords' => 'required|unique:news,seo_keywords',
            'author' => 'required',
            'categories_news_id' => 'required',
            'description' => 'required'
        ],[
            'title.required'=>'Vui lòng không bỏ trống trường này.',
            'title.unique'=>'Đã tồn tại tiêu đề này.',
            'author.required'=>'Vui lòng không bỏ trống trường này.',
            'categories_news_id.required'=>'Vui lòng không bỏ trống trường này.',
            'description.required'=>'Vui lòng không bỏ trống trường này.',
        ]);
    
        $file = $request->file('image_url'); // Lấy file từ request    
        if ($file) {
            // Tiếp tục xử lý hoặc trả về đường dẫn đã lưu
            $path = $file->store('images_news', 'public'); // Lưu file vào thư mục 'folder_name'
            $url = asset(Storage::url($path));
        }
        $news->title = $request->title;
        $news->seo_keywords = Str::slug($request->seo_keywords);
        $news->slug = Str::slug($request->title);
        $news->categories_news_id = $request->categories_news_id;
        // $news->tag_id = $request->tag_id;
        $news->image_path = $path;
        $news->image_url = $url;
        $news->description = $request->description;
        $news->author = $request->author;
        $news->datetime_create = now();
        $news->show_hide = $request->show_hide;
        $news->user_id = auth()->user()->id;
        $news->save();
        return redirect()->route('news.index')->with('success', 'Thêm tin tức thành công');
    }

    public function upload(Request $request){
        if($request->hasFile('upload')){
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            $request->file('upload')->move(public_path('media'), $fileName);

            $url = asset('media/' .  $fileName);

            return response()->json(['fileName' => $fileName, 'uploaded'=> 1, 'url'=> $url]);
        }
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $new = News::findOrFail($id);
        $path = $new->image_path; // Đường dẫn tới file cần xóa trong thư mục 'public'
        if(!Storage::exists('public/'. $path)){
            return redirect()->route('news.index')->with('error','Xóa hình ảnh không thành công!');
        };
        Storage::delete('public/'. $path); // Xóa file
        $new->delete();
        return redirect()->route('news.index')->with('success','Xóa sản phẩm thành công!');
    }
}
