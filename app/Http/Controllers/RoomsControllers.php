<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomsRequest;
use App\Models\RoomsModel;
use App\Models\User;
use Illuminate\Http\Request;

class RoomsControllers extends Controller
{
    public function index()
    {
        $data = RoomsModel::get();
        return view('project.rooms.index',['data'=>$data]);
    }

    public function add()
    {
        $users = User::where('user_role','specialists')->get();
        return view('project.rooms.add',['users'=>$users]);
    }

    public function create(RoomsRequest $request){
        $data = new RoomsModel();
        $data->name = $request->name;
        $data->user_id = $request->user_id;
        if ($data->save()){
            return redirect()->route('rooms.index')->with(['success'=>'تم انشاء الغرفة بنجاح']);
        }
    }

    public function edit($id){
        $data = RoomsModel::where('id',$id)->first();
        $users = User::where('user_role','specialists')->get();
        return view('project.rooms.edit',['data'=>$data , 'users'=>$users]);
    }

    public function update(RoomsRequest $request){
        $data = RoomsModel::where('id',$request->id)->first();
        $data->name = $request->name;
        $data->user_id = $request->user_id;
        if ($data->save()){
            return redirect()->route('rooms.index')->with(['success'=>'تم تعديل البيانات بنجاح']);
        }
    }

    public function delete($id){
        $data = RoomsModel::where('id',$id)->first();
        if($data->delete()){
            return redirect()->route('rooms.index')->with(['success'=>'تم حذف الغرفة بنجاح']);
        }
    }
}
