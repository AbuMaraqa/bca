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
        $data->qty = $request->qty;
        $data->calories = $request->calories;
        if ($data->save()){
            return redirect()->route('supplements.index')->with(['success'=>'تم اضافة المكمل الغذائي بنجاح']);
        }
    }

    public function add()
    {
        return view('project.supplements.add');
    }
}
