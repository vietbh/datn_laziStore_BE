<?php

namespace App\Http\Controllers\News;

use App\Models\News;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CategoriesNews;
use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Models\TagRelationNews;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $news = News::orderByDesc('created_at')->paginate(10);
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
        });
        $tagJson = json_encode($tags);
        $tagss = Tag::all();
        $categories = CategoriesNews::all();
        return view('layouts.admin.News.store',compact('news','tagJson','categories'));
    }

    public function store(Request $request, News $news)
    {
        // dd($request->tag_id);
        $request->validate([
            'title' => 'required|unique:'.News::class,
            'seo_keywords' => 'required|unique:news,seo_keywords',
            'author' => 'required',
            'image_url' => 'required|mimes:jpg, png, jpeg, jfif, gif, svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1080,max_height=1080',
            'categories_news_id' => 'required',
            'description' => 'required'
        ],[
            'title.required'=>'Vui lòng không bỏ trống trường này.',
            'title.unique'=>'Đã tồn tại tiêu đề này.',
            'image_url.required'=>'Vui lòng không bỏ trống trường này.',
            'image_url.image' => 'Chỉ cho phép file hình hoặc gif.',
            'image_url.mimes' => 'Chỉ cho phép file có đuôi là jpg, png, jpeg, jfif.',
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
        if($news->id){
            foreach ($request->tag_id as $tag_id) {
                $tag = new TagRelationNews();
                $tag->news_id = $news->id;
                $tag->tag_id = $tag_id;
                $tag->save();
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
        $tags = Tag::select('id', 'name')->where([TagRelationNews::where(['news_id',$id])->get('tag_id')])->get()->map(function ($tag) {
            return [
                'id' => $tag->id,
                'text' => $tag->name,
            ];
        });
        $tagJson = json_encode($tags);
        return view('layouts.admin.News.store',compact('new','tagJson','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $news = News::findOrFail($id);
        $request->validate([
            'title' => 'required|unique:'.News::class.',title,'.$id,
            'seo_keywords' => 'required|unique:'.News::class.',seo_keywords,'.$id,
            'author' => 'required',
            'categories_news_id' => 'required',
            'image_url' => 'required|mimes:jpg, png, jpeg, jfif, gif, svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1080,max_height=1080',
            'description' => 'required'
        ],[
            'title.required'=>'Vui lòng không bỏ trống trường này.',
            'title.unique'=>'Đã tồn tại tiêu đề này.',
            'seo_keywords.required'=>'Vui lòng không bỏ trống trường này.',
            'seo_keywords.unique'=>'Đã tồn tại từ khóa SEO này.',
            'author.required'=>'Vui lòng không bỏ trống trường này.',
            'image_url.required'=>'Vui lòng không bỏ trống trường này.',
            'image_url.image' => 'Chỉ cho phép file hình hoặc gif.',
            'image_url.mimes' => 'Chỉ cho phép file có đuôi là jpg, png, jpeg, jfif.',
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
        // $news->tag_id = $request->tag_id;
        if($news->id){
            foreach ($request->tag_id as $tag_id) {
                $tag = new TagRelationNews();
                $tag->news_id = $news->id;
                $tag->tag_id = $tag_id;
                $tag->save();
            }
        }
        $news->description = $request->description;
        $news->author = $request->author;
        $news->show_hide = $request->show_hide;
        $news->user_id = auth()->user()->id;
        $news->update();
        return redirect()->route('news.index')->with('success', 'Cập nhật tin tức thành công');
    }

    public function deleteTagRelaNews(string $id,string $news){
        $news = News::find($news);
        $tagRelaNews = TagRelationNews::findOrFail($id);
        $tagRelaNews->delete();
        return redirect()->route('news.edit',['id'=>$news->id])->with('success','Bỏ tag thành công!');
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
        return redirect()->route('news.index')->with('success','Xóa tin tức thành công!');
    }
}
