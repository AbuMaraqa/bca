<?php

namespace App\Http\Controllers;

use App\Models\ProgramCategoryModel;
use Illuminate\Http\Request;

class ProgramCategoryController extends Controller
{
    public function index(){
        return view('project.program.program_category.index');
    }

    public function list_program_category(Request $request){
        $data = ProgramCategoryModel::where('program_category_name','like','%'.$request->name.'%')->get();
        return response()->json([
            'success'=>true,
            'view'=>view('project.program.program_category.ajax.program_category_list',['data'=>$data])->render()
        ]);
    }

    public function add(){
        return view('project.program.program_category.add');
    }

    public function create(Request $request){
        $data = new ProgramCategoryModel();
        $data->program_category_name = $request->program_category_name;
        if($data->save()){
            return redirect()->route('program.program_category.index')->with(['success'=>'تم اضافة البيانات بنجاح']);
        }
    }

    public function edit($id){
        $data = ProgramCategoryModel::where('id',$id)->first();
        return view('project.program.program_category.edit',['data'=>$data]);
    }

    public function update(Request $request){
        $data = ProgramCategoryModel::where('id',$request->id)->first();
        $data->program_category_name = $request->program_category_name;
        if($data->save()){
            return redirect()->route('program.program_category.index')->with(['success'=>'تم اضافة البيانات بنجاح']);
        }
    }
}
