<?php

namespace App\Http\Controllers;

use App\Models\ClientsModel;
use App\Models\ReadingUsersModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReadingUsersController extends Controller
{
    public function index(){
        return view('project.reading_users.index');
    }

    public function list_reading_users_ajax(Request $request){
        $data = ClientsModel::where('name','like','%'.$request->name.'%')->get();
        return response()->json([
            'success'=>true,
            'view'=>view('project.reading_users.ajax.list_client',['data'=>$data])->render(),
        ]);
    }

    public function details($client_id){
        $client = ClientsModel::where('id',$client_id)->first();
        $readings = ReadingUsersModel::where('user_id', $client_id)
        ->orderBy('created_at', 'asc')
        ->get();
        $firstVisit = $readings->first();
        $previousVisit = $readings->slice(-2, 1)->first();
        $currentVisit = $readings->last(); // الزيارة الحالية
        return view('project.reading_users.details',['client'=>$client ,'firstVisit'=>$firstVisit , 'previousVisit'=>$previousVisit , 'currentVisit'=>$currentVisit ]);
    }

    public function create_reading_user(Request $request){
        $data = new ReadingUsersModel();
        $data->user_id = $request->user_id;
        $data->weight = $request->weight;
        $data->fats = $request->fats;
        $data->liquids = $request->liquids;
        $data->muscles = $request->muscles;
        $data->salts = $request->salts;
        $data->insert_at = Carbon::now();
        if($data->save()){
            return redirect()->route('reading_users.details',['client_id'=>$request->user_id])->with(['success'=>'تم اضافة البيانات بنجاح']);
        }
    }

    public function search_from_bca(Request $readings){
        $data = ReadingUsersModel::orderBy('id','desc')->get();
        return response()->json([
            'success'=>true,
            'view'=>view('project.reading_users.ajax.list_bca',['data'=>$data])->render()
        ]);
    }
}
