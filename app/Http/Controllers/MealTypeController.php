<?php

namespace App\Http\Controllers;

use App\Models\MealTypeModel;
use Illuminate\Http\Request;

class MealTypeController extends Controller
{
    public function index(){
        return view('project.program.meal_type.index');
    }

    public function list_meal_type(Request $request){
        $data = MealTypeModel::where('meal_name','like','%'.$request->name.'%')->get();
        return response()->json([
            'success'=>true,
            'view'=>view('project.program.meal_type.ajax.meal_type_list',['data'=>$data])->render()
        ]);
    }

    public function add(){
        return view('project.program.meal_type.add');
    }

    public function create(Request $request){
        $data = new MealTypeModel();
        $data->meal_name = $request->meal_name;
        if($data->save()){
            return redirect()->route('program.meal_type.index')->with(['success'=>'تم اضافة البيانات بنجاح']);
        }
    }

    public function edit($id){
        $data = MealTypeModel::where('id',$id)->first();
        return view('project.program.meal_type.edit',['data'=>$data]);
    }

    public function update(Request $request){
        $data = MealTypeModel::where('id',$request->id)->first();
        $data->meal_name = $request->meal_name;
        if($data->save()){
            return redirect()->route('program.meal_type.index')->with(['success'=>'تم اضافة البيانات بنجاح']);
        }
    }
}
