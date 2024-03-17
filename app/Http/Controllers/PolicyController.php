<?php

namespace App\Http\Controllers;

use App\Models\Policy;
use Illuminate\Http\Request;

class PolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $policies = Policy::all();
        return view('layouts.admin.Policy.index',compact('policies'));
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Policy $policy)
    {
        //
        $request->validate([
            'name'=>'required|unique:'.Policy::class,
            'value'=>'required',
            'position'=>'required|min:1|max:9999|numeric',
        ],[
            'name.required' => 'Vui lòng nhập trường này.',
            'name.unique' => 'Đã tồn tại chính sách này.',
            'value.required' => 'Vui lòng nhập trường này.',
            'position.required' => 'Vui lòng nhập trường này.',
            'position.min' => 'Vui lòng nhập lớn hơn 0.',
            'position.max' => 'Vui lòng nhập nhỏ hơn 99999.',
            'position.numeric' => 'Vui lòng nhập số.',
        ]);        
        $policy->name =$request->name;
        $policy->value =$request->value;
        $policy->position =$request->position;
        $policy->show_hide =$request->show_hide;
        $policy->save();
        return redirect()->route('policy.index')->with('success','Thêm mới chính sách thành công');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $policy = Policy::findOrFail($id);
        $policies = Policy::all();
        return view('layouts.admin.Policy.index',compact('policies','policy'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $policy = Policy::findOrFail($id);
        $request->validate([
            'name'=>'required|unique:'.Policy::class.',name,'.$id,
            'value'=>'required',
            'position'=>'required|min:1|max:9999|numeric',
        ],[
            'name.required' => 'Vui lòng nhập trường này.',
            'name.unique' => 'Đã tồn tại chính sách này.',
            'value.required' => 'Vui lòng nhập trường này.',
            'position.required' => 'Vui lòng nhập trường này.',
            'position.min' => 'Vui lòng nhập lớn hơn 0.',
            'position.max' => 'Vui lòng nhập nhỏ hơn 99999.',
            'position.numeric' => 'Vui lòng nhập số.',
        ]);        
        $policy->name =$request->name;
        $policy->value =$request->value;
        $policy->position =$request->position;
        $policy->show_hide =$request->show_hide;
        $policy->save();
        return redirect()->route('policy.index')->with('success','Cập nhật chính sách thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $policy = Policy::findOrFail($id);
        $policy->delete();
        return redirect()->route('policy.index')->with('success','Xóa thành công');
    }
}
