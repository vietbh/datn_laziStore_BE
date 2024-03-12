<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CategoriesProduct;
use Illuminate\Http\Request;

class CategoryProController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categories = CategoriesProduct::where([['id','!=',1],['show_hide',true],['parent_category_id','!=',null]])->get();
        return response()->json($categories, 200);
    }

    public function show(string $slug)
{
    // Tìm kiếm danh mục theo slug và eager loading danh mục cha và con
    $category = CategoriesProduct::where([['id','!=',1],['show_hide',true],['slug', $slug]])->first();

    if (!$category) {
        return response()->json(['error' => 'Danh mục không tồn tại'], 404);
    }

    // Lấy danh sách danh mục cha và con
    // $categories = $this->getCategoryHierarchy($category);

    return response()->json($category, 200);
}

private function getCategoryHierarchy($category)
{
    // Tạo mảng để lưu danh sách các danh mục
    $categories = [];

    // Thêm danh mục hiện tại vào mảng
    $categories[] = $category;

    // Kiểm tra nếu danh mục có danh mục cha
    if ($category->parent) {
        // Gọi đệ quy để lấy danh sách danh mục cha
        $parentCategories = $this->getCategoryHierarchy($category->parent);

        // Thêm danh sách danh mục cha vào mảng
        $categories = array_merge($categories, $parentCategories);
    }

    // Kiểm tra nếu danh mục có danh mục con
    if ($category->children) {
        foreach ($category->children as $child) {
            // Gọi đệ quy để lấy danh sách danh mục con
            $childCategories = $this->getCategoryHierarchy($child);

            // Thêm danh sách danh mục con vào mảng
            $categories = array_merge($categories, $childCategories);
        }
    }

    return $categories;
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
