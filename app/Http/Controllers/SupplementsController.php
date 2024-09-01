<?php

namespace App\Http\Controllers;

use App\Models\SupplementsModel;
use Illuminate\Http\Request;

class SupplementsController extends Controller
{
    public function index()
    {
        $data = SupplementsModel::get();
        return view('project.supplements.index',['data'=>$data]);
    }

    public function create(Request $request)
    {
        $data = new SupplementsModel();
        $data->product = $request->product;
//        $data->qty = $request->qty;
        $data->calories = $request->calories;
        $data->carbohydrates = $request->carbohydrates;
        $data->fats = $request->fats;
        $data->protein = $request->protein;
        $data->fibers = $request->fibers;
        $data->notes = $request->notes;
        if ($data->save()){
            return redirect()->route('supplements.index')->with(['success'=>'تم اضافة المكمل الغذائي بنجاح']);
        }
    }

    public function add()
    {
        return view('project.supplements.add');
    }

    public function edit($id)
    {
        $data = SupplementsModel::where('id',$id)->first();
        return view('project.supplements.edit',['data'=>$data]);
    }

    public function update(Request $request)
    {
        $data = SupplementsModel::where('id',$request->id)->first();
        $data->product = $request->product;
//        $data->qty = $request->qty;
        $data->calories = $request->calories;
        $data->carbohydrates = $request->carbohydrates;
        $data->fats = $request->fats;
        $data->protein = $request->protein;
        $data->fibers = $request->fibers;
        $data->notes = $request->notes;
        if ($data->save()){
            return redirect()->route('supplements.index')->with(['success'=>'تم تعديل المكمل الغذائي بنجاح']);
        }
    }
}
