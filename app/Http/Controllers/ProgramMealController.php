<?php

namespace App\Http\Controllers;

use App\Models\MealTypeModel;
use App\Models\ProgramDaysModel;
use App\Models\ProgramMealModel;
use App\Models\ProgramMealSupplementModel;
use App\Models\ProgramModel;
use App\Models\SupplementsModel;
use Illuminate\Http\Request;

class ProgramMealController extends Controller
{
    public function index($program_id){
        $data = ProgramModel::find($program_id);
        return view('project.program.program.program_meals.index' , ['data'=>$data]);
    }

    public function meal_type_list(Request $request){
        $data = MealTypeModel::get();
        return response()->json([
            'success'=>true,
            'view'=>view('project.program.program.program_meals.ajax.meal_type',['data'=>$data])->render()
        ]);
    }

    public function program_meal_list(Request $request){
        $data = ProgramMealModel::with('meal_type')->where('program_id',$request->program_id)->get()->groupBy('day');
        return response()->json([
            'success'=>true,
            'view'=>view('project.program.program.program_meals.ajax.program_meal',['data'=>$data])->render()
        ]);
    }

    public function program_meal_suplement(Request $request){
        $data = SupplementsModel::whereNotIn('id',function($query) use ($request){
            $query->select('supplement_id')->from('program_meal_supplement')->where('program_id',$request->program_id);
        })->get();
        return response()->json([
            'success'=>true,
            'view'=>view('project.program.program.program_meals.ajax.meal_type_supplement_list',['data'=>$data])->render(),
        ]);
    }

    public function add_supplement_for_meal_type(Request $request){
        $data = new ProgramMealSupplementModel();
        $data->program_meal_id = $request->program_meal_id;
        $data->program_id = $request->program_id;
        $data->supplement_id = $request->supplement_id;
        $data->notes = SupplementsModel::where('id',$request->supplement_id)->first()->notes ?? '';
        if($data->save()){
            return response()->json([
                'success'=>true,
                'message'=>'تم اضافة البيانات بنجاح'
            ]);
        }
    }

    public function add_meal_type_for_program(Request $request){
        for($i = 1; $i < 8 ; $i++){
            $data = new ProgramMealModel();
            $data->program_id = $request->program_id;
            $data->day = $i;
            $data->meal_type_id = $request->meal_type_id;
            $data->save();
        }
        return response()->json([
            'success'=>true,
            'message'=>'تم اضافة نوع الوجبة بنجاح'
        ]);
    }
}
