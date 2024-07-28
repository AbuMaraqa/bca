<?php

namespace App\Http\Controllers;

use App\Models\AppointmentsModel;
use App\Models\RoomsModel;
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
        $data = AppointmentsModel::where('room_id',$id)->get();
        return view('project.reception.room',['id'=>$id,'data'=>$data]);
    }

    public function add_appointment()
    {
        return view('project.reception.add_appointment');
    }
}
