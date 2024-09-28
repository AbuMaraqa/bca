<?php

namespace App\Http\Controllers;

use App\Models\ClientsModel;
use App\Models\ProgramMealModel;
use App\Models\ProgramMealSupplementModel;
use App\Models\ProgramModel;
use App\Models\User;
use App\Models\UserProgramMealModel;
use App\Models\UserProgramMealSupplementModel;
use App\Models\UsersProgramModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserProgramController extends Controller
{
    public function index(){
        return view('project.user_program.index');
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
                'view'=>view('project.user_program.ajax.get_program',['data'=>$data])->render()
            ]);
    }
}
