<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\CategoriesNews;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $news = News::where([['show_hide',true]])->paginate(9);
        $categories = CategoriesNews::where([['show_hide',true]])->get();
        // dd($news,$categories);
        return view('FrontEnd.News',compact('news'));
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

}
