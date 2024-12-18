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
        // $data = ClientsModel::where('id',$id)->with('client')->get();
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
        // $data = AppointmentsModel::where('customer_id', $client->id)
        // ->where('status', '!=', 'done')
        // ->first();

        $data = new AppointmentsModel();
        $data->customer_id = $client->id;
            $data->room_id = $request->room_id;
            $data->appointment_date = $request->appointment_date;
            $data->status = 'not_attend';
        if ($data->save()) {
            
            if ($data->save()){
                return redirect()->route('reception.room',['id'=>$request->room_id])->with('تم انشاء الموعد بنجاح');
            }
            } 
        //     else {
        //     // إذا لم تكن هناك نتيجة، قم بعرض رسالة أو تصرف مختلف
        //     return redirect()->route('reception.room',['id'=>$request->room_id])->with(['fail' => 'لا يتوفر اشتراك للعميل']);
        // }
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

    public function delete($id){
        $data = AppointmentsModel::where('id',$id)->first();
        if($data->delete()){
            return redirect()->back()->with(['success'=>'تم حذف الموعد بنجاح']);
        }
    }

    public function list_reception_ajax(Request $request){
        $data = AppointmentsModel::query();
        $data->with('client');
        if($request->filled('search_client')){
            $data->whereIn('customer_id',function($query) use ($request){
                $query->select('id')->from('clients')->where('name','like','%'.$request->search_client.'%');
            }); 
        }
        if($request->filled('search_room')){
            $data->where('room_id',$request->search_room);
        }
        if($request->filled('search_status')){
            $data->where('status',$request->search_status);
        }
        if ($request->filled('from_date_time') && $request->filled('to_date_time')) {
            $fromDateTime = \Carbon\Carbon::parse($request->from_date_time);  // تحويل إلى كائن DateTime
            $toDateTime = \Carbon\Carbon::parse($request->to_date_time);
            $data->whereBetween('appointment_date', [$fromDateTime, $toDateTime]);
        }   
        $data = $data->get();
        return response()->json([
            'success' => true,
            'view' => view('project.reception.ajax.list_reciption',['data'=>$data])->render()
        ]);
    }
}
