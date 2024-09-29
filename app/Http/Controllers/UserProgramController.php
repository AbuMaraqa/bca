<?php

namespace App\Http\Controllers;

use App\Models\ClientsModel;
use App\Models\ProgramMealModel;
use App\Models\ProgramMealSupplementModel;
use App\Models\ProgramModel;
use App\Models\SupplementsModel;
use App\Models\User;
use App\Models\UserProgramMealModel;
use App\Models\UserProgramMealSupplementModel;
use App\Models\UsersProgramModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserProgramController extends Controller
{
    public function index(){
        return view('project.user_program.index');
    }

    public function users_program(Request $request){
        $data = UsersProgramModel::with('client')->where('status','complete')->get();
        return response()->json([
            'success'=>true,
            'view'=>view('project.user_program.ajax.user_program',['data'=>$data])->render(),
        ]);
    }

    public function add(){
        $clients = ClientsModel::get();
        $programs = ProgramModel::get();
        return view('project.user_program.add',['clients'=>$clients , 'programs'=>$programs]);
    }

    public function program_meal_list(Request $request){
        $data = ProgramMealModel::with('meal_type','program_meal_supplement','program_meal_supplement.supplement')->where('program_id',$request->program_id)->get()->groupBy('day');
        return response()->json([
            'success'=>true,
            'view'=>view('project.user_program.ajax.get_program',['data'=>$data])->render()
        ]);
    }

    public function add_program_for_user (Request $request){
        $program = ProgramModel::where('id',$request->program_id)->first();

        $check_user_program = UsersProgramModel::where('client_id',$request->user_id)->where('status','incomplete')->first();
        
        if(!empty($check_user_program)){    
            $delete_user_program = UsersProgramModel::where('client_id',$request->user_id)->where('status','incomplete')->first();
            $delete_user_program_meal_supplement = UserProgramMealSupplementModel::where('program_id', $delete_user_program->id)->get();
            foreach ($delete_user_program_meal_supplement as $record) {
                $record->delete(); // This deletes each record individually
            }
            $delete_user_program_meal = UserProgramMealModel::where('program_id',$delete_user_program->id)->get();
            foreach($delete_user_program_meal as $key){
                $key->delete();
            }
            $delete_user_program->delete();
        }

        $check_if_program_found = UsersProgramModel::where('client_id',$request->user_id)->where('status','incomplete')->first();

            $program_meal = ProgramMealModel::where('program_id',$request->program_id)->get();

            $user_program = new UsersProgramModel();
            $user_program->client_id = $request->user_id;
            $user_program->program_name = Carbon::now()->toDateString();
            $user_program->program_category = $program->program_category_id;
            $user_program->Instructions = $program->Instructions;
            $user_program->status = 'incomplete';
            $user_program->save();
            
            foreach($program_meal as $key){
                $user_program_meal = new UserProgramMealModel();
                $user_program_meal->day = $key->day;
                $user_program_meal->program_id = $user_program->id;
                $user_program_meal->meal_type_id = $key->meal_type_id;
                $user_program_meal->user_id = $request->user_id;
                $user_program_meal->save();
            }
    
            $program_meal_supplement = ProgramMealSupplementModel::where('program_id',$request->program_id)->get();
            foreach($program_meal_supplement as $key){
                $user_program_meal_supplement = new UserProgramMealSupplementModel();
                $user_program_meal_supplement->user_id = $request->user_id;
                $user_program_meal_supplement->program_meal_id = $key->program_meal_id;
                $user_program_meal_supplement->program_id = $user_program->id;
                $user_program_meal_supplement->supplement_id = $key->supplement_id;
                $user_program_meal_supplement->notes = $key->notes;
                $user_program_meal_supplement->qty = $key->qty ?? 1;
                $user_program_meal_supplement->save();
                
            }

        $data = UserProgramMealModel::with('meal_type','program_meal_supplement','program_meal_supplement.supplement')->where('program_id',$user_program->id)->get()->groupBy('day');
            return response()->json([
                'success'=>true,
                'view'=>view('project.user_program.ajax.get_program',['data'=>$data])->render(),
                'program'=>$user_program
            ]);
    }

    public function program_meal_suplement(Request $request){
        $data = SupplementsModel::where('product','like','%'.$request->product_name.'%')->whereNotIn('id', function($query) use ($request) {
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
        ->get();
    
        return response()->json([
            'success' => true,
            'view' => view('project.user_program.ajax.meal_type_supplement_list', ['data' => $data])->render(),
        ]);
    }

    public function add_supplement_for_meal_type(Request $request){
        $data = new UserProgramMealSupplementModel();
        $data->program_meal_id = $request->program_meal_id;
        $data->user_id = $request->user_id;
        $data->program_id = $request->program_id;
        $data->supplement_id = $request->supplement_id;
        $data->notes = SupplementsModel::where('id',$request->supplement_id)->first()->notes ?? '';
        if($data->save()){
            $program_meal = UserProgramMealModel::with('meal_type','program_meal_supplement','program_meal_supplement.supplement')->where('id',$request->program_meal_id)->first();
            return response()->json([
                'success'=>true,
                'message'=>'تم اضافة البيانات بنجاح',
                'program_meal'=>$program_meal,
                'supplement'=>SupplementsModel::where('id',$request->supplement_id)->first(),
                'data'=>$data,
                    // حساب السعرات الحرارية
                'calories' =>DB::table('user_program_meal_supplement')
                ->join('supplements', 'user_program_meal_supplement.supplement_id', '=', 'supplements.id')
                ->join('user_program_meal', 'user_program_meal_supplement.program_meal_id', '=', 'user_program_meal.id')
                ->where('user_program_meal.program_id', $request->program_id)
                ->where('user_program_meal.day', $program_meal->day)
                ->sum(DB::raw('supplements.calories * user_program_meal_supplement.qty')),

                'carbohydrates' =>DB::table('user_program_meal_supplement')
                ->join('supplements', 'user_program_meal_supplement.supplement_id', '=', 'supplements.id')
                ->join('user_program_meal', 'user_program_meal_supplement.program_meal_id', '=', 'user_program_meal.id')
                ->where('user_program_meal.program_id', $request->program_id)
                ->where('user_program_meal.day', $program_meal->day)
                ->sum(DB::raw('supplements.carbohydrates * user_program_meal_supplement.qty')),

                'fats' =>DB::table('user_program_meal_supplement')
                ->join('supplements', 'user_program_meal_supplement.supplement_id', '=', 'supplements.id')
                ->join('user_program_meal', 'user_program_meal_supplement.program_meal_id', '=', 'user_program_meal.id')
                ->where('user_program_meal.program_id', $request->program_id)
                ->where('user_program_meal.day', $program_meal->day)
                ->sum(DB::raw('supplements.fats * user_program_meal_supplement.qty')),

                'protein' =>DB::table('user_program_meal_supplement')
                ->join('supplements', 'user_program_meal_supplement.supplement_id', '=', 'supplements.id')
                ->join('user_program_meal', 'user_program_meal_supplement.program_meal_id', '=', 'user_program_meal.id')
                ->where('user_program_meal.program_id', $request->program_id)
                ->where('user_program_meal.day', $program_meal->day)
                ->sum(DB::raw('supplements.protein * user_program_meal_supplement.qty')),

                'fibers' =>DB::table('user_program_meal_supplement')
                ->join('supplements', 'user_program_meal_supplement.supplement_id', '=', 'supplements.id')
                ->join('user_program_meal', 'user_program_meal_supplement.program_meal_id', '=', 'user_program_meal.id')
                ->where('user_program_meal.program_id', $request->program_id)
                ->where('user_program_meal.day', $program_meal->day)
                ->sum(DB::raw('supplements.fibers * user_program_meal_supplement.qty')),
            // حساب الكربوهيدرات
            ]);
        }
    }

    public function submit_program(Request $request){
        $data = UsersProgramModel::where('id',$request->program_id)->first();
        $data->status = 'complete';
        if($data->save()){
            return redirect()->back()->with('تم اضافة البرنامج للعميل بنجاح');
        }
    }
}
