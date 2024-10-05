<?php

namespace App\Http\Controllers;

use App\Models\DiseasesModel;
use Illuminate\Http\Request;

class DiseasesController extends Controller
{
    public function index(){
        $data = DiseasesModel::get();
        return view('project.diseases.index',['data'=>$data]);
    }

    public function add(){
        return view('project.diseases.add');
    }

    public function create(Request $request){
        $data = new DiseasesModel();
        $data->name = $request->name;
        if ($data->save()) {
            return redirect()->route('diseases.index')->with(['success'=>'تم اضافة الدم بنجاح']);
        }
    }

    public function edit($id){    
        $data = DiseasesModel::where('id',$id)->first();
        return view('project.diseases.edit',['data'=>$data]);
    }

    public function update(Request $request){    
        $data = DiseasesModel::where('id',$request->id)->first();
        $data->name = $request->name;
        if ($data->save()) {
            return redirect()->route('diseases.index')->with(['success'=>'تم تعديل الدم بنجاح']);
        }
    }
}
