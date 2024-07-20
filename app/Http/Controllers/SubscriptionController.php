<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscriptionRequest;
use App\Models\SubscriptionModel;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index()
    {
        $data = SubscriptionModel::get();
        return view('project.subscriptions.index',['data'=>$data]);
    }

    public function add()
    {
        return view('project.subscriptions.add');
    }

    public function create(SubscriptionRequest $request)
    {
        $data = new SubscriptionModel();
        $data->name = $request->name;
        $data->duration = $request->duration;
        $data->price = $request->price;
        $data->status = 'active';
        if($data->save()){
            return redirect()->route('subscriptions.index')->with(['success'=>'تم اضافة الاشتراك بنجاح']);
        }
    }

    public function edit($id){
        $data = SubscriptionModel::where('id',$id)->first();
        return view('project.subscriptions.edit',['data'=>$data]);
    }

    public function update(SubscriptionRequest $request)
    {
        $data = SubscriptionModel::where('id',$request->id)->first();
        $data->name = $request->name;
        $data->duration = $request->duration;
        $data->price = $request->price;
        if ($request->status == 'on'){
            $data->status = 'active';
        }
        else{
            $data->status = 'not_active';
        }
        if($data->save()){
            return redirect()->route('subscriptions.index')->with(['success'=>'تم اضافة الاشتراك بنجاح']);
        }
    }

}
