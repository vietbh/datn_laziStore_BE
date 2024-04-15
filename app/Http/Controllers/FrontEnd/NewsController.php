<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\CategoriesNews;
use App\Models\News;
use Illuminate\Http\Request;
use DB;
class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $news = News::where([['show_hide',true]]);
        $news = News::all();
        $categories = CategoriesNews::where([['show_hide',true]])->get();

        $categories_news = DB::table('categories_news')->select('name')->whereNull('parent_category_id')->get();
        // dd($news,$categories);
        return view('FrontEnd.News',compact('categories_news','news'));
    }


    /**
     * Display the specified resource.
     */
    public function show($slug){
        $new = News::where("slug",$slug)->first();
        return view('FrontEnd.show', compact('new'));
    }



}
