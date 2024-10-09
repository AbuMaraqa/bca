<?php

namespace App\Http\Controllers;

use App\Models\AppointmentsModel;
use App\Models\ClientsModel;
use App\Models\RoomsModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReceptionController extends Controller
{
    public function index()
    {
        $rooms = RoomsModel::get();
        return view('project.reception.index',['rooms'=>$rooms]);
    }

    public function room($id)
    {
        $today = Carbon::today()->toDateString();
        $data = AppointmentsModel::where('room_id',$id)->whereDate('appointment_date',$today)->with('client')->get();
        return $data;
        return view('project.reception.room',['id'=>$id,'data'=>$data]);
    }

    public function add_appointment($room_id)
    {
        $clients = ClientsModel::get();
        return view('project.reception.add_appointment' , ['clients'=>$clients , 'room_id'=>$room_id]);
    }

    public function create_appointment(Request $request)
    {
        $clients = new ClientsModel();
        $clients->name = $request->customer_name;
        $clients->user_status = 'new';
        $clients->save();
        
        $data = new AppointmentsModel();
        $data->customer_id = $clients->id;
        $data->room_id = $request->room_id;
        $data->appointment_date = Carbon::now();
        $data->status = 'waiting';
        if ($data->save()){
            return redirect()->route('reception.room',['id'=>$request->room_id])->with('تم انشاء الموعد بنجاح');
        }
    }

    public function update_status(Request $request){
        $data = AppointmentsModel::where('id',$request->id)->first();
        $data->status = $request->status;
        if ($data->save()){
            return response()->json([
                'success' => true,
                'message' => 'تم تعديل حالة الموعد'
            ]);
        }
    }
}
