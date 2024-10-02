<?php

namespace App\Http\Controllers;

use App\Models\InstructionsModel;
use App\Models\ProgramCategoryModel;
use App\Models\ProgramModel;
use Illuminate\Http\Request;

class ProgramController extends Controller
{

    public function index(){
        return view('project.program.program.index');
    }

    public function list_programs_ajax(Request $request){
        $data = ProgramModel::with('program_category')->where('program_name','like','%'.$request->name.'%')->get();
        return response()->json([
            'success'=>true,
            'view'=>view('project.program.program.ajax.program_list',['data'=>$data])->render()
        ]);
    }

    public function add(){
        $program_category = ProgramCategoryModel::get();
        $instructions = InstructionsModel::get();
        return view('project.program.program.add' , ['program_category'=>$program_category , 'instructions'=>$instructions]);
    }

    public function create(Request $request){
        $data = new ProgramModel();
        $data->program_name = $request->program_name;
        $data->program_category_id = $request->program_category_id;
        $data->Instructions = $request->Instructions;
        if($data->save()){
            return redirect()->route('program.program.index')->with([
                'success'=>'تم اضافة البيانات بنجاح'
            ]);
        }
    }

    public function edit($id){
        $data = ProgramModel::where('id',$id)->first();
        $program_category = ProgramCategoryModel::get();
        $instructions = InstructionsModel::get();
        return view('project.program.program.edit' , ['data'=>$data , 'program_category'=>$program_category , 'instructions'=>$instructions]);
    }
    
    public function update(Request $request){
        $data = ProgramModel::where('id',$request->id)->first();
        $data->program_name = $request->program_name;
        $data->program_category_id = $request->program_category_id;
        $data->Instructions = $request->Instructions;
        if($data->save()){
            return redirect()->route('program.program.index')->with([
                'success'=>'تم تعديل البيانات بنجاح'
            ]);
        }
    }
}
