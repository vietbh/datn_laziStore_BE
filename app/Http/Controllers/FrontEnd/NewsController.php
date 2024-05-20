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
        $news = News::where([['show_hide',true]])->paginate(6);
        $categories = CategoriesNews::where([['show_hide',true]])->whereNot([['id',1],['parent_category_id',null]])->limit(10)->get();
        return view('FrontEnd.News',compact('news','categories'));
    }


    /**
     * Display the specified resource.
     */
    public function show(string $slugNews)
    {
        //
        // dd($slugNews);
        $detailNews = News::where('slug',$slugNews)->first();
        $categories = CategoriesNews::where([['show_hide',true]])->whereNot([['id',1],['parent_category_id',null]])->get();
        return view('FrontEnd.show',compact('detailNews','categories'));
    }
    public function search(Request $request)
    {
        //
        $search = $request->input('search');
        $query = News::query();
        
        if ($search) {
            $query->whereAll([
                'title',
            ], 'LIKE', '%'.$search.'%');
            
        }
        $searchNews = $query->paginate(8)->appends('search',$search);
        $categories = CategoriesNews::where([['show_hide',true]])->whereNot([['id',1],['parent_category_id',null]])->get();
        return view('FrontEnd.search',compact('searchNews','categories'));
    }

}
