<?php

namespace App\Http\Controllers;

use App\Models\CategoriesProduct;
use App\Models\Product;
use App\Models\Specification;
use Illuminate\Http\Request;

class SpecificationController extends Controller
{


    /**
     * Store a newly created resource in storage.
     */
    public function index(Request $request){
        $categories = CategoriesProduct::where('parent_category_id',null)->get();
        $specis = Specification::all();
        // $paginate = Specification::paginate(10);
        return view('layouts.admin.Product.Specification.index',compact('specis','categories'));
    }
    
    public function create(Request $request){
        $param = $request->query('danh_muc',null);
        
        if($param) $category = CategoriesProduct::where('slug',$param)->first();
        
        $categories = CategoriesProduct::where('parent_category_id',null)->get();
        
        if($param) $specis = Specification::where('categories_product_id',$category->id??$categories->first()->id)->get();
        else $specis = Specification::where('categories_product_id',$category->id??$categories->first()->id)->paginate(6);
        
        $paginate = Specification::where('categories_product_id',$category->id??$categories->first()->id)->paginate(6);
        
        if($param) $data = compact('specis','categories');
        else $data = compact('specis','categories','paginate');
        
        return view('layouts.admin.Product.Specification.edit',$data);
    }
    

    public function store(Request $request, Specification $specification)
    {
        //
        // dd($request);
        $request->validate([
            'name' => 'required',
        ],[
            'name.required' => 'Không được bỏ trống trường này.',
        ]);
        $specification->name = $request->name;
        $specification->categories_product_id = $request->categories_product_id;
        $specification->save();
        return redirect()->back()->with('success','Thêm thông số thành công');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
        //
        $speci = Specification::findOrFail($id);
        $param = $request->query('danh_muc',null);
        
        if($param) $category = CategoriesProduct::where('slug',$param)->first();
        
        $categories = CategoriesProduct::where('parent_category_id',null)->get();
        
        if($param) $specis = Specification::where('categories_product_id',$category->id??$categories->first()->id)->get();
        else $specis = Specification::where('categories_product_id',$category->id??$categories->first()->id)->paginate(6);
        
        $paginate = Specification::where('categories_product_id',$category->id??$categories->first()->id)->paginate(6);
        
        if($param) $data = compact('speci','specis','categories');
        else $data = compact('speci','specis','categories','paginate');
        return view('layouts.admin.Product.Specification.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
        ],[
            'name.required' => 'Không được bỏ trống trường này.',
        ]);
        $specification = Specification::findOrFail($request->speci_id);
        $specification->name = $request->name;
        $specification->categories_product_id = $request->categories_product_id;
        $specification->update();
        return redirect()->back()->with('success', 'Cập nhật thông số thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
        $specification = Specification::findOrFail($request->speci_id);
        if($request->has('speci_ids')){
            $specification = Specification::findMany($request->speci_ids);

        }

        $specification->specisProduct()->delete();
        $specification->delete();
        return redirect()->back()->with('success','Xóa thông số '.$specification->name.' thành công');
    }

    public function filter(Request $request)
    {
        // Lấy các tham số lọc từ yêu cầu
        $search = $request->input('search');
        $name = $request->input('name');
        $category = $request->input('category');
        // Xây dựng truy vấn lọc sản phẩm
        $query = Specification::query();

        if ($search) {
            $query->whereAll([
                'name',
            ], 'LIKE', '%'.$search.'%');
        }
        if ($name) {
            $query->orderBy('name', $name);
        }

        if ($category) {
            $query->whereHas('category', function ($query) use ($category) {
                $query->where('name', $category);
            });
        }

        // Thực hiện truy vấn và lấy danh sách sản phẩm đã lọc với phân trang
        $specis = $query->get();

        // Truyền danh sách sản phẩm đã lọc và các thông tin phân trang cho giao diện người dùng
        $categories = CategoriesProduct::where('parent_category_id',null)->get();
        $data = compact('specis','categories');
        return view('layouts.admin.Product.Specification.index',$data);
    }
}
