<?php

namespace App\Http\Controllers\News;

use App\Models\TagsNews;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagNewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $tags = TagsNews::all();
        return view('layouts.admin.News.Tags.index',compact('tags'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, TagsNews $tagsNews)
    {
        //
        $request->validate([
            'name' => 'required|unique:tags_news,name',
            'index' =>'required|numeric|min:1|max:999',
        ],[
            'name.required'=>'Không được để trống trường này!',
            'name.unique'=>'Đã tồn tại tag này rồi!',
            'index.required'=>'Không được để trống trường này!',
            'index.numeric'=>'Vui lòng nhập số!',
            'index.min'=>'Vui lòng nhập số lớn hơn hoặc bằng 1 !',
            'index.max'=>'Vui lòng nhập số nhỏ hơn 999 !',
        ]);
        $slug = Str::slug($request->name); 
        $tagsNews->name = $request->name;
        $tagsNews->slug = $slug;
        $tagsNews->index = $request->index;
        // $tagsNews->parent_category_id = $request->parent_id;
        $tagsNews->show_hide = $request->show_hide;
        $tagsNews->save();
        return redirect()->route('news.tag.index')->with('success','Thêm mới tag thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $tagDelete = TagsNews::findOrFail($id);
        $tags = TagsNews::all();
        return view('layouts.admin.News.Tags.index',compact('tags','tagDelete'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $tag = TagsNews::findOrFail($id);
        $tags = TagsNews::all();
        // $categories_parent = TagsNews::where([
        //     ['id','!=',1],
        //     ['id','!=',$id],
        //     ['parent_category_id',null],
        // ])->get();
        return view('layouts.admin.News.Tags.index',compact('tag','tags'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $tagsNew = TagsNews::findOrFail($id);
        $request->validate([
            'name' => 'required|unique:categories_news,name,'.$id,
            'index' => 'required|min:1|max:999',
        ],[
            'name.required'=>'Không được để trống trường này!',
            'name.unique'=>'Đã tồn tại danh mục này rồi!',
            'index.required'=>'Không được để trống trường này!',
            'index.numeric'=>'Vui lòng nhập số!',
            'index.min'=>'Vui lòng nhập số lớn hơn hoặc bằng 1 !',
            'index.max'=>'Vui lòng nhập số nhỏ hơn 999 !',

        ]);
        $slug = Str::slug($request->name); 
        $tagsNew->name = $request->name;
        $tagsNew->slug = $slug;
        $tagsNew->index = $request->index;
        // $tagsNew->parent_category_id = $request->parent_id;
        $tagsNew->show_hide = $request->show_hide;
        $tagsNew->update();
        return redirect()->route('news.tag.index')->with('success','Cập nhật Tag thành công');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $tagsNew = TagsNews::findOrFail($id);
        $tagsNew->delete();
        $alert='Danh mục '.$tagsNew->name.' đã được xóa thành công.';
        return redirect()->route('news.tag.index')->with('success',$alert);

    }
}
