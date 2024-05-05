<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\CategoriesNews;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(string $slug)
    {
        //
        $category = CategoriesNews::where('slug',$slug)->first();
        $categories = CategoriesNews::where('show_hide',true)->whereNotIn('id',[$category->id,1])->get();
        return view('FrontEnd.category',compact('category','categories'));
    }

}
