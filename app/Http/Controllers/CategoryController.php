<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $data = CategoryModel::get();
        return view('project.category.index',['data'=>$data]);
    }

    public function create(Request $request)
    {
        $data = new CategoryModel();
        $data->name = $request->name;
        if ($data->save()) {
            return redirect()->route('category.index')->with(['success' => 'تم اضافة التصنيف بنجاح']);
        }
    }

    public function edit($id){
        $data = CategoryModel::where('id',$id)->first();
        return view('project.category.edit',['data'=>$data]);
    }

    public function update(Request $request){
        $data = CategoryModel::where('id',$request->id)->first();
        $data->name = $request->name;
        if ($data->save()) {
            return redirect()->route('category.index')->with(['success' => 'تم تعديل التصنيف بنجاح']);
        }
    }
}
