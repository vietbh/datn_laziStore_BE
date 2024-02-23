<?php

namespace App\Http\Controllers\News;

use App\Models\News;
use App\Models\TagsNews;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CategoriesNews;
use App\Http\Controllers\Controller;
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
    public function store(Request $request, News $news)
    {
        $request->validate([
            'title' => 'required|unique:news,title',
            'seo_keywords' => 'required|unique:products,seo_keywords',
            'categories_news_id' => 'required',
            
        ],[
            'title.required'=>'Vui lòng không bỏ trống trường này.',
            'title.unique'=>'Đã tồn tại tiêu đề này.',
            'name.required'=>'Vui lòng không bỏ trống trường này.',
        ]);
    
        $file = $request->file('image_url'); // Lấy file từ request    
        if ($file) {
            // Tiếp tục xử lý hoặc trả về đường dẫn đã lưu
            $path = $file->store('images_news', 'public'); // Lưu file vào thư mục 'folder_name'
            $url = asset(Storage::url($path));
        }
        $news->name = $request->name;
        $news->seo_keywords = Str::slug($request->seo_keywords);
        $news->slug = Str::slug($request->name);
        $news->categories_product_id = $request->categories_product_id;
        $news->brand_id = $request->brand_id;
        $news->image_path = $path;
        $news->image_url = $url;
        $news->description = $request->description;
        $news->show_hide = $request->show_hide;
        $news->save();
        return redirect()->route('product.index')->with('success', 'Thêm sản phẩm thành công');
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
    }
}
