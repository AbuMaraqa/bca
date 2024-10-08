<?php

namespace App\Http\Controllers;

use App\Models\SupplementsModel;
use Illuminate\Http\Request;

class SupplementsController extends Controller
{
    public function index()
    {
        return view('project.supplements.index');
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

    public function supplement_table_ajax(Request $request){
        $data = SupplementsModel::where('product','like','%'.$request->name.'%')->get();
        return response()->json([
            'success' => true,
            'view' => view('project.supplements.ajax.supplement_table',['data'=>$data])->render()
        ]);
    }
}
