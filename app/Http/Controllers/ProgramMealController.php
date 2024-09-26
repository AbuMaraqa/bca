<?php

namespace App\Http\Controllers;

use App\Models\MealTypeModel;
use App\Models\ProgramDaysModel;
use App\Models\ProgramMealModel;
use App\Models\ProgramMealSupplementModel;
use App\Models\ProgramModel;
use App\Models\SupplementsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            $program_meal = ProgramMealModel::with('meal_type','program_meal_supplement','program_meal_supplement.supplement')->where('id',$request->program_meal_id)->first();
            return response()->json([
                'success'=>true,
                'message'=>'تم اضافة البيانات بنجاح',
                'program_meal'=>$program_meal,
                'supplement'=>SupplementsModel::where('id',$request->supplement_id)->first(),
                'data'=>$data,
                    // حساب السعرات الحرارية
    'calories' =>DB::table('program_meal_supplement')
    ->join('supplements', 'program_meal_supplement.supplement_id', '=', 'supplements.id')
    ->join('program_meal', 'program_meal_supplement.program_meal_id', '=', 'program_meal.id')
    ->where('program_meal.program_id', $request->program_id)
    ->where('program_meal.day', $program_meal->day)
    ->sum(DB::raw('supplements.calories * program_meal_supplement.qty')),

// حساب الكربوهيدرات
'carbohydrates' => DB::table('program_meal_supplement')
->join('supplements', 'program_meal_supplement.supplement_id', '=', 'supplements.id')
->join('program_meal', 'program_meal_supplement.program_meal_id', '=', 'program_meal.id')
->where('program_meal.program_id', $request->program_id)
->where('program_meal.day', $program_meal->day)
->sum('supplements.carbohydrates'),

// حساب الدهون
'fats' => DB::table('program_meal_supplement')
->join('supplements', 'program_meal_supplement.supplement_id', '=', 'supplements.id')
->join('program_meal', 'program_meal_supplement.program_meal_id', '=', 'program_meal.id')
->where('program_meal.program_id', $request->program_id)
->where('program_meal.day', $program_meal->day)
->sum('supplements.fats'),

// حساب البروتين
'protein' => DB::table('program_meal_supplement')
->join('supplements', 'program_meal_supplement.supplement_id', '=', 'supplements.id')
->join('program_meal', 'program_meal_supplement.program_meal_id', '=', 'program_meal.id')
->where('program_meal.program_id', $request->program_id)
->where('program_meal.day', $program_meal->day)
->sum('supplements.protein'),

// حساب الألياف
'fibers' => DB::table('program_meal_supplement')
->join('supplements', 'program_meal_supplement.supplement_id', '=', 'supplements.id')
->join('program_meal', 'program_meal_supplement.program_meal_id', '=', 'program_meal.id')
->where('program_meal.program_id', $request->program_id)
->where('program_meal.day', $program_meal->day)
->sum('supplements.fibers'),

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
        $program_meal = ProgramMealModel::where('id',$data->program_meal_id)->first();
        if($data->delete()){
            return response()->json([
                'success'=>true,
                'message'=>'تم حذف الصنف بنجاح',
                'program_meal'=>$program_meal,
                'calories' => DB::table('program_meal_supplement')
                ->join('supplements', 'program_meal_supplement.supplement_id', '=', 'supplements.id')
                ->join('program_meal', 'program_meal_supplement.program_meal_id', '=', 'program_meal.id')
                ->where('program_meal.program_id', $program_meal->program_id)
                ->where('program_meal.day', $program_meal->day)
                ->sum(DB::raw('supplements.calories * program_meal_supplement.qty')),

// حساب الكربوهيدرات
'carbohydrates' => DB::table('program_meal_supplement')
->join('supplements', 'program_meal_supplement.supplement_id', '=', 'supplements.id')
->join('program_meal', 'program_meal_supplement.program_meal_id', '=', 'program_meal.id')
->where('program_meal.program_id', $program_meal->program_id)
->where('program_meal.day', $program_meal->day)
->sum(DB::raw('supplements.carbohydrates * program_meal_supplement.qty')),

// حساب الدهون
'fats' => DB::table('program_meal_supplement')
->join('supplements', 'program_meal_supplement.supplement_id', '=', 'supplements.id')
->join('program_meal', 'program_meal_supplement.program_meal_id', '=', 'program_meal.id')
->where('program_meal.program_id', $program_meal->program_id)
->where('program_meal.day', $program_meal->day)
->sum(DB::raw('supplements.fats * program_meal_supplement.qty')),

// حساب البروتين
'protein' => DB::table('program_meal_supplement')
->join('supplements', 'program_meal_supplement.supplement_id', '=', 'supplements.id')
->join('program_meal', 'program_meal_supplement.program_meal_id', '=', 'program_meal.id')
->where('program_meal.program_id', $program_meal->program_id)
->where('program_meal.day', $program_meal->day)
->sum(DB::raw('supplements.protein * program_meal_supplement.qty')),

// حساب الألياف
'fibers' => DB::table('program_meal_supplement')
->join('supplements', 'program_meal_supplement.supplement_id', '=', 'supplements.id')
->join('program_meal', 'program_meal_supplement.program_meal_id', '=', 'program_meal.id')
->where('program_meal.program_id', $program_meal->program_id)
->where('program_meal.day', $program_meal->day)
->sum(DB::raw('supplements.fibers * program_meal_supplement.qty')),
            ]);
        }
    }

    public function update_data_ajax(Request $request){
        $data = ProgramMealSupplementModel::where('id',$request->program_meal_type_id)->first();
        $program_meal = ProgramMealModel::where('id',$data->program_meal_id)->first();
        $data->{$request->data_type} = $request->value;
        if($data->save()){
            return response()->json([
                'success'=>true,
                'program_meal'=>$program_meal,
                'message'=>'تم تعديل الملاحظة بنجاح',
                'calories' => DB::table('program_meal_supplement')
                ->join('supplements', 'program_meal_supplement.supplement_id', '=', 'supplements.id')
                ->join('program_meal', 'program_meal_supplement.program_meal_id', '=', 'program_meal.id')
                ->where('program_meal.program_id', $program_meal->program_id)
                ->where('program_meal.day', $program_meal->day)
                ->sum(DB::raw('supplements.calories * program_meal_supplement.qty')),

// حساب الكربوهيدرات
'carbohydrates' => DB::table('program_meal_supplement')
->join('supplements', 'program_meal_supplement.supplement_id', '=', 'supplements.id')
->join('program_meal', 'program_meal_supplement.program_meal_id', '=', 'program_meal.id')
->where('program_meal.program_id', $program_meal->program_id)
->where('program_meal.day', $program_meal->day)
->sum(DB::raw('supplements.carbohydrates * program_meal_supplement.qty')),

// حساب الدهون
'fats' => DB::table('program_meal_supplement')
->join('supplements', 'program_meal_supplement.supplement_id', '=', 'supplements.id')
->join('program_meal', 'program_meal_supplement.program_meal_id', '=', 'program_meal.id')
->where('program_meal.program_id', $program_meal->program_id)
->where('program_meal.day', $program_meal->day)
->sum(DB::raw('supplements.fats * program_meal_supplement.qty')),

// حساب البروتين
'protein' => DB::table('program_meal_supplement')
->join('supplements', 'program_meal_supplement.supplement_id', '=', 'supplements.id')
->join('program_meal', 'program_meal_supplement.program_meal_id', '=', 'program_meal.id')
->where('program_meal.program_id', $program_meal->program_id)
->where('program_meal.day', $program_meal->day)
->sum(DB::raw('supplements.protein * program_meal_supplement.qty')),

// حساب الألياف
'fibers' => DB::table('program_meal_supplement')
->join('supplements', 'program_meal_supplement.supplement_id', '=', 'supplements.id')
->join('program_meal', 'program_meal_supplement.program_meal_id', '=', 'program_meal.id')
->where('program_meal.program_id', $program_meal->program_id)
->where('program_meal.day', $program_meal->day)
->sum(DB::raw('supplements.fibers * program_meal_supplement.qty')),
            ]);
        }
    }

    public function delete_meal_type_from_program(Request $request) {
        // Get the meal supplement data by its ID
        $data = ProgramMealSupplementModel::where('id', $request->program_meal_type_id)->first();
        
        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'No meal type found with the given ID',
            ]);
        }
        
        // Get the associated program meal
        $program_meal = ProgramMealModel::where('id', $data->program_meal_id)->first();
        
        // Delete the meal supplement directly without using get()
        $data_delete = ProgramMealSupplementModel::where('id', $request->program_meal_type_id);
        if ($data_delete->delete()) {
            // Delete program meals associated with the meal type and program
            $program_meal_delete = ProgramMealModel::where('meal_type_id', $program_meal->meal_type_id)
                ->where('program_id', $program_meal->program_id);
            $program_meal_delete->delete();
    
            return response()->json([
                'success' => true,
                'message' => 'تم حذف الصنف بنجاح',
            ]);
        }
    
        return response()->json([
            'success' => false,
            'message' => 'Failed to delete meal type',
        ]);
    }
}
