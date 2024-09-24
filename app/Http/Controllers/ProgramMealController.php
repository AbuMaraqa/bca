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
        $data = MealTypeModel::whereNotIn('id',function($query) use ($request){
            $query->select('meal_type_id')->from('program_meal')->where('program_id',$request->program_id);
        })->get();
        return response()->json([
            'success'=>true,
            'view'=>view('project.program.program.program_meals.ajax.meal_type',['data'=>$data])->render()
        ]);
    }

    public function program_meal_list(Request $request){
        $data = ProgramMealModel::with('meal_type','program_meal_supplement','program_meal_supplement.supplement')->where('program_id',$request->program_id)->get()->groupBy('day');
        return response()->json([
            'success'=>true,
            'view'=>view('project.program.program.program_meals.ajax.program_meal',['data'=>$data])->render()
        ]);
    }

    public function program_meal_suplement(Request $request){
        $data = SupplementsModel::        where('product','like','%'.$request->product_name.'%')
->        whereNotIn('id', function($query) use ($request) {
            $query->select('supplement_id')
                  ->from('program_meal_supplement')
                  ->where('program_id', $request->program_id)
                  ->whereIn('program_meal_id', function($query2) use ($request) {
                      $query2->select('id')
                             ->from('program_meal')
                             ->where('day', $request->day)
                             ->where('meal_type_id', $request->meal_type_id);
                  });
        })
        ->paginate(10); // تحديد الصفحة
    
        return response()->json([
            'success' => true,
            'view' => view('project.program.program.program_meals.ajax.meal_type_supplement_list', ['data' => $data])->render(),
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
                'message'=>'تم اضافة البيانات بنجاح',
                'program_meal'=>ProgramMealModel::with('meal_type','program_meal_supplement','program_meal_supplement.supplement')->where('id',$request->program_meal_id)->first(),
                'supplement'=>SupplementsModel::where('id',$request->supplement_id)->first(),
                'data'=>$data
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

    public function delete_supplement_from_meal_type(Request $request){
        $data = ProgramMealSupplementModel::where('id',$request->program_meal_type_id)->first();
        if($data->delete()){
            return response()->json([
                'success'=>true,
                'message'=>'تم حذف الصنف بنجاح'
            ]);
        }
    }
}
