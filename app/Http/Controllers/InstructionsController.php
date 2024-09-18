<?php

namespace App\Http\Controllers;

use App\Models\InstructionsModel;
use Illuminate\Http\Request;

class InstructionsController extends Controller
{
    public function index(){
        return view('project.program.instructions.index');
    }

    public function list_instructions(Request $request){
        $data = InstructionsModel::where('instructions_name','like','%'.$request->name.'%')->get();
        return response()->json([
            'success'=>true,
            'view'=>view('project.program.instructions.ajax.instructions_list',['data'=>$data])->render()
        ]);
    }

    public function add(){
        return view('project.program.instructions.add');
    }

    public function create(Request $request){
        $data = new InstructionsModel();
        $data->instructions_name = $request->instructions_name;
        $data->instructions_note = $request->instructions_note;
        if($data->save()){
            return redirect()->route('program.instructions.index')->with(['success'=>'تم اضافة البيانات بنجاح']);
        }
    }

    public function edit($id){
        $data = InstructionsModel::where('id',$id)->first();
        return view('project.program.instructions.edit',['data'=>$data]);
    }

    public function update(Request $request){
        $data = InstructionsModel::where('id',$request->id)->first();
        $data->instructions_name = $request->instructions_name;
        $data->instructions_note = $request->instructions_note;
        if($data->save()){
            return redirect()->route('program.instructions.index')->with(['success'=>'تم اضافة البيانات بنجاح']);
        }
    }
}
