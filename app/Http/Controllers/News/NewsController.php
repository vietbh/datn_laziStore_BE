<?php

namespace App\Http\Controllers\News;

use App\Models\News;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CategoriesNews;
use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Models\TagRelationNews;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $news = News::orderByDesc('id')->get();
        $tags = Tag::all();
        $categories = CategoriesNews::all();
        return view('layouts.admin.News.index',compact('news','tags','categories'));
    }

    public function create(){
        $news = News::all();
        $tags = Tag::select('id', 'name')->get()->map(function ($tag) {
            return [
                'id' => $tag->id,
                'text' => $tag->name,
            ];
        })->toJson();
        $categories = CategoriesNews::all();
        return view('layouts.admin.News.edit',compact('news','tags','categories'));
    }

    public function store(Request $request, News $news)
    {
        $request->validate([
            'title' => 'required|unique:'.News::class,
            'seo_keywords' => 'required|unique:news,seo_keywords',
            'author' => 'required',
            'image_url' => 'required|image|max:2048|dimensions:min_width=100,min_height=100,max_width=1080,max_height=1080',
            'categories_news_id' => 'required',
            'description' => 'required'
        ],[
            'title.required'=>'Vui lòng không bỏ trống trường này.',
            'title.unique'=>'Đã tồn tại tiêu đề này.',
            'image_url.required'=>'Vui lòng không bỏ trống trường này.',
            'image_url.image' => 'Chỉ cho phép file hình hoặc gif.',
            'image_url.max' => 'Chỉ cho phép kích thước tối đa 2048Kb.',
            'author.required'=>'Vui lòng không bỏ trống trường này.',
            'categories_news_id.required'=>'Vui lòng không bỏ trống trường này.',
            'description.required'=>'Vui lòng không bỏ trống trường này.',
        ]);
        $file = $request->file('image_url'); // Lấy file từ request    
        if ($file) {
            // Tiếp tục xử lý hoặc trả về đường dẫn đã lưu
            $path = $file->store('images_news', 'public'); // Lưu file vào thư mục 'folder_name'
            $url = asset(Storage::url($path));
            $news->image_path = $path;
            $news->image_url = $url;
        }
        $news->title = $request->title;
        $news->seo_keywords = Str::slug($request->seo_keywords);
        $news->slug = Str::slug($request->title);
        $news->categories_news_id = $request->categories_news_id;
        
        $news->description = $request->description;
        $news->author = $request->author;
        $news->date_create = now();
        $news->time_create = time();
        $news->show_hide = $request->show_hide;
        $news->user_id = auth()->user()->id;
        $news->save();
        if ($request->has('tag_id')) {
            $tagIds = $request->tag_id;
            foreach ($tagIds as $tagId) {
                if (!$news->tags()->where('tag_id', $tagId)->exists()) {
                    $news->tags()->create(['tag_id' => $tagId]);
                }
            }
        }
        return redirect()->route('news.index')->with('success', 'Thêm tin tức thành công');
    }

    public function uploadCk(Request $request){
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
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $new = News::findOrFail($id);
        $categories = CategoriesNews::all();
      
        $tags = Tag::select('id', 'name')->whereNotIn('id',$new->tags()->get(['tag_id']))->get()->map(function ($tag) {
            return [
                'id' => $tag->id,
                'text' => $tag->name,
            ];
        })->toJson();
        return view('layouts.admin.News.edit',compact('new','tags','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        // dd($request->categories_news_id);
        $news = News::findOrFail($id);
        $request->validate([
            'title' => 'required|unique:'.News::class.',title,'.$id,
            'seo_keywords' => 'required|unique:'.News::class.',seo_keywords,'.$id,
            'author' => 'required',
            'categories_news_id' => 'required',
            'image_url' => 'image|max:2048|dimensions:min_width=100,min_height=100,max_width=1080,max_height=1080',
            'description' => 'required'
        ],[
            'title.required'=>'Vui lòng không bỏ trống trường này.',
            'title.unique'=>'Đã tồn tại tiêu đề này.',
            'seo_keywords.required'=>'Vui lòng không bỏ trống trường này.',
            'seo_keywords.unique'=>'Đã tồn tại từ khóa SEO này.',
            'author.required'=>'Vui lòng không bỏ trống trường này.',
            'image_url.required'=>'Vui lòng không bỏ trống trường này.',
            'image_url.image' => 'Chỉ cho phép file hình hoặc gif.',
            'image_url.max' => 'Chỉ cho phép kích thước tối đa 2048Kb.',
            'categories_news_id.required'=>'Vui lòng không bỏ trống trường này.',
            'description.required'=>'Vui lòng không bỏ trống trường này.',
        ]);
        
        $file = $request->file('image_url'); // Lấy file từ request    
        if ($file) {
            // Tiếp tục xử lý hoặc trả về đường dẫn đã lưu
            $path = $file->store('images_news', 'public'); // Lưu file vào thư mục 'folder_name'
            $url = asset(Storage::url($path));
            $news->image_path = $path;
            $news->image_url = $url;
        }
        $news->title = $request->title;
        $news->seo_keywords = Str::slug($request->seo_keywords);
        $news->slug = Str::slug($request->title);
        $news->categories_news_id = $request->categories_news_id;
        if ($request->has('tag_id')) {
            $tagIds = $request->tag_id;
            foreach ($tagIds as $tagId) {
                if (!$news->tags()->where('tag_id', $tagId)->exists()) {
                    $news->tags()->create(['tag_id' => $tagId]);
                }
            }
        }
        $news->description = $request->description;
        $news->author = $request->author;
        $news->show_hide = $request->show_hide;
        $news->user_id = auth()->user()->id;
        $news->update();
        return redirect()->back()->with('success', 'Cập nhật tin tức thành công');
    }

    public function deleteTagRelaNews(Request $request):JsonResponse
    {
        $tagRelaNews = TagRelationNews::where([['news_id',$request->news_id],['tag_id',$request->tag_id]])->delete();
        return response()->json(['success'=>'Bỏ tag thành công!'],200);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
        $new = News::findOrFail($request->news_id);
        if($new->tags()->count() > 0){
            $new->tags()->delete();
        }

        $path = $new->image_path; // Đường dẫn tới file cần xóa trong thư mục 'public'
        if(Storage::exists('public/'. $path)){
            Storage::delete('public/'. $path); // Xóa file
        };
        $new->delete();
        return redirect()->route('news.index')->with('success','Xóa tin tức thành công!');
    }

    public function filter(Request $request)
    {
        // Lấy các tham số lọc từ yêu cầu
        $search = $request->input('search');
        $name = $request->input('name');
        $category = $request->input('category');
        // Xây dựng truy vấn lọc sản phẩm
        $query = News::query();

        if ($search) {
            $query->whereAll([
                'title',
            ], 'LIKE', '%'.$search.'%');
        }
        if ($name) {
            $query->orderBy('title', $name);
        }

        if ($category) {
            $query->whereHas('category', function ($query) use ($category) {
                $query->where('name', $category);
            });
        }


        // Thực hiện truy vấn và lấy danh sách sản phẩm đã lọc với phân trang
        $news = $query->get();

        // Truyền danh sách sản phẩm đã lọc và các thông tin phân trang cho giao diện người dùng
        $categories = CategoriesNews::all();

        $newsCount = News::all()->count();
        $data = compact('news','categories','newsCount');
        return view('layouts.admin.News.index',$data);
    }

}
