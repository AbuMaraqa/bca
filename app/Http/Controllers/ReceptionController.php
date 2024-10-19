<?php

namespace App\Http\Controllers;

use App\Models\AppointmentsModel;
use App\Models\ClientsModel;
use App\Models\RoomsModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

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
        return view('project.reception.room',['id'=>$id,'data'=>$data]);
    }
    
    public function add_appointment($room_id)
    {
        $clients = ClientsModel::get();
        return view('project.reception.add_appointment' , ['clients'=>$clients , 'room_id'=>$room_id]);
    }

    public function create_appointment(Request $request)
    {
        // $clients = new ClientsModel();
        // $clients->name = $request->customer_name;
        // $clients->user_status = 'new';
        // $clients->save();

        $client = ClientsModel::find($request->customer_id);
        $data = AppointmentsModel::where('customer_id', $client->id)
        ->where('status', '!=', 'done')
        ->first();
        if ($data) {
            $data->customer_id = $client->id;
            $data->room_id = $request->room_id;
            $data->appointment_date = $request->appointment_date;
            $data->status = 'not_attend';
            if ($data->save()){
                return redirect()->route('reception.room',['id'=>$request->room_id])->with('تم انشاء الموعد بنجاح');
            }
            } else {
            // إذا لم تكن هناك نتيجة، قم بعرض رسالة أو تصرف مختلف
            return redirect()->route('reception.room',['id'=>$request->room_id])->with(['fail' => 'لا يتوفر اشتراك للعميل']);
        }
    }

/*************  ✨ Codeium Command ⭐  *************/
    /**
     * Update the status of a appointment
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
/******  f92f04a6-4f17-4763-ba3f-81403d24795f  *******/
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
