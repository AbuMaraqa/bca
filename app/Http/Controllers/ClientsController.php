<?php

namespace App\Http\Controllers;

use App\Models\ClientModel;
use App\Models\ClientsModel;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    public function index()
    {
        return view('project.clients.index');
    }

    public function add()
    {
        return view('project.clients.add');
    }

    public function create(Request $request)
    {
        $data = new ClientsModel();
        $data->name = $request->name;
        $data->user_status = 'active';
        $data->phone = $request->phone;
        $data->dob = $request->dob;
        $data->city = $request->city;
        if ($data->save()) {
            return redirect()->route('clients.index')->with(['success'=>'تم اضافة العميل بنجاح']);
        }
    }

    public function edit($id)
    {
        $data = ClientsModel::where('id',$id)->first();
        return view('project.clients.edit',['data'=>$data]);
    }

    public function update(Request $request)
    {
        $data = ClientsModel::where('id',$request->user_id)->first();
        $data->name = $request->name;
        $data->user_status = 'active';
        $data->phone = $request->phone;
        $data->dob = $request->dob;
        $data->city = $request->city;
        if ($data->save()) {
            return redirect()->route('clients.index')->with(['success'=>'تم تعديل العميل بنجاح']);
        }
    }

    public function list_clients_ajax(Request $request){
        $data = ClientsModel::query();
        if ($request->filled('name')){
            $data->where('name','like','%'.$request->name.'%');
        }
        if ($request->filled('phone')){
            $data->where('phone','like','%'.$request->phone.'%');
        }
        $data = $data->paginate(10);
        return response()->json([
            'status' => 'success',
            'view' => view('project.clients.ajax.client_table_ajax',['data'=>$data])->render()
        ]);
    }

    public function add_subscription_for_client_index()
    {
        return view('project.subscriptions.add_subscription_for_client');
    }
}
